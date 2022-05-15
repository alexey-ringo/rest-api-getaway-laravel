<?php

namespace App\Parents\Templates\Response;

class StatusBoolResponseTemplate
{
    public static array $remoteResponse = [
        'status' => true,
        'message' => 'Success',
    ];

    public static array $outgoingResponse = [
        'status' => true,
        'message' => 'Success'
    ];

    public static array $structureResponse = [
        'status',
        'message'
    ];
}
