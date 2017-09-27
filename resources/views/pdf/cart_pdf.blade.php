@extends('pdf.base')

@section('content')
    <div class="container" style="width: 100%;">
        <div class="row text-center">
            <div class="col-xs-12">
                <h4>SALE RECEIPT</h4>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-xs-1">
               <span>&nbsp;</span>
            </div>

            <div class="col-xs-4">
               <span><strong>Item</strong></span>
            </div>

            <div class="col-xs-2">
                <span><strong>Units</strong></span>
            </div>

            <div class="col-xs-2">
                <span><strong>Total (Ksh)</strong></span>
            </div>
        </div>

        <hr>

        <?php $count = 1; ?>
        @foreach(Cart::content() as $item)
            <div class="row">
                <div class="col-xs-1">
                   <span>{{ $count }}.&nbsp;</span>
                </div>

                <div class="col-xs-4">
                   <span>{{ $item->name }}</span>
                </div>

                <div class="col-xs-2">
                    <span>{{ $item->qty }}</span>&nbsp;&times;&nbsp;<span>{{ $item->price }}</span>
                </div>

                <div class="col-xs-2">
                    <span>{{ $item->total }}</span>
                </div>
            </div>
            <?php $count++; ?>
        @endforeach

        <hr>

        <div class="row">
            <div class="col-xs-1">
                <span>&nbsp;</span>
            </div>

            <div class="col-xs-4">
                <span><strong>Subtotal</strong></span>
            </div>

            <div class="col-xs-2">
                <span>&nbsp;</span>
            </div>

            <div class="col-xs-2">
                <span><strong>{{ Cart::subtotal() }}</strong></span>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-1">
                <span>&nbsp;</span>
            </div>

            <div class="col-xs-4">
                <span><strong>Tax</strong></span>
            </div>

            <div class="col-xs-2">
                <span>&nbsp;</span>
            </div>

            <div class="col-xs-2">
                <span><strong>{{ Cart::tax() }}</strong></span>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-1">
                <span>&nbsp;</span>
            </div>

            <div class="col-xs-4">
                <span><strong>Grand Total</strong></span>
            </div>

            <div class="col-xs-2">
                <span>&nbsp;</span>
            </div>

            <div class="col-xs-2">
                <span><strong>{{ Cart::total() }}</strong></span>
            </div>
        </div>

        <hr>

        <div class="row text-center">
            <div class="col-xs-12">
                <p>Printed at: <strong>{{ date('Y-m-d H:i:s') }}</strong></p>
            </div>
        </div>
    </div>
@endsection
