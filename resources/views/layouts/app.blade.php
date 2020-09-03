<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script>
    -->
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  
    <!-- Styles -->
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{asset('css/select2.css')}}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        
                        <li class="dropdown">
                        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"  aria-expanded="false" v>
                                    Friend Requests <span class="caret"></span>
                                </a>

                        <ul class="dropdown menu" role="menu">
                        @foreach(Auth::user()->friends1->where('approved',"=",false) as $friend1)
                            <li>
                            <img src="{{$friend1->user1->profile_picture}}" alt="Profile Picture" width="50" height="50">
                            <div style="display:inline-block">
                            {{$friend1->user1->username}}
                            <div data-userid="{{$friend1->user1->id}}">
                            <a href="#" class="btn btn-success btn-sm request">Accept</a>
                            <a href="#" class="btn btn-danger btn-sm request">Cancel</a>
                            </div>
                            </div>
                            </li>
                        @endforeach
                        @if( count(Auth::user()->friends1->where('approved',"=",false))==0)
                            You dont have any friend requests

                        @endif
                        </ul>


                        </li>



                    



                        <li class="dropdown">
                        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"  aria-expanded="false" v>
                                    {{ Auth::user()->username }} <span class="caret"></span>
                                </a>

                        <ul>
                        <li><a href="{{url('/post')}}">Profile</li>
                        <li><a href="{{url('/category')}}">category</li>
                        <li><a href="{{url('/users')}}">Users</li>
                        <li>
                                    <a  href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                        </ul>


                        </li>


<!--                         
                        <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }} <span class="caret"></span>
                                </a>

                            
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                 <a class="dopdown_item" href="#">{{ __('Profile')}}</a>
                                 </div>

                                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>

                            </li>
                             -->
                            
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{asset('js/select2.js')}}" ></script>
    <script src="{{ asset('js/main.js') }}"></script>
 <script src="{{ asset('js/bootstrap.min.js') }}"></script>


</body>
</html>
