@extends('layouts.main')

@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css">
@endsection

@section('content')
    <h1 class="page-header">Calendar</h1>
    <div class="calendar-container">
        <div id="calendar"></div>
    </div>
@endsection
