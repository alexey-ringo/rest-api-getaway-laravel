<?php

namespace App\Listeners\HttpClient;

use App\Services\Log\HttpLogger;
use Illuminate\Http\Client\Events\ResponseReceived;
use Illuminate\Http\Client\Response;
use Throwable;

/**
 * Class LogResponseReceived
 * @package App\Listeners\HttpClient
 */
class LogResponseReceived
{
    public Response $response;
    /**
     * Handle the event.
     *
     * @param ResponseReceived $event
     *
     * @return void
     */
    public function handle(ResponseReceived $event)
    {
        $this->response = $event->response;
        $processId = request()->input('http_process_id', 'defaultProcess');
        $httpLogger = HttpLogger::make($processId);
        $globalResponse = $this->response->json();
        if (isset($globalResponse) && is_array($globalResponse)) {
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
                $httpLogger->info('httpClientResponse', ['response' => $globalResponse, 'status' => $this->response->status()]);
            } catch (Throwable $e) {
                logger()->error($e->getMessage());
            }
        } else {
            try {
                $httpLogger->info('httpClientResponse', ['response' => 'null', 'status' => $this->response->status()]);
            } catch (Throwable $e) {
                logger()->error($e->getMessage());
            }
        }
    }
}
