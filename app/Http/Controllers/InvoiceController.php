<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Invoice;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Auth;
use DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $user = Auth::user();
            $item = Product::with('categories')->orderBy('category_id')->orderBy('created_at')->get();
            $invoice = Invoice::where('user_id',  $user->id)->with([ 'prodcuts', 'categories' ])->get();
            return view( 'pages.invoice', compact('item', 'invoice') );

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
            DB::beginTransaction();
            $res = $request->all();
            
            unset(  $res['customer_name']  );
            unset(  $res['_token']  );
            
            $user = Auth::user();

            $code = $user->id . Carbon::now()->format("Ymdis");

            $res = collect( $res )->filter(function ( $val ) { return ( (int) $val['quantity'] > 0 ); });

            $product = Product::whereIn( 'id', $res->map( function($p){ return $p['id']; } )->all() )->get();

            $record = $res->map( function($p) use($product, $code, $request, $user ) { 
                               
                                    $p1 = $product->filter( function($e) use($p) {  return ($e->id == $p['id']) ; } )->first();

                                    return [ 
                                            'user_id' =>  $user->id,
                                            'product_id' => $p1->id, 
                                            'code' => $code,
                                            'customer_name' => $request->customer_name, 
                                            'quantity' => $p['quantity'], 
                                            'amount' => (float) ((int)$p['quantity'] * (float) $p1->price ),
                                            'created_at' => Carbon::now()
                                            ]; 
                                  
                            });

            Invoice::insert( $record->toArray() );
            
            DB::commit();
            
            return redirect()->back();

        }catch( \Exception $e ){
            DB::rollback();
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($code)
    {
        try {
            DB::beginTransaction();
            
            Invoice::where( 'code', $code )->delete();
            DB::commit();
            
            return redirect()->back();

        }catch( \Exception $e ){
            DB::rollback();
            Log::debug($e->getMessage());
            return redirect()->back()->withErrors( trans("auth.failed") );
        }
    }
}
