<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Category;
use App\Validators\Validator;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $template = 'store.products';
        $filter = 'All Categories';
        return view($template)->with(compact('filter'));
    }

    public function filter($categoryId)
    {
        $template = 'store.products';
        $filter = Category::find($categoryId)->name;
        $products = Product::with('stock')->whereCategoryId($categoryId)->orderBy('name')->paginate(10);
        return view($template)->with(compact('products', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $template = 'store.create_product';
        return view($template);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Validator $validator)
    {
        $input = $request->all();
        if (!$validator->validate($input)) {
            $errors = $validator->errors();
            return back()->withErrors($errors)->withInput($input);
        }
        DB::transaction(function() use($request)
        {
            $product = Product::create([
                'name' => $request->get('productName'),
                'category_id' => $request->get('categoryId'),
                'buying' => $request->get('costPrice'),
                'selling' => $request->get('markedPrice'),
                'description' => $request->get('description'),
            ]);
            $stock = Stock::create([
                'product_id' => $product->id,
                'qty' => $request->get('quantity'),
                'min_qty' => $request->get('re-orderQuantity'),
                'value' => $request->get('costPrice') * $request->get('quantity'),
            ]);
            if ($product && $stock) {
                $this->notify('success', 'Product has been added successfully.');
            } else {
                $this->notify('failed', 'Product could NOT be added.');
            }
        });
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($productId)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($productId)
    {
        $template = 'store.edit_product';
        $product = Product::with('stock')->find($productId);
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
        $validator->rules['productName'] = 'sometimes|required|string';
        if (!$validator->validate($input)) {
            $errors = $validator->errors();
            return back()->withErrors($errors)->withInput($input);
        }
        $product = Product::find($productId);
        $updated = $product->update([
            'name' => $request->get('productName') ?: $product->name,
            'category_id' => Category::find($request->get('categoryId'))->id ?: $product->category_id,
            'selling' => $request->get('markedPrice') ?: $product->selling,
            'description' => $request->get('description') ?: $product->description,
        ]);
        if ($updated) {
            $this->notify('success', 'Product has been updated successfully.');
        } else {
            $this->notify('failed', 'Product could NOT be updated.');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($productId)
    {
        $deletedRows = Product::destroy($productId);
        if ($deletedRows == 1) {
            $this->notify('success', 'Product has been deleted successfully.');
        } else {
            $this->notify('failed', 'Product could NOT be deleted.');
        }
        return redirect(route('products_index'));
    }
}
