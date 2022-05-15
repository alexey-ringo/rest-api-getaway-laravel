<?php

namespace App\Contracts\Bus;

use App\Contracts\Bus\Commands\CommandHandlerInterface;
use App\Contracts\Bus\Commands\CommandInterface;
use App\Contracts\Bus\Queries\QueryHandlerInterface;
use App\Contracts\Bus\Queries\QueryInterface;

interface HandlerInterface extends CommandHandlerInterface, QueryHandlerInterface
{
    public function __construct(CommandInterface|QueryInterface $payload);

    public function getPayload(): CommandInterface|QueryInterface;
}
