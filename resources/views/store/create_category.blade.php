@extends('store.base')

@section('content')
    <div id="add-category">
        <h4 style="text-align: center;">NEW CATEGORY</h4>

        <hr>

        <div class="cc-content">
            <form action="{{ route('store_category').'?next='.$next }}" method="post" class="form-horizontal">
                {{ csrf_field() }}

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

                <div class="col-xs-8 col-xs-offset-4">
                    <button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Save</button>

                    <a href="{{ url($next) }}" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-remove"></span>&nbsp;Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
