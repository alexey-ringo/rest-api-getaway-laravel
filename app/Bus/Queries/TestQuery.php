<?php declare(strict_types = 1);

namespace App\Bus\Queries;

use App\Contracts\Bus\Queries\QueryInterface;

/**
 * Class TestQuery
 * @package App\Bus\Queries
 */
class TestQuery implements QueryInterface
{
    /** @var string */
    private $label;

    /**
     * TestQuery constructor.
     *
     * @param  string  $label
     */
    public function __construct(string $label)
    {
        $this->label = $label;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }
}
