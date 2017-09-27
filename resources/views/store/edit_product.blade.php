@extends('store.base')

@section('content')
    <div id="product-details">
        <h4 class="text-center">EDIT PRODUCT</h4>

        <hr>

        <div class="cc-content">
            <form action="{{ route('update_product', $product->id) }}" method="post" class="form-horizontal" id="product-edit-form">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('productName') ? ' has-error' : '' }}">
                    <label for="product-name" class="col-xs-4 control-label">Product Name:</label>

                    <div class="col-xs-8">
                        <input type="text" name="productName" value="{{ old('productName') ?: $product->name }}" id="product-name" class="form-control" required autofocus>

                        @if($errors->has('productName'))
                            <span class="help-block"><strong>{{ $errors->first('productName') }}</strong></span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('categoryId') ? ' has-error' : '' }}">
                    <label for="category" class="col-xs-4 control-label">Category:</label>

                    <div class="col-xs-8">
                        <select name="categoryId" id="category" class="form-control">
                            <option value="{{ $product->category->id }}">{{ $product->category->name }}</option>

                            @foreach ($categories as $category)
                                @if ($category->id !== $product->category->id)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endif
                            @endforeach
                        </select>

                        @if($errors->has('categoryId'))
                            <span class="help-block"><strong>{{ $errors->first('categoryId') }}</strong></span>
                        @endif
                    </div>

                    <div class="col-xs-8 col-xs-offset-4">
                        <a href="{{ route('create_category').'?next=/'.request()->path() }}" class="btn btn-primary btn-sm" style="margin-top: 10px;"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;New Category</a>
                    </div>
                </div>


                <div class="form-group{{ $errors->has('markedPrice') ? ' has-error' : '' }}">
                    <label for="marked-price" class="col-xs-4 control-label">Marked Price (Ksh):</label>

                    <div class="col-xs-8">
                        <input type="text" name="markedPrice" value="{{ old('markedPrice') ?: $product->selling }}" id="marked-price" class="form-control" required>

                        @if($errors->has('markedPrice'))
                            <span class="help-block"><strong>{{ $errors->first('markedPrice') }}</strong></span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description" class="col-xs-4 control-label">Description:</label>

                    <div class="col-xs-8">
                        <textarea name="description" rows="5" id="description" class="form-control">{{ old('description') ?: $product->description }}</textarea>

                        @if($errors->has('description'))
                            <span class="help-block"><strong>{{ $errors->first('description') }}</strong></span>
                        @endif
                    </div>
                </div>

                <div class="col-xs-8 col-xs-offset-4">
                    <button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-floppy-saved"></span>&nbspUpdate</button>

                    <a href="{{ route('delete_product', $product->id) }}" type="submit" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span>&nbsp;Delete</a>
                </div>
            </form>
        </div>
    </div>
@endsection
