<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory as View;
use App\Models\Product;
use App\Models\Category;

class BaseController extends Controller
{
    public function __construct(View $view)
    {
        $view->share([
            'products'=> Product::with('stock')->orderBy('name')->paginate(10),
            'categories'=> Category::orderBy('name')->get(),
        ]);
    }
}
