<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProdcutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            //'name', 'category_id ', 'unit', 'price' with("categories")->
            $item = Product::get();

            return view( 'pages.prodcut', compact('item') );

        }catch( \Exception $e ){
            Log::debug($e->getMessage());
            return redirect()->back()->withErrors( trans("auth.failed") );
        }
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
        try {
            $res = $request->only( 'name', 'category_id', 'unit', 'price' );

            Product::create($res);
            
            return redirect()->back();

        }catch( \Exception $e ){
            Log::debug($e->getMessage());
            return redirect()->back()->withErrors( trans("auth.failed") );
        }
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
        try {
            
            $res = $request->only( 'name', 'category_id', 'unit', 'price' );

            $item = Product::find($id)->update( $res );

            return redirect()->back();

        }catch( \Exception $e ){
            Log::debug($e->getMessage());
            return redirect()->back()->withErrors( trans("auth.failed") );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            
            $item = Product::where('id',$id)->delete();

            return redirect()->back();

        }catch( \Exception $e ){
            dd($e );
            Log::debug($e->getMessage());
            return redirect()->back()->withErrors( trans("auth.failed") );
        }
    }
}
