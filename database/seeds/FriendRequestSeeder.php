<?php

use Illuminate\Database\Seeder;
use App\Models\FriendRequest;
use Illuminate\Database\QueryException;

class FriendRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $friend_requests = factory(FriendRequest::class, 50)->make();
        foreach ($friend_requests as $friend_request) {
            repeat_query:
            try {
                $friend_request->save();
            } catch (QueryException $e) {
                $friend_request = factory(FriendRequest::class)->make();
                goto repeat_query;
            }
        }
    }
}
