@extends('store.base')

@section('content')
    <div id="shopping-cart">
        <h4 class="text-center">SHOPPING CART</h4>

        <hr>

        @if (!$carts->isEmpty())
            <div class="dropdown" style="float: right;">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle btn btn-default btn-sm"><span class="glyphicon glyphicon-floppy-open"></span>&nbsp;Restore&nbsp;<span class="glyphicon glyphicon-menu-down"></span></a>

                <ul class="dropdown-menu dropdown-menu-right">
                    @foreach ($carts as $cart)
                        <li><a href="{{ route('restore_cart',  $cart->id) }}">{{ $cart->identifier }}</a></li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (Cart::count())
            <div class="dropdown" style="float: right;">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle btn btn-default btn-sm"><span class="glyphicon glyphicon-floppy-save"></span>&nbsp;Save&nbsp;<span class="glyphicon glyphicon-menu-down"></a>

                <div class="dropdown-menu dropdown-menu-right" style="width: 600px;">
                    <div class="panel-body">
                        <h4 class="text-center">Save cart as</h4>

                        <hr>

                        <form action="{{ route('save_cart') }}" method="post" class="form-horizontal">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="cart-identifier" class="col-xs-offset-2 col-xs-2 control-label">Name:</label>

                                <div class="col-xs-6">
                                    <input type="text" name="cartIdentifier" id="cart-identifier" class="form-control" required autofocus>
                                </div>
                            </div>

                            <div class="col-xs-6 col-xs-offset-4">
                                <button type="submit" class="btn btn-primary btn-sm"></span>Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif

        @if (!$carts->isEmpty() || Cart::count())
            <hr style="clear: both;">
        @endif

        @if (!Cart::count())
            <div class="alert alert-info text-center cc-info" style="clear: both; margin-top: 16px;">
                <span class="glyphicon glyphicon-info-sign"></span>&nbsp;

                <span><strong>Cart is empty!</strong></span>
            </div>
        @else
            <table class="table table-hover table-bordered table-striped" style="clear: both;">
                <caption>
                    <p>Shopping cart contents: <strong>{{ Cart::count() }} {{ str_plural('item', Cart::count()) }}</strong></p>
                </caption>

                <thead>
                    <tr>
                        <th>Item</th>

                        <th>Quantity</th>

                        <th>Unit Price (Ksh)</th>

                        <th>Total (Ksh)</th>

                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach(Cart::content() as $item)
                        <form action="{{ route('update_item', $item->rowId) }}" method="post">
                            {{ csrf_field() }}

                            <tr>
                                <td>{{ $item->name }}</td>

                                <td>
                                    <input type="text" name="qty" value="{{ $item->qty }}" class="form-control">
                                </td>

                                <td>{{ number_format($item->price, 2) }}</td>

                                <td>{{ number_format($item->total, 2) }}</td>

                                <td>
                                    <div class="btn-group">
                                        <button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Update</button>

                                        <a href="{{ route('remove_from_cart', $item->rowId) }}" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Remove</a>
                                    </div>
                                </td>
                            </tr>
                        </form>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="4">&nbsp;</td>

                        <th>Amount (Ksh)</th>
                    </tr>

                    <tr>
                        <td colspan="4"><strong>Subtotal</strong></td>

                        <td><strong>{{ Cart::subtotal() }}</strong></td>
                    </tr>

                    <tr>
                        <td colspan="4"><strong>Tax</strong></td>

                        <td><strong>{{ Cart::tax() }}</strong></td>
                    </tr>

                    <tr>
                        <td colspan="4"><strong>Grand Total</strong></td>

                        <td><strong>{{ Cart::total() }}</strong></td>
                    </tr>
                </tfoot>
            </table>

            <hr>

            <div class="text-center">
                <a href="{{ route('checkout') }}" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-usd"></span>&nbsp;Checkout</a>

                <a href="{{ route('empty_cart') }}" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span>&nbsp;Clear</a>

                <a href="{{ route('print_receipt') }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-print"></span>&nbsp;Print</a>
            </div>
        @endif
    </div>
@endsection
