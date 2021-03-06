@extends('store.base')

@section('content')
    <div id="add-stock" class="cc-3q">
        <form action="{{ route('edit_stock', $product->id) }}" method="post" class="form-horizontal" id="stock-edit-form">
            {{ csrf_field() }}

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="text-center"><strong>Stock Details:</strong></h5>
                </div>

                <div class="panel-body cc-3q">
                    <div class="form-group">
                        <label for="product-name" class="col-xs-4 control-label">Product Name:</label>

                        <div class="col-xs-8">
                            <input type="text" name="productName" value="{{ $product->name }}" id="product-name" class="form-control" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="current-stock" class="col-xs-4 control-label">Quantity In Stock:</label>

                        <div class="col-xs-8">
                            <input name="currentStock" type="text" value="{{ $product->stock->qty }}" id="current-stock" class="form-control" disabled>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                        <label for="quantity" class="col-xs-4 control-label">Set Quantity:</label>

                        <div class="col-xs-8">
                            <input name="quantity" type="text" value="{{ old('quantity') ?: $product->stock->qty }}" id="quantity" class="form-control" required autofocus>

                            @if($errors->has('quantity'))
                                <span class="help-block"><strong>{{ $errors->first('quantity') }}</strong></span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('re-orderQuantity') ? ' has-error' : '' }}">
                        <label for="re-order-quantity" class="col-xs-4 control-label">Re-order Quantity:</label>

                        <div class="col-xs-8">
                            <input type="text" name="re-orderQuantity" value="{{ $product->stock->min_qty }}" id="re-order-quantity" class="form-control" required>

                            @if($errors->has('re-orderQuantity'))
                                <span class="help-block"><strong>{{ $errors->first('re-orderQuantity') }}</strong></span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="panel-footer text-center">
                    <button type="submit" formaction="{{ route('update_stock', $product->id) }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-floppy-saved"></span>&nbsp;Update</button>
                </div>
            </div>
        </form>
    </div>
@endsection
