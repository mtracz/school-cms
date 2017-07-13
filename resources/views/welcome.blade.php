@extends("master")

@section("content")

    <div class="ui container">
        <p>
            welcome master
        </p>
    </div>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #111;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
               <p>
                LOG: <br>
                {{-- {!! $log->action !!} --}}
                <br>
                {{-- {{$log->created_at}} --}}
                </p>
                <br><br>
                <div class="title m-b-md">
                    Laravel
                </div>
                {{Auth::user()}}
                <br>
                {{-- LOGOUT --}}
                @if(Auth::user())
                <a class="item logout" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">              
                    <i class="sign out icon"></i>
                    WYLOGUJ
                    <form id="logout-form"
                        action="{{ route("logout.post") }}" 
                        method="post"
                        style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </a>
                @endif
                {{-- //////////////// --}}

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html>

@endsection

