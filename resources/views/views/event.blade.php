@extends('layouts.main')

@section('content')
    <h1>{{ $event->name }}</h1>
    <hr>

    <div class="col-sm-12" id="selection-zone">
        <label>Adauga ingredient:</label>

        <input type="text" class="form-control" id="people-search"/>
        <br>

        <div class="tokenfield">
    </div>
    </div>
@endsection

@section('head')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Bootstrap styling for Typeahead -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/tokenfield-typeahead.css" rel="stylesheet">
    <!-- Tokenfield CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.css" rel="stylesheet">
    <!-- Docs CSS -->
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js" charset="UTF-8"></script>

    <script>
        var event_id = {!! $event->id !!};
        var owner = {!! $owner !!};
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.get('/ajax/getEventUsers/' + event_id, function(users) {
                console.log(event_id);
                console.log(users);
                if (users) {
                    users.forEach(function(user) {
                        let newToken = $('<div/>', { 'class': "token token-" + user.id.toString() , 'id': user.id.toString(),
                            'data-value': user.id.toString() });

                        newToken.appendTo('.tokenfield');

                        let newSpan = $('<span/>', { 'class': "token-label",
                            'style':  "max-width: 511.562px;"});

                        newSpan.append(user.first_name);

                        newSpan.appendTo(newToken);

                        if (owner) {
                            let newX = $('<a/>', { 'href': "#",
                                'class':  "close",
                                'tabindex': "-1"});
                            newX.append('x');

                            newX.appendTo(newToken);

                            console.log({
                                    user: parseInt($('.token-' + user.id.toString()).attr('id')),
                                    event: event_id,
                                    '_token': Laravel.csrfToken
                                });

                            $(newX).on('click', function(e) {
                                $.post('/ajax/removeUserFromEvent', {
                                    user_id: parseInt($('.token-' + user.id.toString()).attr('id')),
                                    event_id: event_id
                                }).done(function(data) {
                                    console.log(data);
                                    $('.token-' + user.id.toString()).remove();
                                }).fail(function(err) {
                                    console.log(err);
                                });
                            });
                        }
                    });

                    $('#selectionZone').on('keydown', function(e) {
                        if (e.which == 13) {
                            $.get
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
                }
            });
        });
    </script>
@endsection

