<?php

namespace App\Services\Log;

use App\Contracts\AuthorizeInterface;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class HttpLogger
{
    public static function make(string $processId): Logger
    {
        /** @var AuthorizeInterface $client */
        $client = auth()->user();
        /** @phpstan-ignore-next-line */
        $clientId = $client ? $client->getId() : 'unauthorized';
        /** @phpstan-ignore-next-line */
        $clientName = $client ? $client->getNameNoGaps() : 'unauthorized';
//        $dateClientNameId = now()->format('m_d_Y') . $clientId;
//        $stream = new StreamHandler(storage_path('logs/' .
//        $filePath = 'web_hooks_' . $dateClientNameId . '.log';
        $dateFormat = "m/d/Y H:i:s";
        $output = "[%datetime%] %channel%.%level_name%: %message% %context%\n";
        //dateFormat overwritting into RotatingFileHandler
        $formatter = new LineFormatter($output, $dateFormat);
//        $stream = new StreamHandler(storage_path('logs/' . $filePath), Logger::DEBUG);
        $stream = new RotatingFileHandler(storage_path('logs/api.log'), 90, Logger::DEBUG);
        $stream->setFormatter($formatter);
        $stream->setFilenameFormat('api--{date}' . '--' . $clientName . '--' . $clientId, 'Y-m-d');
        $logger = new Logger($processId);
        $logger->pushHandler($stream);

        return $logger;
    }
}
