<?php

declare(strict_types = 1);

namespace App\Domains\Air\Tasks\Base;

use App\Parents\Tasks\AbstractTask;

abstract class AbstractAirTask extends AbstractTask
{
    protected string $baseUri;
    protected string $bearerToken;

    /**
     * AbstractAuthTask constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->initialize();
    }

    private function initialize()
    {
        $this->baseUri = match (app()->environment()) {
            'staging' => config('domains.air.staging.base_uri'),
            'local' => config('domains.air.staging.base_uri'),
            default => config('domains.air.production.base_uri'),
        };
        $this->bearerToken = match (app()->environment()) {
            'staging' => config('domains.air.staging.bearer_token'),
            'local' => config('domains.air.staging.bearer_token'),
            default => config('domains.air.production.bearer_token'),
        };
    }
}
