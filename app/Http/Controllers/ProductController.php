<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('products');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $product = new Product();
         $product->name = $request->has('name') ? $request->get('name') : '';
         $product->price = $request->has('price') ? $request->get('price') : '';
         $product->amount = $request->has('amount') ? $request->get('amount') : '';
         $product->is_active = true ;

         if($request->hasFile('images')){
             $files = $request->file('images');
             $imageLocation = array();
             $i = 0;
             foreach($files as $file){
                $extension = $file->getClientOriginalExtension();
                $filename = 'product_'. time() . '_'. ++$i . '.' . $extension;
                $location = '/images/uploads/';
                $file->move(public_path().$location, $filename);
                $imageLocation[] = $location.$filename;
             }
              $product->image = implode(',', $imageLocation);
              $product->save();
              return back()->with('success', 'Product added successfully');
         }else{
            return back()->with('error', 'Product was not saved successfully');
         }

         $product->save();
         return back()->with('success', 'Product added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
