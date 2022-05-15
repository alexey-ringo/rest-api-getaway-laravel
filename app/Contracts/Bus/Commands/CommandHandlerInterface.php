<?php

namespace App\Contracts\Bus\Commands;

use Illuminate\Contracts\Queue\ShouldQueue;

interface CommandHandlerInterface extends ShouldQueue
{
    public function handle();
}
