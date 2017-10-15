@extends('store.base')

@section('content')
    <div id="create-product" class="cc-3q">
        <form action="{{ route('store_product') }}" method="post" class="form-horizontal">
            {{ csrf_field() }}

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="text-center"><strong>Product Details:</strong></h5>
                </div>

                <div class="panel-body cc-3q">
                    <div class="form-group{{ $errors->has('productName') ? ' has-error' : '' }}">
                        <label for="product-name" class="col-xs-4 control-label">Product Name:</label>

                        <div class="col-xs-8">
                            <input type="text" name="productName" value="{{ old('productName') }}" id="product-name" class="form-control" required autofocus>

                            @if($errors->has('productName'))
                                <span class="help-block"><strong>{{ $errors->first('productName') }}</strong></span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('categoryId') ? ' has-error' : '' }}">
                        <label for="category-id" class="col-xs-4 control-label">Product Category:</label>

                        <div class="col-xs-8">
                            <select name="categoryId" id="category-id" class="form-control">
                                <option value="0">Select...</option>

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>

                            @if($errors->has('categoryId'))
                                <span class="help-block"><strong>{{ $errors->first('categoryId') }}</strong></span>
                            @endif
                        </div>

                        @if (request()->user()->hasPermission('create'))
                            <div class="col-xs-8 col-xs-offset-4">
                                <a href="{{ route('create_category').'?next=/'.request()->path() }}" class="btn btn-primary btn-sm" style="margin-top: 10px;"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;New Category</a>
                            </div>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('costPrice') ? ' has-error' : '' }}">
                        <label for="cost-price" class="col-xs-4 control-label">Cost Price (Ksh):</label>

                        <div class="col-xs-8">
                            <input type="text" name="costPrice" value="{{ old('costPrice') }}" id="cost-price" class="form-control" required>

                            @if($errors->has('costPrice'))
                                <span class="help-block"><strong>{{ $errors->first('costPrice') }}</strong></span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('markedPrice') ? ' has-error' : '' }}">
                        <label for="marked-price" class="col-xs-4 control-label">Marked Price (Ksh):</label>

                        <div class="col-xs-8">
                            <input type="text" name="markedPrice" value="{{ old('markedPrice') }}" id="marked-price" class="form-control" required>

                            @if($errors->has('markedPrice'))
                                <span class="help-block"><strong>{{ $errors->first('markedPrice') }}</strong></span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description" class="col-xs-4 control-label">Description:</label>

                        <div class="col-xs-8">
                            <textarea name="description" rows="5" id="description" class="form-control">{{ old('description') }}</textarea>

                            @if($errors->has('description'))
                                <span class="help-block"><strong>{{ $errors->first('description') }}</strong></span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                        <label for="quantity" class="col-xs-4 control-label">Quantity:</label>

                        <div class="col-xs-8">
                            <input type="text" name="quantity" value="{{ old('quantity') }}" id="quantity" class="form-control" required>

                            @if($errors->has('quantity'))
                                <span class="help-block"><strong>{{ $errors->first('quantity') }}</strong></span>
                            @endif
                        </div>

                    </div>

                    <div class="form-group{{ $errors->has('re-orderQuantity') ? ' has-error' : '' }}">
                        <label for="re-order-quantity" class="col-xs-4 control-label">Re-order Quantity:</label>

                        <div class="col-xs-8">
                            <input type="text" name="re-orderQuantity" value="{{ old('re-orderQuantity') }}" id="re-order-quantity" class="form-control" required>

                            @if($errors->has('re-orderQuantity'))
                                <span class="help-block"><strong>{{ $errors->first('re-orderQuantity') }}</strong></span>
                            @endif
                        </div>

                    </div>
                </div>

                <div class="panel-footer text-center">
                    <button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection

