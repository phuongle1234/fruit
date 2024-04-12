<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;

class CateloryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $item = Category::get();
            return view( 'pages.catelory', compact('item') );

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
    public function create( Request  $request )
    {
        try {
            
            $res = $request->only( 'name' ) ;

            $item = Category::create( $res );

            return redirect()->back();

        }catch( \Exception $e ){
            Log::debug($e->getMessage());
            return redirect()->back()->withErrors( trans("auth.failed") );
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
            $res = $request->only( 'name' ) ;
            Category::where( ['id' => $id ] )->update( $res );
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
            Category::where( ['id' => $id ] )->delete( $id );
            return redirect()->back();
        }catch( \Exception $e ){
            Log::debug($e->getMessage());
            return redirect()->back()->withErrors( trans("auth.failed") );
        }
    }
}
