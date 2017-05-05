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
        $this->call(EventSeeder::class);
        $this->call(EventUserSeeder::class);
        $this->call(IngredientSeeder::class);
        // TODO $this->call(RecipeSeeder::class);
        // /need RecipeSeeder/ $this->call(EventRecipeSeeder::class);
    }
}
