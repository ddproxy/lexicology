<?php
/**
 * @author Jon West
 */

namespace Lexicology\Test\Method;

use Celestial\Lexicology\Method\AbstractMethod;
use Celestial\Lexicology\Method\Interfaces\FilterInterface;
use Celestial\Lexicology\Method\Interfaces\SortInterface;
use Celestial\Lexicology\Method\Traits\SortTrait;


class CustomMethod extends AbstractMethod implements SortInterface, FilterInterface
{
    use SortTrait;

    /**
     * Return a sort value if either an a or b match.
     *
     * @inheritdoc
     */
    public function sortPair($a, $b)
    {
        if ($a === $b) {
            return 0;
        } elseif ($a === $this->getField()) {
            return 1;
        } elseif ($b === $this->getField()) {
            return -1;
        }
        return null;
    }

    /**
     * Return a filter array of string that have more than 5 characters
     *
     * @inheritdoc
     */
    public function filter($possibleValues)
    {
        return array_values(array_filter($possibleValues, function ($value) {
            return (strlen($value) > 5);
        }));
    }

}