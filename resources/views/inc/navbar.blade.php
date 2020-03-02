@if(Auth::user())
    <nav class="navbar navbar-expand-md shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img class="logo" src="{{asset('images/logo.png')}}">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/customers')}}"><img class="nav-image" src="{{asset('images/customer.png')}}"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/tasks')}}"><img class="nav-image" src="{{asset('images/tasks.png')}}"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/contacts')}}"><img class="nav-image" src="{{asset('images/contact.png')}}"></a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        {{-- @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif  --}}
                    @else
                    @if (Auth::user()->user_role == 3)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/register') }}"><img class="nav-image" src="{{asset('images/support.png')}}"></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/imports') }}"><img class="nav-image" src="{{asset('images/import.png')}}"></a>
                        </li>
                    @endif
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img class="nav-image" src="{{asset('images/man.png')}}"> <span class="caret"></span>
                            </a>

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
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
@endif