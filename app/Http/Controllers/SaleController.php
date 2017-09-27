<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;

class SaleController extends Controller
{
    /**
     * Display listing of daily sales.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $template = 'store.sales';
        $period = ['today' => date('Y-m-d'),];
        $sales = Sale::with('product')->whereDate('created_at', $period['today'])->paginate(10);
        $totalSales = $sales->sum('amount');
        return view($template)->with(compact('period', 'sales', 'totalSales'));
    }

    /**
     * Display listing of sales over requested period.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function history(Request $request)
    {
        $template = 'store.sales';
        $period = ['from' => $request->get('fromDate'), 'to' => $request->get('toDate'),];
        $sales = Sale::with('product')->whereBetween('created_at', [$period['from'], $period['to'],])->paginate(10);
        $totalSales = $sales->sum('amount');
        return view($template)->with(compact('period', 'sales', 'totalSales'));
    }

    public function publish()
    {
        $pdf = App::make('dompdf.wrapper');
        # code...
    }
}
