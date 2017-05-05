<?php

use Illuminate\Database\Seeder;
use App\Models\Event;
use Illuminate\Database\QueryException;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $events = factory(Event::class, 30)->make();
        foreach ($events as $event) {
            repeat_query:
            try {
                $event->save();
            } catch (QueryException $e) {
                $event = factory(Event::class)->make();
                goto repeat_query;
            }
        }
    }
}
