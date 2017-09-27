@extends('store.base')

@section('content')
    <div id="products">
        <h4 class="text-center">PRODUCTS</h4>

        <hr>

        <div class="dropdown" style="float: right;">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle btn btn-default btn-sm"><span class="glyphicon glyphicon-filter"></span>&nbsp;Filter&nbsp;<span class="glyphicon glyphicon-menu-down"></span></a>

            <ul class="dropdown-menu dropdown-menu-right">
                @foreach ($categories as $category)
                    <li><a href="{{ route('filter_products',  $category->id) }}">{{ $category->name }}</a></li>
                @endforeach
            </ul>
        </div>

        <div style="float: right;">
            <a href="{{ route('create_product') }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;New Product</a>
        </div>

        <hr style="clear: both;">

        <div>
            @if ($products->isEmpty())
                <div class="alert alert-info text-center cc-info">
                    <span class="glyphicon glyphicon-info-sign"></span>&nbsp;
                    <span><strong>No products found!</strong></span>
                </div>
            @else
                <table class="table table-hover table-bordered table-striped">
                    <caption>
                        <h5>Items in stock today, {{ date('d-m-Y H:i:s') }}: <strong>{{ count($products) }} {{ str_plural('product', count($products)) }}</strong> | Showing Category: <strong>{{ $filter }}</strong></h5>
                    </caption>

                    <thead>
                        <tr>
                            <th>Item</th>

                            <th>Qty In Stock</th>

                            <th>Marked Price (Ksh)</th>

                            <th>Description</th>

                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($products as $product)
                            <tr class="show-actions">
                                <td>{{ $product->name }}</td>

                                <td>{{ $product->stock->qty }}</td>

                                <td>{{ number_format($product->selling, 2) }}</td>

                                <td>
                                    @if (strlen($product->description) <= 50)
                                        {{ $product->description }}
                                    @else
                                        {{ str_limit($product->description, 50) }}

                                        <div class="dropdown" style="float: right;">
                                            <a href="#" data-toggle="dropdown" class="dropdown-toggle btn btn-default btn-sm"><em>more</em></a>

                                            <div class="dropdown-menu dropdown-menu-right" style="width: 600px;">
                                                <div class="panel-body">
                                                    <p class="">{{ $product->description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </td>

                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('add_to_cart').'?product_id='.$product->id }}" class="btn btn-success btn-sm cc-add-to-cart"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;Cart</a>

                                        <a href="{{ route('edit_product', $product->id) }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit"></span>&nbsp;Edit</a>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-center">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
