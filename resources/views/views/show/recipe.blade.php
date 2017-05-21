@extends('layouts.main')
@section('content')
	<style type="text/css">
		* {
  box-sizing: border-box;
}

.background-image {
  background-image: url('{{ URL::asset($recipe->image) }}');
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

.rating {
  overflow: hidden;
  vertical-align: bottom;
  display: inline-block;
  width: auto;
  height: 30px;
}

.rating > input {
  opacity: 0;
  margin-right: -100%;
}

.rating > label {
  position: relative;
  display: block;
  float: right;
  background: url('{{URL::asset('/images/recipes/star-off-big.png')}}');
  background-size: 30px 30px;
}

.rating > label:before {
  display: block;
  opacity: 0;
  content: '';
  width: 30px;
  height: 30px;
  background: url('{{URL::asset('/images/recipes/star-on-big.png')}}');
  background-size: 30px 30px;
  transition: opacity 0.2s linear;
}

.rating > label:hover:before,  .rating > label:hover ~ label:before,  .rating:not(:hover) > :checked ~ label:before { opacity: 1; }

	</style>
	<script>
		function submitForm()
		{
			document.getElementById("rating-form").submit();
		}
	</script>
	<h1 class="page-header">{{ $recipe->name }}</h1>
	<div class="background-image"></div>
			<div class="recipe-present">
			<img src="{{ URL::asset($recipe->image) }}" height=304 style="float: left">
			<img src="{{URL::asset('/images/recipes/star-icon.png')}}" style="float:left;height:6em;margin-right:-1em;
			    -webkit-filter: grayscale({{100-$rating['ratingAvg']*10/50*100}}%); /* Safari 6.0 - 9.0 */
    filter: grayscale({{100-$rating['ratingAvg']*10/50*100}}%);
			">
            <p><span style="font-size: 4em;color: WHITE;
            text-shadow:
    -1px -1px 0 #000,
    1px -1px 0 #000,
    -1px 1px 0 #000,
    1px 1px 0 #000;">&nbsp{{ $rating['ratingAvg'] }}</span>
<span style="font-size: 2em;color: WHITE;
            text-shadow:
    -1px -1px 0 #000,
    1px -1px 0 #000,
    -1px 1px 0 #000,
    1px 1px 0 #000;">
    @if ($rating['C'] !=0)
    	{{ '('.$rating['C'].')' }}
    @endif
    </span>
    </p>
	</div>
	<div  style="margin-top:30px;width:90%; " class="col-md-10 reicpe-details">


	

		<b><p>Difficulty : <span style="color:rgb({{floor($recipe->difficulty*255/10)}},{{floor((10-$recipe->difficulty)*255/10)}},0)">{{$recipe->difficulty}}</span> 	<b style="margin-left:78%;">Your rating :</b></p></b>

			<form style="float:right;" id="rating-form" role="form" method="POST" action="/rating/create" enctype="multipart/form-data">
	{{csrf_field()}}
	

	<span  class="rating">
		
  <input id="rating5" type="radio" name="rating" onclick="submitForm()" value="5"@if($rating['myRating']==5) {{'checked'}} @endif>
  <label for="rating5">5</label>
  <input id="rating4" type="radio" name="rating" onclick="submitForm()" value="4"@if($rating['myRating']==4) {{'checked'}} @endif>
  <label for="rating4">4</label>
  <input id="rating3" type="radio" name="rating" onclick="submitForm()" value="3"@if($rating['myRating']==3) {{'checked'}} @endif>
  <label for="rating3">3</label>
  <input id="rating2" type="radio" name="rating" onclick="submitForm()" value="2" @if($rating['myRating']==2) {{'checked'}} @endif>
  <label for="rating2">2</label>
  <input id="rating1" type="radio" name="rating" onclick="submitForm()" value="1"@if($rating['myRating']==1) {{'checked'}} @endif>
  <label for="rating1">1</label>
  <input type="hidden" name="recipe_id" value="{{$recipe->id}}">

        <br>
        <input style="margin-top:10px;margin-left: 80px" type="submit" class="btn btn-primary" value="Submit rating!">
    </span>
    </form>

		<b>Preparation time: {{ floor($recipe->time/60)}}h {{ $recipe->time%60 }}m </b>
				<img src="{{URL::asset('/images/recipes/clock.png')}}" style="width:1.5em;margin-left:10px">
		<br>
		<b>Description:</b>
		<br>
		<p  class="panel-body">{{ $recipe->description }}</p>
		<br>
		<b>Ingredients:</b>
		<ul>
		<p></p>
		@foreach($ingredients as $ingredient)
			<li><b>{{$ingredient['name']}}</b> : {{$ingredient['quantity']}}{{$ingredient['unit']}} ( <i>{{$ingredient['description']}}</i> )</li>
		@endforeach
		</ul>
		<br>
		<p><b>Nutritional values :</b></p>
		<p>The dish contains {{$nutrition['grams']}} g</p>
		<br>
		<table class="table table-border table-hover">
		<thead>
			<tr>
				<th>Uniting</th>
				<th>Calories</th>
				<th>Proteins</th>
				<th>Lipids</th>
				<th>Carbs</th>
				<th>Fibers</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th><b>100g</b></th>
				<th>{{number_format($nutrition['calories'] * 100 / $nutrition['grams'],1,'.','')}}</th>
				<th>{{number_format($nutrition['proteins'] * 100 / $nutrition['grams'],1,'.','')}}</th>
				<th>{{number_format($nutrition['lipids'] * 100 / $nutrition['grams'],1,'.','')}}</th>
				<th>{{number_format($nutrition['carbs'] * 100 / $nutrition['grams'],1,'.','')}}</th>
				<th>{{number_format($nutrition['fibers'] * 100 / $nutrition['grams'],1,'.','')}}</th>
			</tr>
			<tr>
				<th><b>Total</b></th>
				<th>{{$nutrition['calories']}}</th>
				<th>{{$nutrition['proteins']}}</th>
				<th>{{$nutrition['lipids']}}</th>
				<th>{{$nutrition['carbs']}}</th>
				<th>{{$nutrition['fibers']}}</th>
			</tr>
		</tbody>
		</table>
		<br>
		<br>
	<ol >
	<b>Steps:</b>
	<hr>
		@foreach($steps as $step)
			<li>{{$step->content}}</li>
		@endforeach
	</ol>
	<br>
	</div>
@endsection