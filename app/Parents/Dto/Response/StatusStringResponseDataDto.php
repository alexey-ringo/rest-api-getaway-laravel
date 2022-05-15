<?php

namespace App\Parents\Dto\Response;

use App\Parents\Dto\Base\DataTransferObject;

/**
 * Class StatusStringResponseDataDto
 * @package App\Parents\Dto\Response
 */
class StatusStringResponseDataDto extends DataTransferObject
{
    public string $status;
    public string $message;
    public array $data;

    public function __construct(array $data)
    {
        if (! isset($data['data'])) {
            $data['data'] = [];
        }
        parent::__construct($data);
    }
}
