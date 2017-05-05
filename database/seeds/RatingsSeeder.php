<?php

use Illuminate\Database\Seeder;
use App\Models\Rating;
use Illuminate\Database\QueryException;

class RatingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ratings = factory(Rating::class, 50)->make();
        foreach ($ratings as $rating) {
            repeat_query:
            try {
                $rating->save();
            } catch (QueryException $e) {
                $rating = factory(Rating::class)->make();
                goto repeat_query;
            }
        }
    }
}
