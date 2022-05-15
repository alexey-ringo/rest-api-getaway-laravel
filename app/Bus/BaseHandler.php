<?php

namespace App\Bus;

use App\Contracts\Bus\Commands\CommandInterface;
use App\Contracts\Bus\HandlerInterface;
use App\Contracts\Bus\Queries\QueryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

abstract class BaseHandler implements HandlerInterface
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected CommandInterface|QueryInterface $payload;

    public function __construct(CommandInterface|QueryInterface $payload)
    {
        $this->payload = $payload;
    }

    public function getPayload(): CommandInterface|QueryInterface
    {
        return $this->payload;
    }

    public function middleware(): array
    {
        return [];
    }
}
