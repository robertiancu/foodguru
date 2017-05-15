<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TomLingham\Searchy\Facades\Searchy;

class AjaxController extends Controller
{
    /**
     * Get recipes for partial words
     *
     * @return Response
     */
    public function searchRecipeHints($word)
    {
        if (strlen($word) < 1) {
            return [];
        }

        $results = Searchy::recipes('name')
            ->select('name')
            ->query($word)
            ->getQuery()
            ->limit(10)
            ->get();

        return $results;
    }

    /**
     * Get ingredients for partial words
     *
     * @return Response
     */
    public function searchIngredientHints($word)
    {
        if (strlen($word) < 1) {
            return [];
        }

        $results = Searchy::ingredients('name')
            ->select('name')
            ->query($word)
            ->getQuery()
            ->limit(10)
            ->get();

        return $results;
    }


    /**
     * Return the fridge view
     *
     * @return Response
     */
    public function ingredientsNames($word)
    {
        if (strlen($word) < 1) {
            return [];
        }

        $results = Searchy::ingredients('name')
            ->select('name')
            ->query($word)
            ->getQuery()
            ->limit(10)
            ->get()
            ->toArray();

        $func = function($item)
        {
            return $item->name;
        };

        $ingredients = array_map($func,$results);

        return $ingredients;
    }
}

