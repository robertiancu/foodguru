<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Database\QueryException;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(User::class, 100)->make();
        foreach ($users as $user) {
            repeat_query:
            try {
                $user->save();
            } catch (QueryException $e) {
                $user = factory(User::class)->make();
                goto repeat_query;
            }
        }
    }
}
