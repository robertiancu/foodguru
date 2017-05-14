/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap.js');

//import './jQuery1-5-1.js';
import './jquery-token-input/src/jquery.tokeninput.js';
import './ingredientTokenInput.js';

$(document).ready(function() {
    console.log(jQuery);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Recipe search ajax hints feature
    $('#sidebar-recipe-search').on('input', function(e) {
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

    // Calendar feature
    $('#calendar').fullCalendar({
        // put your options and callbacks here
    })
});
