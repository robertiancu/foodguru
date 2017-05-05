<?php

use Illuminate\Database\Seeder;
use App\Models\Pivots\CircleUser;
use Illuminate\Database\QueryException;

class CircleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $circle_users = factory(CircleUser::class, 200)->make();
        foreach ($circle_users as $circle_user) {
            repeat_query:
            try {
                $circle_user->save();
            } catch (QueryException $e) {
                $circle_user = factory(CircleUser::class)->make();
                goto repeat_query;
            }
        }
    }
}
