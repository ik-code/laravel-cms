<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index')->with('users', User::all());
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('users.edit')->with('user', auth()->user());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProfileRequest $request
     */
    public function update(UpdateProfileRequest $request)
    {
        $user = auth()->user();
        $user->update([
           'name' => $request->name,
           'about' => $request->about
        ]);

        session()->flash('success', 'Profile updated successfully');

        return redirect()->back();

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

    /**
     * Changes user role to admin
     *
     * @param User $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function makeAdmin(User $user){
        $user->role = 'admin';
        $user->save();
        session()->flash('success', 'User made admin successfully');
        return redirect(route('users.index'));
    }
}
