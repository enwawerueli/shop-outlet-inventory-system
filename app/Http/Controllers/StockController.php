<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Stock;
use App\Validators\Validator;
use App\Notifications\Notification;

class StockController extends BaseController
{
    use Notification;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $template = 'store.stocks';
        $stockValue = Stock::sum('value');
        return view($template)->with(compact('stockValue'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($productid)
    {
        $template = 'store.edit_stock';
        $product = Product::with('stock')->find($productid);
        return view($template)->with(compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Validator $validator, $productId)
    {
        $input = $request->all();
        if (!$validator->validate($input)) {
            $errors = $validator->errors();
            return back()->WithErrors($errors)->withInput($input);
        }
        $stock = Stock::whereProductId($productId)->first();
        $updated = $stock->update([
            'qty' => $request->get('quantity') ?: $stock->qty,
            'min_qty' => $request->get('re-orderQuantity') ?: $stock->min_qty,
        ]);
        if ($updated) {
            $this->notify('success', 'Stock has been updated successfully.');
        } else {
            $this->notify('error', 'Stock could NOT be updated.');
        }
        return back();
    }

    public function publish()
    {
        $pdf = App::make('dompdf.wrapper');
        # code...
    }
}
