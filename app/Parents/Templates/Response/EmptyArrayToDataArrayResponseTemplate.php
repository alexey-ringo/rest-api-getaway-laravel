<?php

namespace App\Parents\Templates\Response;

class EmptyArrayToDataArrayResponseTemplate
{
    public static array $remoteResponse = [
        'test' => 'test'
    ];

    public static array $outgoingResponse = [
        'data' => [
            'test' => 'test'
        ]
    ];

    public static array $structureResponse = [
        'data'
    ];
}
