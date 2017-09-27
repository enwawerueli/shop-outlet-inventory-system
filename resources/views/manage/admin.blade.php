@extends('store.base')

@section('content')
    <div id="admin">
        <h4 style="text-align: center;">SYSTEM MANAGEMENT</h4>

        <hr>

        <div class="cc-content">
            <div id="manage-users">
                <h4>Users</h4>

                <ul class="list-group">
                    @foreach ($users as $user)
                        <a href="{{ route('user_profile', $user->id) }}" class="list-group-item">
                            {{ $user->name }}

                            @if ($user->is_admin)
                                <span style="float: right; color: #008000;">[ Admin ]</span>
                            @endif
                        </a>
                    @endforeach
                </ul>

                <a href="{{-- {{ route('create_user') }} --}}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;New User</a>
            </div>
        </div>

        <hr>

        <div class="cc-content">
            <div id="manage-store">

            </div>
        </div>
    </div>
@endsection
