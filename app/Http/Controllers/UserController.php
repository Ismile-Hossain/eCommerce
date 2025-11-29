<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $uName = $request->has('email') ? $request->get('email') : '';
        $pass = $request->has('pass') ? $request->get('pass') : '';

        $userInfo = User::where('email', $uName)->first();

        if (isset($userInfo) && !empty($userInfo) && Hash::check($pass, $userInfo->password)) {
            return redirect('/admin_products');
        } else {
            return redirect()->back()->with('error', 'Invalid Credentials');
        }


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
        User::insert([
            'name' => $request->has('uname') ? $request->get('uname') : '',
            'email' => $request->has('email') ? $request->get('email') : '',
            'mobile' => $request->has('mobile') ? $request->get('mobile') : '',
            'password' => bcrypt($request->has('pass') ? $request->get('pass') : '')
        ]);

        return redirect('/admin_products');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function addProducts(){
       return view('add_products');
    }
}
