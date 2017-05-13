<?php

use Illuminate\Database\Seeder;
use App\Models\Friend;
use Illuminate\Database\QueryException;

class FriendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $friends = factory(Friend::class, 100)->make();
        foreach ($friends as $friend) {
            repeat_query:
            try {
                $friend->save();
            } catch (QueryException $e) {
                $friend = factory(Friend::class)->make();
                goto repeat_query;
            }
        }
    }
}
