<?php namespace Portabilidade\Support;

abstract class AbstractTransformer {

    /**
     * @param $items
     * @return array
     */
    public function transformCollection(array $items)
    {
        return array_map([$this,'transform'], $items);
    }

}

