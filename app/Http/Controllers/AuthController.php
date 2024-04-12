<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\RateLimiter;
use Exception;
use Log;
use Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    const maxAttempts = 5;
    const decaySeconds  = 180;

    public function login( AuthRequest $request )
    {
        try {

            // if (RateLimiter::tooManyAttempts($this->throttleKey(), self::maxAttempts))
            //     return abort(429);

            if( Auth::attempt(['email' => $request->email, 'password' => $request->password], false ) ) {
                 $user = Auth::user();

                return redirect()->route('home');
            }
            
            // RateLimiter::hit($this->throttleKey(), self::decaySeconds);

            return redirect()->back()->withErrors( trans("auth.login_failed") );

        }catch( \Exception $e ){
            Log::debug($e->getMessage());
            return redirect()->back()->withErrors( trans("auth.failed") );
        }
    }

    public function index()
    {
        //
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
