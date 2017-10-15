@extends('store.base')

@section('content')
    <div id="add-category" class="cc-3q">
        <form action="{{ route('store_category').'?next='.$next }}" method="post" class="form-horizontal">
            {{ csrf_field() }}

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="text-center"><strong>Category Details:</strong></h5>
                </div>

                <div class="panel-body cc-3q">
                    <div class="form-group {{ $errors->has('categoryName') ? 'has-error' : '' }}">
                        <label for="category" class="col-xs-4 control-label">Category Name:</label>

                        <div class="col-xs-8">
                            <input type="text" name="categoryName" id="category" value="{{ old('categoryName') }}" class="form-control" required autofocus>

                            @if ($errors->has('categoryName'))
                                <span class="help-block">{{ $errors->first('categoryName') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description" class="col-xs-4 control-label">Description:</label>

                        <div class="col-xs-8">
                            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>

                            @if($errors->has('description'))
                                <span class="help-block"><strong>{{ $errors->first('description') }}</strong></span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="panel-footer text-center">
                    <button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Save</button>

                    <a href="{{ url($next) }}" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-remove"></span>&nbsp;Cancel</a>
                </div>
            </div>
        </form>
    </div>
@endsection
