<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory as View;
use App\Models\Product;
use App\Models\Category;
use App\Messages\Message;

class BaseController extends Controller
{
    use Message;

    public function __construct(View $view)
    {
        $view->share([
            'products'=> Product::with('stock')->orderBy('name')->paginate(10),
            'categories'=> Category::orderBy('name')->get(),
        ]);
    }
}
