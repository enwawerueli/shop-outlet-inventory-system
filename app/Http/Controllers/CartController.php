<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Sale;
use App\Models\Cart as CartModel;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Notifications\Notification;

class CartController extends Controller
{
    use Notification;

    public function add(Request $request)
    {
        $productId = $request->get('product_id');
        $product = Product::find($productId);
        Cart::add(['id'=> $product->id, 'name'=> $product->name, 'qty'=> 1, 'price'=> $product->selling,]);
        return $request->ajax() ? Cart::count() : back();
    }

    public function show()
    {
        $template = 'store.cart';
        $carts = CartModel::all();
        return view($template)->with(compact('carts'));
    }

    public function update(Request $request, $itemId)
    {
        $qty = $request->get('qty');
        if (preg_match('/^\d+$/', $qty)) { Cart::update($itemId, $qty); }
        return back();
    }

    public function remove($itemId)
    {
        Cart::remove($itemId);
        return back();
    }


    public function checkout()
    {
        foreach (Cart::content() as $item) {
            $stock = Stock::whereProductId($item->id)->first();
            $available = ($item->qty > $stock->qty) ? false : true;
            if (!$available) {
                $message = "You added {$item->qty} ".str_plural('unit', $item->qty)." of {$stock->product->name}.
                    {$stock->qty} ".str_plural('unit', $stock->qty)." available in stock.";
                $this->notify('failed', $message);
                return back();
            } else {
                $sold = $this->makeSale($item, $stock);
                if (!$sold) {
                    $this->notify('failed', 'Sale FAILED to complete.');
                    return back();
                }
            }
        }
        $this->notify('success', 'Sale has completed successfully.');
        Cart::destroy();
        return back();
    }


    protected function makeSale($item, $stock)
    {
        $return = false;
        DB::transaction(function() use($item, $stock, &$return) {
            $sale = Sale::create(['product_id'=> $item->id, 'qty'=> $item->qty, 'amount'=> $item->price * $item->qty,]);
            $updated = $stock->update(['qty'=> $stock->qty - $item->qty,]);
            if ($sale && $updated) { $return = true; }
        });
        return $return;
    }

    public function save(Request $request)
    {
        $identifier = $request->get('cartIdentifier');
        Cart::store($identifier);
        $this->notify('success', 'Cart has been saved successfully.');
        return back();
    }

    public function restore($cartId)
    {
        $identifier = CartModel::find($cartId)->identifier;
        Cart::restore($identifier);
        return back();
    }

    public function publish()
    {
        $pdf = App::make('dompdf.wrapper');
        $template = 'pdf.cart_pdf';
        $receipt = $pdf->loadView($template);
        return $receipt->stream();
    }

    public function destroy()
    {
        Cart::destroy();
        return back();
    }
}
