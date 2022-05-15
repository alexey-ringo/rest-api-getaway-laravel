<?php

namespace App\Listeners\HttpClient;

use App\Services\Log\HttpLogger;
use Illuminate\Http\Client\Events\RequestSending;
use Illuminate\Http\Client\Request;
use Throwable;

/**
 * Class LogRequestSending
 * @package App\Listeners\HttpClient
 */
class LogRequestSending
{
    public Request $request;
    /**
     * Handle the event.
     *
     * @param RequestSending $event
     *
     * @return void
     */
    public function handle(RequestSending $event)
    {
        $this->request = $event->request;
        $processId = request()->input('http_process_id', 'defaultProcess');
        $httpLogger = HttpLogger::make($processId);
        try {
            $httpLogger->info('httpClientRequest', ['uri' => $this->request->url(), 'method' => $this->request->method(), 'params' => $this->request->data()]);
        } catch (Throwable $e) {
            logger()->error($e->getMessage());
        }
    }
}
