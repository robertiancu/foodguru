@extends('layouts.main')

@section('sidebar')
    @foreach ($sidebar_items as $siderbar_item)
        <a href="{{ $siderbar_item['route'] }}"><li>{{ $siderbar_item['name'] }}</li></a>
    @endforeach
@endsection
