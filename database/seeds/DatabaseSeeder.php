<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(IngredientSeeder::class);
        $this->call(IngredientMetaSeeder::class);
        $this->call(RecipesSeeder::class);
        $this->call(RatingsSeeder::class);
        $this->call(EventSeeder::class);
        $this->call(IngredientRecipeSeeder::class);
        $this->call(EventRecipeSeeder::class);
        $this->call(EventUserSeeder::class);
        $this->call(CircleSeeder::class);
        $this->call(CircleUserSeeder::class);
        $this->call(FavouriteSeeder::class);
        $this->call(StepSeeder::class);
        $this->call(FriendSeeder::class);
        $this->call(FriendRequestSeeder::class);
    }
}
