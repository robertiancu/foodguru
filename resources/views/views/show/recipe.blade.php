@extends('layouts.main')
@section('content')
	<style type="text/css">
		* {
  box-sizing: border-box;
}

.background-image {
  background-image: url('{{ $recipe->image }}');
  background-size: cover;
  display: block;
  filter: blur(5px);
  -webkit-filter: blur(5px);
  height: 300px;
  width: 95%;
  z-index: -1;
  position: absolute;
}

.content {
  background: rgba(255, 255, 255, 0.35);
  border-radius: 3px;
  box-shadow: 0 1px 5px rgba(0, 0, 0, 0.25);
  font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
  positin: fixed;
  z-index: 1;
}
	</style>
	<h1 class="page-header">{{ $recipe->name }}</h1>
	<div class="background-image"></div>
			<div class="recipe-present">
			<img src="{{ $recipe->image }}" height=304 style="float: left">
			<img src="{{URL::asset('/images/recipes/star-icon.png')}}" style="float:left;height:6em;margin-right:-1em;
			    -webkit-filter: grayscale({{100-$rating*10/50*100}}%); /* Safari 6.0 - 9.0 */
    filter: grayscale({{100-$rating*10/50*100}}%);
			">
            <p style="font-size: 4em;color: WHITE;
            text-shadow:
    -1px -1px 0 #000,
    1px -1px 0 #000,
    -1px 1px 0 #000,
    1px 1px 0 #000;">&nbsp{{ $rating }}</p>
	</div>
	<div  style="margin-top:30px; " class="reicpe-details col-md-10">
		<b><p>Difficulty : <span style="color:rgb({{$recipe->difficulty*255/10}},{{(10-$recipe->difficulty)*255/10}},0)">{{$recipe->difficulty}}</span></p></b>
		<b>Preparation time: {{ floor($recipe->time/60)}}h {{ $recipe->time%60 }}m </b>
				<img src="{{URL::asset('/images/recipes/clock.png')}}" style="width:1.5em;margin-left:10px">
		<br>
		<b>Description:</b>
		<br>
		<p  class="panel-body">{{ $recipe->description }}</p>
		<br>
	<ol >
	<b>Steps:</b>
	<hr>
		@foreach($steps as $step)
			<li>{{$step->content}}</li>
		@endforeach
	</ol>
	</div>
@endsection