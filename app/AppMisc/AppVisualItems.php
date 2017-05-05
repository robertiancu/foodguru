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
                'name' =>'Acasa',
                'image' => 'house.png',
                'route' => 'view/home'
            ],
            [
                'name' =>'Retete',
                'image' => 'recipes.png',
                'route' => 'view/recipes'
            ],
            [
                'name' =>'Cercuri',
                'image' => 'circles.png',
                'route' => 'view/circles'
            ],
            [
                'name' =>'Calendar',
                'image' => 'calendar.png',
                'route' => 'view/calendar'
            ],
            [
                'name' =>'Lista Cumparaturi',
                'image' => 'shop_list.png',
                'route' => 'view/shopList'
            ],
            [
                'name' =>'Frigider Guru',
                'image' => 'fridge.png',
                'route' => 'view/fridge'
            ],
            [
                'name' =>'Adauga Reteta',
                'image' => 'add_recipe.png',
                'route' => 'view/addRecipe'
            ],
            [
                'name' =>'Adauga Ingredient',
                'image' => 'add_ingredient.png',
                'route' => 'view/addIngredient'
            ]
        ];
    }
}
