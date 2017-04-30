<?php

namespace App\AppMisc;

/**
 * Class AdminMisc
 * @author Horea Chivu
 */
class AppVisualItems
{
    /**
     * Get all items that are listed in every left sidebar
     * listed in every admin view
     *
     * @return array
     */
    public function getSidebarMenuItems()
    {
        return [
            [
                'name' =>'Home',
                'image' => 'house.png',
                'route' => 'view/home'
            ],
            [
                'name' =>'Browse Recipes',
                'image' => 'recipes.png',
                'route' => 'view/recipes'
            ],
            [
                'name' =>'Calendar',
                'image' => 'calendar.png',
                'route' => 'view/calendar'
            ],
            [
                'name' =>'Fridge Guru',
                'image' => 'fridge.png',
                'route' => 'view/fridge'
            ],
            [
                'name' =>'Add Recipe',
                'image' => 'add_recipe.png',
                'route' => 'view/addRecipe'
            ],
            [
                'name' =>'Add Ingredient',
                'image' => 'add_ingredient.png',
                'route' => 'view/addIngredient'
            ]
        ];
    }
}
