<?php

use Illuminate\Database\Seeder;
use App\Models\Step;
use Illuminate\Database\QueryException;

class StepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $steps = factory(Step::class, 50)->make();
        foreach ($steps as $step) {
            repeat_query:
            try {
                $steps->save();
            } catch (QueryException $e) {
                $step = factory(Step::class)->make();
                goto repeat_query;
            }
        }
    }
}
