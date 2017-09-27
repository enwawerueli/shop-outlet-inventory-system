<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Validators\Validator;
use App\Notifications\Notification;

class CategoryController extends BaseController
{
    use Notification;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $template = 'store.create_category';
        $next = $request->get('next');
        return view($template)->with(compact('next'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Validator $validator)
    {
        $input = $request->except('next');
        $next = $request->get('next');
        if (!$validator->validate($input)) {
            $errors = $validator->errors();
            return back()->withErrors($errors)->withInput($input);
        }
        $category = Category::create(['name' => $request->get('categoryName'),]);
        if ($category) {
            $message = 'Category was added successfully. Choose from the category select menu.';
            $this->notify('success', $message);
        } else {
            $this->notify('error', 'Category could NOT be added.');
        }
        return redirect(url($next));
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
