@extends('store.base')

@section('content')
    <div id="user-profile" class="cc-3q">
        <form action="{{ route('update_profile', $user->id) }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="text-center"><strong>User Profile:</strong></h5>
                </div>

                <div class="panel-heading">
                    <div style="width: 120px; height: 120px; margin: auto; ">
                        <img src="{{ asset('images/avatar.png') }}" class="img-circle" alt="profile image" style="width: inherit; height: inherit; border: 1px solid #C0C0C0;">
                    </div>
                </div>

                <div class="panel-body cc-3q">
                    <div class="form-group">
                        <label for="username" class="control-label col-xs-4 ">Name:</label>
                        <div class="col-xs-6">
                            <input type="text" name="name" class="form-control" id="username" value="{{ $user->name }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="control-label col-xs-4">Email:</label>
                        <div class="col-xs-6">
                            <input type="text" name="email" class="form-control" id="email" value="{{ $user->email }}">
                        </div>
                    </div>
                </div>

                <div class="panel-footer text-center">
                    <button type="submit" class="btn btn-primary btn-sm">Update</button>

                    @if (request()->user()->isAdmin())
                        <a href="{{ route('change_permissions', $user->id) }}" class="btn btn-success btn-sm">Permissions</a>

                        <a href="{{ route('delete_user', $user->id) }}" class="btn btn-danger btn-sm">Delete</a>
                    @endif
                </div>
            </div>
        </form>
    </div>
@endsection
