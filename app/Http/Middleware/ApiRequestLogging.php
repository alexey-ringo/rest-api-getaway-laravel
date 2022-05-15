<?php

namespace App\Http\Middleware;

use App\Services\Log\HttpLogger;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Illuminate\Support\Str;
use Throwable;

class ApiRequestLogging
{
    /** @var Logger **/
    private Logger $logger;

    public function __construct()
    {
        $this->logger = $this->getLogger();
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $url = $request->url();
        $queryString = $request->getQueryString();
        $method = $request->method();
        $ip = $request->ip();
        $headers = $this->getHeadersFromRequest();
        $body = $request->getContent();
        $methodUrlString = "$ip $method $url";
        if ($queryString) {
            $methodUrlString .= "?$queryString";
        }

        if (array_key_exists('Authorization', $headers)) {
            $headers['Authorization'] = 'xxxxxxx';
        }

        $userName = 'Unauthorized';
        $userId = 0;
        if ($request->user()) {
            $userName = $request->user()->name;
            $userId = $request->user()->id;
        }
        try {
            $this->logger->info('Incoming API request', ['userName' => $userName, 'userId' => $userId, 'url' => $methodUrlString, 'headers' => json_encode($headers), 'body' => $body]);
        } catch (Throwable $e) {
            logger()->error($e->getMessage());
        }
//        $request->hooksLogger = $this->logger;
        $request->request->add(['http_process_id' => $this->logger->getName()]);

        return $next($request);
    }

    private function getHeadersFromRequest()
    {
        $headers = [];
        foreach ($_SERVER as $key => $value) {
            if (substr($key, 0, 5) <> 'HTTP_') {
                continue;
            }
            $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
            $headers[$header] = $value;
        }

        return $headers;
    }

    public function terminate(Request $request, JsonResponse $response)
    {
        $responseContent = $response->content();
        $globalResponse = json_decode($responseContent, true);
//        if (isset($responseContent) && is_string($responseContent) && ! empty($responseContent)) {
//            $globalResponse = json_decode($responseContent, true);
//        }
        if (isset($globalResponse) && is_array($globalResponse) && ! empty($globalResponse)) {
            foreach ($globalResponse as $globalResponseItemKey => $globalResponseItemVal) {
                if (is_array($globalResponseItemVal)) {
                    foreach ($globalResponseItemVal as $firstLevelNestedKey => $firstLevelNestedVal) {
                        if (is_int($firstLevelNestedKey) ||
                            (is_string($firstLevelNestedKey) && (is_numeric(mb_substr($firstLevelNestedKey, 0, 1))))) {
                            $globalResponse[$globalResponseItemKey] = [0 => 'Data Collection'];

                            break;
                        }
                        if (is_array($firstLevelNestedVal)) {
                            foreach ($firstLevelNestedVal as $secondLevelNestedKey => $secondLevelNestedVal) {
                                if (is_int($secondLevelNestedKey) ||
                                    (is_string($secondLevelNestedKey) && (is_numeric(mb_substr($secondLevelNestedKey, 0, 1))))) {
                                    $globalResponse[$globalResponseItemKey][$firstLevelNestedKey] = [0 => 'Data Collection'];

                                    break;
                                }
                                if (is_array($secondLevelNestedVal)) {
                                    foreach ($secondLevelNestedVal as $thirdLevelNestedKey => $thirdLevelNestedVal) {
                                        if (is_int($thirdLevelNestedKey) ||
                                            (is_string($thirdLevelNestedKey) && (is_numeric(mb_substr($thirdLevelNestedKey, 0, 1))))) {
                                            $globalResponse[$globalResponseItemKey][$firstLevelNestedKey][$secondLevelNestedKey] = [0 => 'Data Collection'];

                                            break;
                                        }
                                        if (is_array($thirdLevelNestedVal)) {
                                            $globalResponse[$globalResponseItemKey][$firstLevelNestedKey][$secondLevelNestedKey][$thirdLevelNestedKey] = [0 => 'array'];
//                                            foreach ($thirdLevelNestedVal as $internalKey => $internalVal) {
//
//                                            }
                                        }
                                        if (is_string($thirdLevelNestedVal) && strlen($thirdLevelNestedVal) > 51) {
                                            $globalResponse[$globalResponseItemKey][$firstLevelNestedKey][$secondLevelNestedKey][$thirdLevelNestedKey] = mb_substr($thirdLevelNestedVal, 0, 50) . '...';
                                        }
                                        if (is_object($thirdLevelNestedVal)) {
                                            $globalResponse[$globalResponseItemKey][$firstLevelNestedKey][$secondLevelNestedKey][$thirdLevelNestedKey] = 'It is object third level nested!';
                                        }
                                    }
                                }
                                if (is_string($secondLevelNestedVal) && strlen($secondLevelNestedVal) > 51) {
                                    $globalResponse[$globalResponseItemKey][$firstLevelNestedKey][$secondLevelNestedKey] = mb_substr($secondLevelNestedVal, 0, 50) . '...';
                                }
                                if (is_object($secondLevelNestedVal)) {
                                    $globalResponse[$globalResponseItemKey][$firstLevelNestedKey][$secondLevelNestedKey] = 'It is object second level nested!';
                                }
                            }
                        }
                        if (is_string($firstLevelNestedVal) && strlen($firstLevelNestedVal) > 51) {
                            $globalResponse[$globalResponseItemKey][$firstLevelNestedKey] = mb_substr($firstLevelNestedVal, 0, 50) . '...';
                        }
                        if (is_object($firstLevelNestedVal)) {
                            $globalResponse[$globalResponseItemKey][$firstLevelNestedKey] = 'It is object first level nested!';
                        }
                    }
                }
                if (is_string($globalResponseItemVal) && strlen($globalResponseItemVal) > 51) {
                    $globalResponse[$globalResponseItemKey] = mb_substr($globalResponseItemVal, 0, 50) . '...';
                }
                if (is_object($globalResponseItemVal)) {
                    $globalResponse[$globalResponseItemKey] = 'It is global object!';
                }
            }
            try {
                $this->logger->info('Outgoing API response', ['response' => $globalResponse, 'status' => $response->status()]);
            } catch (Throwable $e) {
                logger()->error($e->getMessage());
            }
        } else {
            try {
                $this->logger->info('Outgoing API response', ['response' => 'null', 'status' => $response->status()]);
            } catch (Throwable $e) {
                logger()->error($e->getMessage());
            }
        }
    }

    private function getLogger()
    {
        $processId = Str::random(8);

        return HttpLogger::make($processId);
    }
}
