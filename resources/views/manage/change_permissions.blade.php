@extends('store.base')

@section('content')
    <div id="user-profile" class="cc-3q">
        <form action="{{ route('apply_permissions', $user->id) }}" method="post">
            {{ csrf_field() }}

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="text-center"><strong>Check/Uncheck permissions for user: [ {{ $user->name }} ]</strong></h5>
                </div>

                <div class="panel-body cc-3q">
                    <div class="alert alert-info">
                        <p>Note: Permissions are ordered according to their privillege level. A permission lower in this list automatically includes all others occurring before it.</p>
                    </div>

                    <ul class="list-group">
                        @foreach ($permissions as $permission)
                            <li class="list-group-item {{ $user->hasPermission($permission->action) ? ' list-group-item-success' : '' }}">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="{{ $permission->action }}" value="{{ $permission->id }}" {{ $user->hasPermission($permission->action) ? ' checked' : '' }}><strong>{{ title_case($permission->action) }}</strong>
                                    </label>
                                </div>

                                <p class="list-group-item-text">{{ $permission->description }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="panel-footer text-center">
                    <button type="submit" class="btn btn-primary btn-sm">Apply</button>
                </div>
            </div>
        </form>
    </div>
@endsection
