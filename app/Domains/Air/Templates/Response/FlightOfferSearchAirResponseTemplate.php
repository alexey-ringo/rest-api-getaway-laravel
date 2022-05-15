<?php

declare(strict_types = 1);

namespace App\Domains\Air\Templates\Response;

class FlightOfferSearchAirResponseTemplate
{
    public static array $remoteResponse = [
        "meta" => [
            "count" => 2
        ],
        "data" => [
            0 => [
                "type" => "flight-offer",
                "id" => "1",
                "source" => "GDS",
                "instantTicketingRequired" => false,
                "nonHomogeneous" => false,
                "oneWay" => false,
                "lastTicketingDate" => "2022-11-01",
                "numberOfBookableSeats" => 9,
                "itineraries" => [
                    0 => [
                        "duration" => "PT14H15M",
                        "segments" => [
                            0 => [
                                "departure" => [
                                    "iataCode" => "SYD",
                                    "terminal" => "1",
                                    "at" => "2022-11-01T11:35:00"
                                ],
                                "arrival" => [
                                    "iataCode" => "MNL",
                                    "terminal" => "2",
                                    "at" => "2022-11-01T16:50:00"
                                ],
                                "carrierCode" => "PR",
                                "number" => "212",
                                "aircraft" => [
                                    "code" => "333"
                                ],
                                "operating" => [
                                    "carrierCode" => "PR"
                                ],
                                "duration" => "PT8H15M",
                                "id" => "1",
                                "numberOfStops" => 0,
                                "blacklistedInEU" => false
                            ],
                            1 => [
                                "departure" => [
                                    "iataCode" => "MNL",
                                    "terminal" => "1",
                                    "at" => "2022-11-01T19:20:00"
                                ],
                                "arrival" => [
                                    "iataCode" => "BKK",
                                    "at" => "2022-11-01T21:50:00"
                                ],
                                "carrierCode" => "PR",
                                "number" => "732",
                                "aircraft" => [
                                    "code" => "321"
                                ],
                                "operating" => [
                                    "carrierCode" => "PR"
                                ],
                                "duration" => "PT3H30M",
                                "id" => "2",
                                "numberOfStops" => 0,
                                "blacklistedInEU" => false
                            ]
                        ]
                    ],
                    1 => [
                        "duration" => "PT16H15M",
                        "segments" => [
                            0 => [
                                "departure" => [
                                    "iataCode" => "BKK",
                                    "at" => "2022-11-05T13:30:00"
                                ],
                                "arrival" => [
                                    "iataCode" => "MNL",
                                    "terminal" => "2",
                                    "at" => "2022-11-05T18:00:00"
                                ],
                                "carrierCode" => "PR",
                                "number" => "731",
                                "aircraft" => [
                                    "code" => "333"
                                ],
                                "operating" => [
                                    "carrierCode" => "PR"
                                ],
                                "duration" => "PT3H30M",
                                "id" => "3",
                                "numberOfStops" => 0,
                                "blacklistedInEU" => false
                            ],
                            1 => [
                                "departure" => [
                                    "iataCode" => "MNL",
                                    "terminal" => "1",
                                    "at" => "2022-11-05T22:10:00"
                                ],
                                "arrival" => [
                                    "iataCode" => "SYD",
                                    "terminal" => "1",
                                    "at" => "2022-11-06T09:45:00"
                                ],
                                "carrierCode" => "PR",
                                "number" => "211",
                                "aircraft" => [
                                    "code" => "333"
                                ],
                                "operating" => [
                                    "carrierCode" => "PR"
                                ],
                                "duration" => "PT8H35M",
                                "id" => "4",
                                "numberOfStops" => 0,
                                "blacklistedInEU" => false
                            ]
                        ]
                    ]
                ],
                "price" => [
                    "currency" => "EUR",
                    "total" => "1279.54",
                    "base" => "844.00",
                    "fees" => [
                        0 => [
                            "amount" => "0.00",
                            "type" => "SUPPLIER"
                        ],
                        1 => [
                            "amount" => "0.00",
                            "type" => "TICKETING"
                        ]
                    ],
                    "grandTotal" => "1279.54"
                ],
                "pricingOptions" => [
                    "fareType" => [
                        "PUBLISHED"
                    ],
                    "includedCheckedBagsOnly" => true
                ],
                "validatingAirlineCodes" => [
                    "PR"
                ],
                "travelerPricings" => [
                    0 => [
                        "travelerId" => "1",
                        "fareOption" => "STANDARD",
                        "travelerType" => "ADULT",
                        "price" => [
                            "currency" => "EUR",
                            "total" => "639.77",
                            "base" => "422.00"
                        ],
                        "fareDetailsBySegment" => [
                            0 => [
                                "segmentId" => "1",
                                "cabin" => "ECONOMY",
                                "fareBasis" => "TBAU",
                                "class" => "T",
                                "includedCheckedBags" => [
                                    "weight" => 30,
                                    "weightUnit" => "KG"
                                ]
                            ],
                            1 => [
                                "segmentId" => "2",
                                "cabin" => "ECONOMY",
                                "fareBasis" => "TBAU",
                                "class" => "T",
                                "includedCheckedBags" => [
                                    "weight" => 30,
                                    "weightUnit" => "KG"
                                ]
                            ],
                            2 => [
                                "segmentId" => "3",
                                "cabin" => "ECONOMY",
                                "fareBasis" => "KBAU",
                                "class" => "K",
                                "includedCheckedBags" => [
                                    "weight" => 30,
                                    "weightUnit" => "KG"
                                ]
                            ],
                            3 => [
                                "segmentId" => "4",
                                "cabin" => "ECONOMY",
                                "fareBasis" => "KBAU",
                                "class" => "K",
                                "includedCheckedBags" => [
                                    "weight" => 30,
                                    "weightUnit" => "KG"
                                ]
                            ]
                        ]
                    ],
                    1 => [
                        "travelerId" => "2",
                        "fareOption" => "STANDARD",
                        "travelerType" => "ADULT",
                        "price" => [
                            "currency" => "EUR",
                            "total" => "639.77",
                            "base" => "422.00"
                        ],
                        "fareDetailsBySegment" => [
                            0 => [
                                "segmentId" => "1",
                                "cabin" => "ECONOMY",
                                "fareBasis" => "TBAU",
                                "class" => "T",
                                "includedCheckedBags" => [
                                    "weight" => 30,
                                    "weightUnit" => "KG"
                                ]
                            ],
                            1 => [
                                "segmentId" => "2",
                                "cabin" => "ECONOMY",
                                "fareBasis" => "TBAU",
                                "class" => "T",
                                "includedCheckedBags" => [
                                    "weight" => 30,
                                    "weightUnit" => "KG"
                                ]
                            ],
                            2 => [
                                "segmentId" => "3",
                                "cabin" => "ECONOMY",
                                "fareBasis" => "KBAU",
                                "class" => "K",
                                "includedCheckedBags" => [
                                    "weight" => 30,
                                    "weightUnit" => "KG"
                                ]
                            ],
                            3 => [
                                "segmentId" => "4",
                                "cabin" => "ECONOMY",
                                "fareBasis" => "KBAU",
                                "class" => "K",
                                "includedCheckedBags" => [
                                    "weight" => 30,
                                    "weightUnit" => "KG"
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            1 => [
                "type" => "flight-offer",
                "id" => "2",
                "source" => "GDS",
                "instantTicketingRequired" => false,
                "nonHomogeneous" => false,
                "oneWay" => false,
                "lastTicketingDate" => "2022-11-01",
                "numberOfBookableSeats" => 9,
                "itineraries" => [
                    0 => [
                        "duration" => "PT14H15M",
                        "segments" => [
                            0 => [
                                "departure" => [
                                    "iataCode" => "SYD",
                                    "terminal" => "1",
                                    "at" => "2022-11-01T11:35:00"
                                ],
                                "arrival" => [
                                    "iataCode" => "MNL",
                                    "terminal" => "2",
                                    "at" => "2022-11-01T16:50:00"
                                ],
                                "carrierCode" => "PR",
                                "number" => "212",
                                "aircraft" => [
                                    "code" => "333"
                                ],
                                "operating" => [
                                    "carrierCode" => "PR"
                                ],
                                "duration" => "PT8H15M",
                                "id" => "1",
                                "numberOfStops" => 0,
                                "blacklistedInEU" => false
                            ],
                            1 => [
                                "departure" => [
                                    "iataCode" => "MNL",
                                    "terminal" => "1",
                                    "at" => "2022-11-01T19:20:00"
                                ],
                                "arrival" => [
                                    "iataCode" => "BKK",
                                    "at" => "2022-11-01T21:50:00"
                                ],
                                "carrierCode" => "PR",
                                "number" => "732",
                                "aircraft" => [
                                    "code" => "321"
                                ],
                                "operating" => [
                                    "carrierCode" => "PR"
                                ],
                                "duration" => "PT3H30M",
                                "id" => "2",
                                "numberOfStops" => 0,
                                "blacklistedInEU" => false
                            ]
                        ]
                    ],
                    1 => [
                        "duration" => "PT28H15M",
                        "segments" => [
                            0 => [
                                "departure" => [
                                    "iataCode" => "BKK",
                                    "at" => "2022-11-05T01:30:00"
                                ],
                                "arrival" => [
                                    "iataCode" => "MNL",
                                    "terminal" => "2",
                                    "at" => "2022-11-05T05:45:00"
                                ],
                                "carrierCode" => "PR",
                                "number" => "741",
                                "aircraft" => [
                                    "code" => "321"
                                ],
                                "operating" => [
                                    "carrierCode" => "PR"
                                ],
                                "duration" => "PT3H15M",
                                "id" => "5",
                                "numberOfStops" => 0,
                                "blacklistedInEU" => false
                            ],
                            1 => [
                                "departure" => [
                                    "iataCode" => "MNL",
                                    "terminal" => "1",
                                    "at" => "2022-11-05T22:10:00"
                                ],
                                "arrival" => [
                                    "iataCode" => "SYD",
                                    "terminal" => "1",
                                    "at" => "2022-11-06T09:45:00"
                                ],
                                "carrierCode" => "PR",
                                "number" => "211",
                                "aircraft" => [
                                    "code" => "333"
                                ],
                                "operating" => [
                                    "carrierCode" => "PR"
                                ],
                                "duration" => "PT8H35M",
                                "id" => "6",
                                "numberOfStops" => 0,
                                "blacklistedInEU" => false
                            ]
                        ]
                    ]
                ],
                "price" => [
                    "currency" => "EUR",
                    "total" => "1279.54",
                    "base" => "844.00",
                    "fees" => [
                        0 => [
                            "amount" => "0.00",
                            "type" => "SUPPLIER"
                        ],
                        1 => [
                            "amount" => "0.00",
                            "type" => "TICKETING"
                        ]
                    ],
                    "grandTotal" => "1279.54"
                ],
                "pricingOptions" => [
                    "fareType" => [
                        "PUBLISHED"
                    ],
                    "includedCheckedBagsOnly" => true
                ],
                "validatingAirlineCodes" => [
                    "PR"
                ],
                "travelerPricings" => [
                    0 => [
                        "travelerId" => "1",
                        "fareOption" => "STANDARD",
                        "travelerType" => "ADULT",
                        "price" => [
                            "currency" => "EUR",
                            "total" => "639.77",
                            "base" => "422.00"
                        ],
                        "fareDetailsBySegment" => [
                            0 => [
                                "segmentId" => "1",
                                "cabin" => "ECONOMY",
                                "fareBasis" => "TBAU",
                                "class" => "T",
                                "includedCheckedBags" => [
                                    "weight" => 30,
                                    "weightUnit" => "KG"
                                ]
                            ],
                            1 => [
                                "segmentId" => "2",
                                "cabin" => "ECONOMY",
                                "fareBasis" => "TBAU",
                                "class" => "T",
                                "includedCheckedBags" => [
                                    "weight" => 30,
                                    "weightUnit" => "KG"
                                ]
                            ],
                            2 => [
                                "segmentId" => "5",
                                "cabin" => "ECONOMY",
                                "fareBasis" => "KBAU",
                                "class" => "K",
                                "includedCheckedBags" => [
                                    "weight" => 30,
                                    "weightUnit" => "KG"
                                ]
                            ],
                            3 => [
                                "segmentId" => "6",
                                "cabin" => "ECONOMY",
                                "fareBasis" => "KBAU",
                                "class" => "K",
                                "includedCheckedBags" => [
                                    "weight" => 30,
                                    "weightUnit" => "KG"
                                ]
                            ]
                        ]
                    ],
                    1 => [
                        "travelerId" => "2",
                        "fareOption" => "STANDARD",
                        "travelerType" => "ADULT",
                        "price" => [
                            "currency" => "EUR",
                            "total" => "639.77",
                            "base" => "422.00"
                        ],
                        "fareDetailsBySegment" => [
                            0 => [
                                "segmentId" => "1",
                                "cabin" => "ECONOMY",
                                "fareBasis" => "TBAU",
                                "class" => "T",
                                "includedCheckedBags" => [
                                    "weight" => 30,
                                    "weightUnit" => "KG"
                                ]
                            ],
                            1 => [
                                "segmentId" => "2",
                                "cabin" => "ECONOMY",
                                "fareBasis" => "TBAU",
                                "class" => "T",
                                "includedCheckedBags" => [
                                    "weight" => 30,
                                    "weightUnit" => "KG"
                                ]
                            ],
                            2 => [
                                "segmentId" => "5",
                                "cabin" => "ECONOMY",
                                "fareBasis" => "KBAU",
                                "class" => "K",
                                "includedCheckedBags" => [
                                    "weight" => 30,
                                    "weightUnit" => "KG"
                                ]
                            ],
                            3 => [
                                "segmentId" => "6",
                                "cabin" => "ECONOMY",
                                "fareBasis" => "KBAU",
                                "class" => "K",
                                "includedCheckedBags" => [
                                    "weight" => 30,
                                    "weightUnit" => "KG"
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ],
        "dictionaries" => [
            "locations" => [
                "BKK" => [
                    "cityCode" => "BKK",
                    "countryCode" => "TH"
                ],
                "MNL" => [
                    "cityCode" => "MNL",
                    "countryCode" => "PH"
                ],
                "SYD" => [
                    "cityCode" => "SYD",
                    "countryCode" => "AU"
                ]
            ],
            "aircraft" => [
                "321" => "AIRBUS A321",
                "333" => "AIRBUS A330-300"
            ],
            "currencies" => [
                "EUR" => "EURO"
            ],
            "carriers" => [
                "PR" => "PHILIPPINE AIRLINES"
            ]
        ]
    ];

    public static array $outgoingResponse = [

    ];


    public static array $structureResponse = [
        'status',
        'message',
        'data'
    ];


}
