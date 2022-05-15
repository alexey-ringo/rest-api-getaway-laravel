<?php

namespace App\Parents\Templates\Response;

class StatusStringResponseTemplate
{
    public static array $remoteResponse = [
        'status' => 'Success',
        'message' => 'New transaction 1234',
    ];

    public static array $outgoingResponse = [
        'status' => 'Success',
        'message' => 'New transaction 1234'
    ];

    public static array $structureResponse = [
        'status',
        'message'
    ];
}
