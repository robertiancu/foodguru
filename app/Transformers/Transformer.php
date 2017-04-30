<?php

namespace App\Transformers;

/**
 * Class Transformer
 * @author Horea Chivu
 */
abstract class Transformer
{
    /**
     * Transform given array
     *
     * @param array $items
     * @param associative array $items
     *
     * @return array
     */
    public function transformArray(array $items, $params) {
        $this->loadParameters($params);

        return array_map([$this, 'transform'], $items);
    }

    /**
     * The transformer method.
     */
    public abstract function transform($item);

    /**
     * Load all parameters as variables of this instance.
     *
     * @param associative array $params
     *
     * @throws \Exception
     *
     * @return void
     */
    public function loadParameters($params)
    {
        if ( ! $this->isAssoc($params)) {
            throw new \Exception("Invalid paramaters");
        } else {
            foreach ($params as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    /**
     * Check if given array is associative array
     *
     * @param array $arr
     * @return array
     */
    protected function isAssoc(array $arr)
    {
        if (array() === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }
}
