<?php

use Illuminate\Database\Seeder;
use App\Models\Circle;
use Illuminate\Database\QueryException;

class CircleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $circles = factory(Circle::class, 10)->make();
        foreach ($circles as $circle) {
            repeat_query:
            try {
                $circle->save();
            } catch (QueryException $e) {
                $circle = factory(Circle::class)->make();
                goto repeat_query;
            }
        }
    }
}
