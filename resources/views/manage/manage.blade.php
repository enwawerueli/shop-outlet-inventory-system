@extends('store.base')

@section('content')
    <div id="manage" class="cc-3q">
        <h4 class="text-center">SYSTEM MANAGEMENT</h4>

        <hr>
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="#users" data-toggle="collapse" data-parent="#accordion">
                        <h5 class="panel-title">Users</h5>
                    </a>
                </div>

                <div id="users" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <ul class="list-group">
                            @foreach ($users as $user)
                                <a href="{{ route('user_profile', $user->id) }}" class="list-group-item">{{ $user->name }}<span class="badge" style="padding: 5px;">{{ $user->hasPermission('admin') ? 'Admin' : '' }}</span></a>
                            @endforeach
                        </ul>
                        <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Create</a>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="#db" data-toggle="collapse" data-parent="#accordion">
                        <h5 class="panel-title">Database</h5>
                    </a>
                </div>

               <div id="db" class="panel-collapse collapse">
                   <div class="panel-body">
                       <a href="" class="btn btn-primary btn-sm">Create Backup</a>
                       <a href="" class="btn btn-danger btn-sm">Reset Database</a>
                   </div>
               </div>
            </div>
        </div>
    </div>
@endsection
