<?php

declare(strict_types = 1);

namespace Tests\Feature\Http\Controllers\V1\Air;

use App\Domains\Air\Templates\Response\FlightOfferSearchAirResponseTemplate;
use App\Domains\Core\Templates\Response\IndexCaseCoreResponseTemplate;
use App\Domains\Core\Templates\Response\IndexFundCoreResponseTemplate;
use App\Domains\Core\Templates\Response\ShowCaseCoreResponseTemplate;
use App\Http\Controllers\V1\Controller;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\ApiDomainService;
use Tests\TestCase;

/**
 * Class FlightOffersControllerTest
 * @package Tests\Feature\Http\Controllers\V1\Air
 */
class FlightOffersControllerTest extends TestCase
{
    use ApiDomainService, RefreshDatabase;

    protected string $baseRemoteUri;

    /**
     * CaseCoreControllerTest constructor.
     */
    public function __construct()
    {
//        $this->baseRemoteUri = config('domains.pay.production.base_uri');
        $this->baseRemoteUri = '';
        parent::__construct();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_search()
    {
        $token = $this->createEndpointToken(Controller::AIR_FLIGHT_OFFER_SEARCH);

        Http::fake([config('domains.air.production.base_uri') . '/shopping/flight-offers' => Http::response(
                FlightOfferSearchAirResponseTemplate::$remoteResponse, 200)]
        );
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('post', route('api.v1.air.flight-offers.search'),
            ['currencyCode' => 'USD']
        );

        $response
            ->assertStatus(200)
            ->assertExactJson(FlightOfferSearchAirResponseTemplate::$remoteResponse);
    }
}
