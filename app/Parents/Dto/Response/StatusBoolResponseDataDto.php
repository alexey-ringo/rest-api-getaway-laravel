<?php

namespace App\Parents\Dto\Response;

use App\Parents\Dto\Base\DataTransferObject;

/**
 * Class StatusBoolResponseDataDto
 * @package App\Parents\Dto\Response
 */
class StatusBoolResponseDataDto extends DataTransferObject
{
    public bool $status;
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
