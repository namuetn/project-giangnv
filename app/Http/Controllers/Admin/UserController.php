<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Category;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', ['users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        // $categories = Category::all();
        $data = [
            'user' => $user,
            // 'categories' => $categories,
        ];

        return view('admin.users.edit', $data);
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
        $data = $request->only([           
            'name',
            'mail',
            'role',
        ]);

        $user = User::findOrFail($id);

        
        try {
            $user->update($data);
        } catch (\Exception $e) {
            \Log::error($e);

            return back()->with('status', 'Update faild.');
        }

        return redirect('admin/users')->with('status', 'Update success.');
    }
}
