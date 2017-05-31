@section('head')
    <!-- Bootstrap styling for Typeahead -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/tokenfield-typeahead.css" rel="stylesheet">
    <!-- Tokenfield CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.css" rel="stylesheet">
    <!-- Docs CSS -->
@endsection


@extends('layouts.main')

@section('content')
    <h1 class="page-header">Frigider Guru</h1>

    <div id='selectionZone'>
        <label>Adauga ingredient:</label>

        <input type="text" class="form-control" id="ingredient-search"/>

        <br>

        <div class="tokenfield">
        </div>

        <hr>
    </div>

    <button class="btn btn-default" id="generateButton">Genereaza retete</button>

    <br>

    <div id="recipes">
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js" charset="UTF-8"></script>

    <script type="text/javascript"$('token-label').length>
        $(document).ready(function() {
            $('#selectionZone').on('keydown', function(e) {
                if (e.which == 13) {
                    let newToken = $('<div/>', { 'class': "token",
                                  'data-value': $('#ingredient-search').val() });

                    newToken.appendTo('.tokenfield');

                    let newSpan = $('<span/>', { 'class': "token-label",
                                                 'style':  "max-width: 511.562px;"});

                    let newX = $('<a/>', { 'href': "#",
                                           'class':  "close",
                                           'tabindex': "-1"});


                    newSpan.append($('#ingredient-search').val());
                    newX.append('x');

                    newSpan.appendTo(newToken);
                    newX.appendTo(newToken);

                    $(newX).on('click', function(e) {
                        $(this).parent().remove();
                    });

                    $('#ingredient-search').val('');
                }
            });

            $('#generateButton').on('click', function(e) {
                $('#recipes').empty();
                let i;
                let lista_ingrediente = new Array();
                let token_label = $('.token-label');
                for(i = 0; i < token_label.length ; i++)
                {
                    lista_ingrediente[i] = token_label.eq(i).html();
                }
                $.get('/ajax/getRecipiesForIngredients', {
                    ingrediente: lista_ingrediente
                }).done(function(data) {

                    let key;

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

