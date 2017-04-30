<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <title>{{ config('app.name') }}</title>
    </head>
    <body>
        <div class="wrapper" style="height: auto;">
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" id="main-logo" href="#">Food Guru</a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Settings</a></li>
                            <li><a href="#">Profile</a></li>
                        </ul>
                        <form class="navbar-form navbar-right">
                            <input type="text" id="recipe-search" class="form-control" placeholder="Search...">
                        </form>
                    </div>
                </div>
            </nav>
            <div id="sidebar" class="col-sm-3 col-md-2 sidebar">
                <div class="user-panel">
                    <img class="img-circle" src="/image/user/default" alt="">
                    <p class="user-name">{{--{{ Auth::user()->name }}--}}{{ 'Prenume Nume' }}</p>
                </div>

                <hr>

                <ul id="sidebar-menu" class="nav nav-sidebar">
                    @foreach($sidebar_items as $sidebar_item)
                        <li class="{{ $sidebar_item['route'] == 'view/home' ? 'active' : '' }} sidebar-item">
                            <a href="{{ $sidebar_item['route'] }}">
                                <img src="{{ '/image/base/sidebarIcon/' . $sidebar_item['image'] }}" alt="">
                                <p>{{ $sidebar_item['name'] }}</p>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
