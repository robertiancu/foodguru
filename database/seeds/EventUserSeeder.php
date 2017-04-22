<?php

use Illuminate\Database\Seeder;
use App\Models\Pivots\EventUser;
use Illuminate\Database\QueryException;

class EventUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $event_users = factory(EventUser::class, 100)->make();
        foreach ($event_users as $event_user) {
            repeat_query:
            try {
                $event_user->save();
            } catch (QueryException $e) {
                $event_user = factory(EventUser::class)->make();
                goto repeat_query;
            }
        }
    }
}
