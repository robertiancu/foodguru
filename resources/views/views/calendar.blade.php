@extends('layouts.main')

@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection

@section('content')
    <h1 class="page-header">Calendar</h1>
    <div class="row">
        <div class="col-sm-6 col-lg-6">
            <div class="calendar-container">
                <div id="calendar"></div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-6">
            <h2 class="sub-title">Adauga eveniment</h2>
            <div class="add-events-container">
                <form action="" id="add-event" method="POST" class="form-horizontal" role="form">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Nume:</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                        <label for="date" class="col-md-4 control-label">Data:</label>

                        <div class="col-md-6">
                            <input id="date" type="text" class="form-control" name="date" value="{{ old('date') }}" required>

                            @if ($errors->has('date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('date') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('start_time') ? ' has-error' : '' }}">
                        <label for="start_time" class="col-md-4 control-label">Start:</label>

                        <div class="col-md-6">
                            <input id="start_time" type="text" class="form-control" name="start_time" value="{{ old('start_time') }}" required>

                            @if ($errors->has('start_time'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('start_time') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('end_time') ? ' has-error' : '' }}">
                        <label for="end_time" class="col-md-4 control-label">Sfarsit:</label>

                        <div class="col-md-6">
                            <input id="end_time" type="text" class="form-control" name="end_time" value="{{ old('end_time') }}" required>

                            @if ($errors->has('end_time'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('end_time') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="public">Public:</label>
                        <div class="col-md-6">
                            <select class="form-control " id="public" name="public">
                                <option value="da">Da</option>
                                <option value="nu">Nu</option>
                            </select>
                            </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Creati eveniment
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h2 style="padding-top: 3em">Evenimente in care esti inclus</h2>
            <hr>
            <div class="table-responsive">
                <table id="mytable" class="table table-bordred table-striped">
                    <thead>
                        <th><input type="checkbox" id="checkall" /></th>
                        <th>Nume Eveniment</th>
                        <th>Locatie</th>
                        <th>Start</th>
                        <th>Sfarsit</th>
                        <th>Public</th>
                        <th>Editeaza</th>
                        <th>Sterge</th>
                    </thead>
                    <tbody>
                        @foreach($events as $event)
                            <tr>
                                <td><input type="checkbox" class="checkthis" /></td>
                                <td><a href="/view/event/{{ $event['id'] }}" target="_blank">{{ $event['name'] }}</a></td>
                                <td>{{ $event['location'] }}</td>
                                <td>{{ $event['start_time'] }}</td>
                                <td>{{ $event['end_time'] }}</td>
                                <td>{{ $event['public'] ? 'da' : 'nu' }}</td>
                                {{--@if($event['owner'])--}}
                                    <td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit-{{ $event['id'] }}" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
                                    <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete-{{ $event['id'] }}" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                                {{--@endif--}}
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

            @foreach($events as $event)
                <div class="modal fade" id="edit-{{ $event['id'] }}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                                <h4 class="modal-title custom_align" id="Heading">Editeaza Evenimentul</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="edit_name">Nume:</label>
                                    <input class="form-control " id="edit_name" type="text" name="edit_name" placeholder="{{ $event['name'] }}" value="{{ $event['name'] }}">
                                </div>
                                <div class="form-group">
                                    <label for="edit_name">Nume:</label>
                                    <input class="form-control " id="edit_name" type="text" name="edit_location" placeholder="{{ $event['location'] }}" value="{{ $event['location'] }}">
                                </div>
                                <div class="form-group">
                                    <label for="edit_name">Data:</label>
                                    <input class="form-control " id="edit_date" type="text" name="edit_day" placeholder="{{ $event['day'] }}" value="{{ $event['day'] }}">
                                </div>
                                <div class="form-group">
                                    <label for="edit_name">Ora inceput:</label>
                                    <input class="form-control " id="edit_start_time" type="text" name="edit_start_time" placeholder="{{ $event['start_time'] }}" value="{{ $event['start_time'] }}">
                                </div>
                                <div class="form-group">
                                    <label for="edit_name">Ora sfarsit:</label>
                                    <input class="form-control " id="edit_end_time" type="text" name="edit_end_time" placeholder="{{ $event['end_time'] }}" value="{{ $event['end_time'] }}">
                                </div>
                                <div class="form-group">
                                    <label for="edit_name">Public:</label>
                                    <select class="form-control " id="edit_public" name="edit_public">
                                        <option value="da" {{ $event['public'] ? 'selected' : ''}}>Da</option>
                                        <option value="nu" {{ $event['public'] ? '' : 'selected'}}>Nu</option>
                                    </select>
                                </div>
                                {{--<div class="form-group">--}}
                                    {{--<textarea rows="2" class="form-control" placeholder="CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan"></textarea>--}}
                                {{--</div>--}}
                            </div>
                            <div class="modal-footer ">
                                <button type="submit" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Salveaza</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>

                <div class="modal fade" id="delete-{{ $event['id'] }}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                                <h4 class="modal-title custom_align" id="Heading">Stergere {{ $event['name']}}</h4>
                            </div>
                            <div class="modal-body">

                                <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Esti sigur ca vrei sa stergi evenimentul {{ $event['name']}}?</div>

                            </div>
                            <div class="modal-footer ">
                                <button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Da</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Nu</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            @endforeach
        </div>
    @endsection

@section('scripts')

<script>
$(document).ready(function() {
    // Calendar feature
    $.get('/ajax/eventsForCalendar', function(data) {
        console.log(data);
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            defaultDate: moment(),
            defaultView: 'month',
            events: data,
            dayClick: function(date, allDay, jsEvent, view) {
                if (allDay) {
                    var toDate = new Date(date);
                    // Clicked on the entire day
                    $('#calendar')
                        .fullCalendar('changeView', 'agendaDay');
                    $('#calendar').fullCalendar('gotoDate', toDate);
                }
            }
        });
    });

    /*
     * Add event javascript
     */
    $('#add-event #date').bootstrapMaterialDatePicker({
        time: false,
        clearButton: true
    });
    $('#add-event #start_time').bootstrapMaterialDatePicker({
        date: false,
        shortTime: false,
        format: 'HH:mm'
    });
    $('#add-event #end_time').bootstrapMaterialDatePicker({
        date: false,
        shortTime: false,
        format: 'HH:mm'
    });

    $('.modal-content #edit_date').bootstrapMaterialDatePicker({
        time: false,
        clearButton: true
    });
    $('.modal-content #edit_start_time').bootstrapMaterialDatePicker({
        date: false,
        shortTime: false,
        format: 'HH:mm'
    });
    $('.modal-content #edit_end_time').bootstrapMaterialDatePicker({
        date: false,
        shortTime: false,
        format: 'HH:mm'
    });
    /*
     * Events Table select all
     */

    $("#mytable #checkall").click(function() {
        if ($("#mytable #checkall").is(':checked')) {
            $("#mytable input[type=checkbox]").each(function() {
                $(this).prop("checked", true);
            });

        } else {
            $("#mytable input[type=checkbox]").each(function() {
                $(this).prop("checked", false);
            });
        }
    });

    $("[data-toggle=tooltip]").tooltip();
});
</script>
@endsection
