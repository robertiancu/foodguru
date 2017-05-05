<?php

use Illuminate\Database\Seeder;
use App\Models\Favourite;
use Illuminate\Database\QueryException;

class FavouriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $favourites = factory(Favourite::class, 10)->make();
        foreach ($favourites as $favourite) {
            repeat_query:
            try {
                $favourite->save();
            } catch (QueryException $e) {
                $favourite = factory(Favourite::class)->make();
                goto repeat_query;
            }
        }
    }
}
