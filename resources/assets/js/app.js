/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap.js');

$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    // Ingredients search ajax hints feature
    $('#ingredient-search').on('input', function(e) {
        let search_box = $(this);
        let word = search_box.val();
        if (word.length > 0) {
            $.get('/ajax/searchIngredientHints/' + word)
                .done(function(words) {
                    let words_array = words.map(word => word.name);
                    search_box.autocomplete({
                        source: words_array
                    });
                });
        }
    });

    // Recipe search ajax hints feature
    $('#sidebar-recipe-search').on('input', function(e) {
        let search_box = $(this);
        let word = search_box.val();
        if (word.length > 0) {
            $.get('/ajax/searchRecipeHints/' + word)
                .done(function(words) {
                    let words_array = words.map(word => word.name);
                    search_box.autocomplete({
                        source: words_array
                    });
                });
        }
    });

    //$('#sidebar-recipe-search').bind("enterKey",function(e){
    $('#sidebar-recipe-search').keypress(function(e) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
                console.log('cacat');
            //alert('You pressed a "enter" key in textbox');  
            $.get('/ajax/recipe/exists', {name: $(this).val()}).done(function(data) {
                for (const prop of data) {
                    if(prop) {
                        window.location.replace('/view/recipe/' + prop.id);
                    }
                }
            });
        }
    });


    $('#navbar-recipe-search').on('input', function(e) {
        let search_box = $(this);
        let word = search_box.val();
        if (word.length > 0) {
            $.get('/ajax/searchIngredientHints/' + word)
                .done(function(words) {
                    let words_array = words.map(word => word.name);
                    search_box.autocomplete({
                        source: words_array
                    });
                });
        }
    });

});
