<?php

namespace App\Bus\Queries;

use App\Contracts\Bus\Queries\QueryHandlerInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Class TestQueryHandler
 * @package App\Bus\Queries
 */
class TestQueryHandler implements QueryHandlerInterface
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var TestQuery */
    private $query;

    /**
     * Create a new job instance.
     *
     * @param  TestQuery  $query
     */
    public function __construct(TestQuery $query)
    {
        $this->query = $query;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        dump(
            $this->query->getLabel()
        );
    }
}
