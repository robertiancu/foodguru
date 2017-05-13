<?php

namespace App\Transformers;

/**
 * Class UrlTransformer
 * @author Horea Chivu
 */
class UrlTransformer extends Transformer
{
    /**
     * Transform given route to complete url
     *
     * @return string : the url
     */
    public function transform($item)
    {
        return [
            'name' => $item['name'],
            'image' => $item['image'],
            'route' => '/' . $item['route'],
            'url' => $this->url . '/' . $item['route']
        ];
    }
}
