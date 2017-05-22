@extends ('layouts.main')

@section ('content')
    <h1 class="page-header">{{ $circle->name }}</h1>
    <div id="circle-container">
    <div id="member-list">
        
        @if (auth()->user()->id == $circle->user_id)
            @foreach ($users as $user)

                <div>
                    <form action="/circle/{{ $circle->id }}" method="POST">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger glypchicon glyphicon-minus" name="user_id" value="{{ $user->id }}"></button>
                    </form>

                    <span>{{ $user->first_name }} {{ $user->last_name }}</span>
                </div>

            @endforeach

        @else
            @foreach ($users as $user)

                <div>
                    <span>{{ $user->first_name }} {{ $user->last_name }}</span>
                </div>

            @endforeach

        @endif


    </div>
    @if (auth()->user()->id == $circle->user_id)

        <div id="add-member">
        <form action="/circle/{{ $circle->id }}" method="POST">

            {{ csrf_field() }}
            <input type="text" name="username" maxlength="511" placeholder="Adauga un membru">
            <button type="submit" class="btn btn-success glyphicon glypchicon-plus">+</button>

        </form>

        </div>

    @endif
    </div>
    
    <div id="circle-panel">
        
        <span>Membri: <i>{{ count($circle->users) }}</i></span><hr>
        <span>Admin: <i>{{ $circle->owner->first_name . ' ' . $circle->owner->last_name }}</i></span>
        @if (in_array(auth()->user()->id,$circle->users->pluck('id')->toArray()))
        <hr>
        <span>Cercul este <i>{{ ($circle->public)?'public':'privat' }}</i>.</span>
        <form action="/circle/{{ $circle->id }}" method="POST">
            {{ csrf_field() }}
            <button type="submit" name="public" value="1">Schimba in {{ ($circle->public)?'privat':'public' }}</button>
        </form><br><br><br><br>
        @if ($circle->owner->id == auth()->user()->id)
        <form action="/circle/delete/{{ $circle->id }}" method="POST">
            {{ csrf_field() }}
        <button class="btn btn-danger"type="submit">Sterge cercul</button>
        </form>
        @else
        <form action="/circle/{{ $circle->id }}" method="POST">
            {{ csrf_field() }}
        <button class="btn btn-danger"type="submit" name="leave_circle" value="{{ auth()->user()->id }}">Paraseste cercul</button>
        </form>
        @endif
        @endif
 
    </div>
    @if ($errors->any())
        <ul id="circle-errors">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

    @endif

@endsection
