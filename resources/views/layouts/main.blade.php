<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }}</title>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
        @yield('head')

        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>
    </head>
    <body>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" id="main-logo" href="/view/home">Food Guru</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <div class="hide-desktop">
                        <ul class="nav navbar-nav navbar-right">
                            @foreach($sidebar_items as $sidebar_item)
                                <li class="{{ $sidebar_item['route'] == 'view/home' ? 'active' : '' }} mobile-nav">
                                    <a href="{{ $sidebar_item['route'] }}">
                                        <img src="{{ '/image/base/sidebarIcon/' . $sidebar_item['image'] }}" alt="">
                                        <p>{{ $sidebar_item['name'] }}</p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <form class="navbar-form navbar-right" action="">
                            {{--<input type="text" id="navbar-recipe-search" class="form-control" placeholder="Cauta reteta...">--}}
                            <div class="input-group">
                                <input type="text" id="navbar-recipe-search" class="form-control" placeholder="Cauta Reteta...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default navbar-search-button" type="submit">Cauta</button>
                                </span>
                            </div><!-- /input-group -->
                        </form>
                    </div>
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->first_name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div id="sidebar" class="col-sm-2 col-md-2 sidebar">
                    <div id="user-panel">
                        <img class="img-circle" src="{{ Auth::user()->profileImageRoute() }}" alt="">
                        <div>
                            <p class="user-name"><span>Bun venit,</span> <br> {{ Auth::user()->first_name }}</p>
                        </div>
                        <form class="" action="">
                            {{--<input type="text" id="sidebar-recipe-search" class="form-control" placeholder="Cauta Reteta...">--}}
                            {{--<input type="submit" value="Cauta">--}}
                            <div class="input-group">
                                <input type="text" id="sidebar-recipe-search" class="form-control" placeholder="Cauta Reteta...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default sidebar-search-button" type="submit">></button>
                                </span>
                            </div><!-- /input-group -->
                        </form>
                    </div>

                    <ul id="sidebar-menu" class="nav nav-sidebar">
                        @foreach($sidebar_items as $sidebar_item)
                            <li class="{{ Request::is(substr($sidebar_item['route'], 1)) ? 'active' : '' }} sidebar-item">
                                <a href="{{ $sidebar_item['route'] }}">
                                    <img src="{{ '/image/base/sidebarIcon/' . $sidebar_item['image'] }}" alt="">
                                    <p>{{ $sidebar_item['name'] }}</p>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-sm-8 col-sm-offset-4 col-md-9 col-md-offset-3 col-lg-10 col-lg-offset-2">
                    @yield('content')
                </div>
            </div>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
        @yield('scripts')
    </body>
</html>
