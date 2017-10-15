@extends('layouts.app')

@section('main')
    <div class="cc-cart">
        <a href="{{ route('show_cart') }}" class="btn btn-success btn-sm">
            <span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;
            Shopping Cart&nbsp;
            <span class="badge cc-cart-item-count">{{ Cart::count() }}</span>
        </a>
    </div>

    @if (session('notification'))
        <div class="modal fade" id="notification">
            <div class="modal-dialog">
                <div class="modal-content text-center">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                        @if (session('notification')['status'] == 'success')
                            <h3 class="modal-title" style="color: #008000;"><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Success!</h3>
                        @elseif (session('notification')['status'] == 'info')
                            <h3 class="modal-title" style="color: #31708f;"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;Notice!</h3>
                        @elseif (session('notification')['status'] == 'failed')
                            <h3 class="modal-title" style="color: #B22222;"><span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Failed!</h3>
                        @elseif (session('notification')['status'] == 'warning')
                            <h3 class="modal-title" style="color: #B8860B;"><span class="glyphicon glyphicon-warning-sign"></span>&nbsp;Warning!</h3>
                        @elseif (session('notification')['status'] == 'restricted')
                            <h3 class="modal-title" style="color: #B22222;"><span class="glyphicon glyphicon-ban-circle"></span>&nbsp;Restricted!</h3>
                        @endif
                    </div>

                    <div class="modal-body alert-{{ session('notification')['status'] }}">
                        <p>{{ session('notification')['message'] }}</p>
                    </div>

                    <div class="modal-footer">
                        @if (session('notification')['dialog'] == 'confirm')
                            <a href="{{ session('continue') }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-circle-arrow-right"></span>&nbsp;Continue</a>

                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>&nbsp;Cancel</button>
                        @else
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><span class="glyphicon glyphicon-remove-sign"></span>&nbsp;Close</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Name -->
                <a class="navbar-brand cc-brand" href="{{ route('products_index') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                        <li class="active"><a href="{{ route('products_index') }}">PRODUCTS</a></li>

                        <li><a href="{{ route('sales_index') }}">SALES</a></li>

                        {{-- <li><a href="">ORDERS</a></li> --}}

                        <li><a href="{{ route('stocks_index') }}">STOCKS</a></li>

                        @if (request()->user()->hasPermission('admin'))
                            <li><a href="{{ route('manage') }}">MANAGE</a></li>
                        @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span style="width: 25px; height: 25px;">
                                <img src="{{ asset('images/avatar.png') }}" class="img-circle" alt="profile image" style="width: inherit; height: inherit;">
                            </span>&nbsp;
                            {{ Auth::user()->name }}&nbsp;
                            <span class="glyphicon glyphicon-menu-down"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <span class="glyphicon glyphicon-log-out"></span>&nbsp;
                                    Logout
                                </a>

                                <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>

                            <li><a href="{{ route('user_profile', request()->user()->id) }}"><span class="glyphicon glyphicon-cog"></span>&nbsp;Profile</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body">
                @yield('content')
            </div>
        </div>
    </div>
@endsection
