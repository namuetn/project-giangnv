<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->only([
            'name',
            'content',
            'quantity',
            'price',
        ]);

        $data['user_id'] = auth()->id();

        try {
            $product = Product::create($data);
        } catch (\Exception $e) {
            \Log::error($e);

            return back()->withInput($data)->with('status', 'Create failed!');
        }

        return redirect('products/' . $product->id)->with('status', 'Create success!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        $data = ['product' => $product];

        return view('products.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $data = $request->only([
            'name',
            'content',
            'quantity',
            'price',
        ]);

        $product = Product::findOrFail($id);

        try {
            $product->update($data);
        } catch (\Exception $e) {
            \Log::error($e);

            return back()->with('status', 'Update faild.');
        }

        return redirect('products/' . $product->id)->with('status', 'Update success.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        try {
            $product->delete();
        } catch (\Exception $e) {
            \Log::error($e);

            return back()->with('status', 'Delete faild.');
        }

        return redirect('products')->with('status', 'Delete success');
    }
}
