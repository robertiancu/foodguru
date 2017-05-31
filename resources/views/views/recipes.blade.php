
@section('head')
    <!-- Bootstrap styling for Typeahead -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/tokenfield-typeahead.css" rel="stylesheet">
    <!-- Tokenfield CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.css" rel="stylesheet">
    <!-- Docs CSS -->
@endsection


@extends('layouts.main')

@section('content')

    <h1 class="page-header">Retete</h1>

    <div id="recipes">
    </div>


    <div class="col-md-10">
        <br>
        <button class="btn btn-primary center-block" id="loadButton">Afiseaza mai multe</button>
        <br>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js" charset="UTF-8"></script>

    <script type="text/javascript"$('token-label').length>
        $(document).ready(function() {

            let iteratii = 0;

            var loadAjax =  function(e) {
                $.get('/ajax/getRecipies', {
                    i: iteratii
                }).done(function(data) {

                    let key;
                    iteratii++;

                    for(key in data)
                    {

                        let recipeBox = $('<div/>', { 'class': 'col-md-3 col-sm-3 col-xs-4 column productbox' });
                        let recipeImage = $('<img>',{ 'src': data[key].image,
                                                      'alt': data[key].name,
                                                      'class': 'img-responsive'});

                        let recipeCaption = $('<div/>',{ 'class': 'producttitle' });

                        let recipeDetails = $('<div/>',{'class': 'productprice' });
                        let recipeRightDetails = $('<div/>',{'class': 'pull-right' });
                        let recipeLink = $('<div/>',{'class': 'btn btn-danger btn-sm' });
                        let recipeLinkA = $('<a/>',{'class': 'btn btn-danger btn-sm',
                            'role': 'button',
                            'href':'/view/recipe/' + data[key].id
                        });
                        let recipeReview = $('<div/>',{'class': 'pricetext'});

                        recipeBox.appendTo('#recipes');

                        recipeImage.appendTo(recipeBox);
                        recipeCaption.appendTo(recipeBox);
                        recipeDetails.appendTo(recipeBox);

                        recipeRightDetails.appendTo(recipeDetails);
                        recipeLink.appendTo(recipeRightDetails);
                        recipeLinkA.appendTo(recipeLink);
                        recipeReview.appendTo(recipeDetails);

                        recipeLinkA.text("See");
                        recipeCaption.text(data[key].name);
                        recipeReview.text("Dificultate: " + data[key].difficulty +"/10");

                    }

                });
            };

            loadAjax();

            $('#loadButton').on('click', function(e) {
                $.get('/ajax/getRecipies', {
                    i: iteratii
                }).done(function(data) {

                    let key;
                    iteratii++;

                    for(key in data)
                    {

                        let recipeBox = $('<div/>', { 'class': 'col-md-3 col-sm-3 col-xs-4 column productbox' });
                        let recipeImage = $('<img>',{ 'src': data[key].image,
                                                      'alt': data[key].name,
                                                      'class': 'img-responsive'});

                        let recipeCaption = $('<div/>',{ 'class': 'producttitle' });

                        let recipeDetails = $('<div/>',{'class': 'productprice' });
                        let recipeRightDetails = $('<div/>',{'class': 'pull-right' });
                        let recipeLink = $('<div/>',{'class': 'btn btn-danger btn-sm' });
                        let recipeLinkA = $('<a/>',{'class': 'btn btn-danger btn-sm',
                            'role': 'button',
                            'href':'/view/recipe/' + data[key].id
                        });
                        let recipeReview = $('<div/>',{'class': 'pricetext'});

                        recipeBox.appendTo('#recipes');

                        recipeImage.appendTo(recipeBox);
                        recipeCaption.appendTo(recipeBox);
                        recipeDetails.appendTo(recipeBox);

                        recipeRightDetails.appendTo(recipeDetails);
                        recipeLink.appendTo(recipeRightDetails);
                        recipeLinkA.appendTo(recipeLink);
                        recipeReview.appendTo(recipeDetails);

                        recipeLinkA.text("See");
                        recipeCaption.text(data[key].name);
                        recipeReview.text("Dificultate: " + data[key].difficulty +"/10");

                    }

                });
            });


        });

    </script>
@endsection

