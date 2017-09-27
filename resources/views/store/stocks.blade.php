@extends('store.base')

@section('content')
<div id="stocks">
    <h4 class="text-center">STOCKS</h4>

    <hr>

    @if ($products->isEmpty())
        <div class="alert alert-info text-center cc-info">
            <span class="glyphicon glyphicon-info-sign"></span>&nbsp;

            <span><strong>No stocks found!</strong></span>
        </div>
    @else
        <table class="table table-hover table-bordered table-striped">
            <caption>
                <p>Inventory as at: <strong>{{ date('d-m-Y H:i:s') }}</strong></p>
            </caption>

            <thead>
                <tr>
                    <th>Item</th>

                    <th>Qty In Stock</th>

                    <th>Unit Cost (Ksh)</th>

                    <th>Value (Ksh)</th>

                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($products as $product)
                    <tr class="show-actions">
                        <td>{{ $product->name }}</td>

                        <td>{{ $product->stock->qty }}</td>

                        <td>{{ number_format($product->buying, 2) }}</td>

                        <td>{{ number_format($product->stock->value, 2) }}</td>

                        <td>
                            <div class="btn-group">
                                <a href="{{ route('edit_stock', $product->id) }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit"></span>&nbsp;Edit</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>

            <tfoot>
                <tr>
                    <td colspan="4">&nbsp;</td>

                    <th>Value (Ksh)</th>
                </tr>

                <tr>
                    <td colspan="4"><strong>Total Inventory</strong></td>

                    <td><strong>{{ number_format($stockValue, 2) }}</strong></td>
                </tr>
            </tfoot>
        </table>
    @endif


    <div class="text-center">
        {{ $products->links() }}
    </div>

    <hr>

    <div class="text-center">
        <a href="{{ route('print_stocks') }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-print"></span>&nbsp;Print</a>
    </div>
</div>
@endsection
