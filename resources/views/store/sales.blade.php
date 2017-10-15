@extends('store.base')

@section('content')
<div id="sales">
    <h4 class="text-center">SALES</h4>

    <hr>

    <div class="btn-group" style="float: right;">
        <a href="{{ route('sales_index') }}" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-time"></span>&nbsp;Today</a>

        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target='#get-sales-form'><span class="glyphicon glyphicon-calendar"></span>&nbsp;History&nbsp;</a>
    </div>

    <hr style="clear: both;">

    <div class="modal fade" id="get-sales-form">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('sales_history') }}" method="post" class="form-horizontal">
                    {{ csrf_field() }}

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                        <h4 class="modal-title text-center">Enter reporting period</h4>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="from-date" class="col-xs-2 col-xs-offset-2 control-label">From:</label>

                            <div class="col-xs-6">
                                <input name="fromDate" type="date" id="from-date" class="form-control" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="to-date" class="col-xs-2 col-xs-offset-2 control-label" required>To:</label>

                            <div class="col-xs-6">
                                <input name="toDate" type="date"  id="to-date" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm">Get Sales</button>

                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if ($sales->isEmpty())
        <div class="alert alert-info text-center cc-info">
            <span class="glyphicon glyphicon-info-sign"></span>&nbsp;

            <span><strong>No sales records found!</strong></span>
        </div>
    @else
        <table class="table table-hover table-bordered table-striped">
            <caption>
                @if (count($period) == 1)
                    <p>Today&#8217;s sales: <strong>{{ $period['today'] }}</strong></p>
                @else
                    <p>Sales records from: <strong>{{ $period['from'] }}</strong> to: <strong>{{ $period['to'] }}</strong></p>
                @endif
            </caption>

            <thead>
                <tr>
                    <th>Timestamp</th>

                    <th>Item</th>

                    <th>Quantity</th>

                    <th>Amount (Ksh)</th>
                </tr>
            </thead>

            <tbody>
                @foreach($sales as $sale)
                    <tr>
                        <td>{{ $sale->created_at }}</td>

                        <td>{{ $sale->product->name }}</td>

                        <td>{{ $sale->qty }}</td>

                        <td>{{ number_format($sale->amount, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>

            <tfoot>
                <tr>
                    <td colspan="3">&nbsp;</td>

                    <th>Amount (Ksh)</th>
                </tr>

                <tr>
                    <td colspan="3"><strong>Total Sales</strong></td>

                    <td><strong>{{ number_format($totalSales, 2) }}</strong></td>
                </tr>
            </tfoot>
        </table>

        <div class="text-center">
            {{ $sales->links() }}
        </div>

        <hr>

        @if (request()->user()->hasPermission('publish'))
            <div class="text-center">
                <a href="{{ route('print_sales') }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-print"></span>&nbsp;Print</a>
            </div>
        @endif
    @endif
</div>
@endsection
