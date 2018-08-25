<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UsersEditRequest;
use App\User;
use App\Role;
use App\Photo;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id')->all();

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        // User::create($request->all());

        $input = $request->all();
        if ($file = $request->file('file')) {
            $name = time() . $file->getClientOriginalName(); //Setting up file name
            // Saving file
            $file->move('images', $name);

            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;
        }

        $input['password'] = bcrypt($request->password);

        User::create($input);
        // Send notification
        Session::flash('notification', 'The user has been created');

        return redirect('admin/users');
        // return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.users.show');
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
        $roles = Role::pluck('name', 'id')->all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
        // return $request->all();
        $user = User::findOrFail($id);
        $input = $request->all();
        if ($file = $request->file('file')) {
            $name = time() . $file->getClientOriginalName(); //Setting up file name
            // Saving file
            $file->move('images', $name);
            // Adding filename to db
            $photo = Photo::create(['file'=>$name]);
            // Adding id of photo to inputs
            $input['photo_id'] = $photo->id;
            // Removing the old image if existed
            if ($user->photo) {
                unlink(public_path() . '/images/' . $user->photo->file);
            }
        }
        // Password check
        if ($request->password)
            $input['password'] = bcrypt($request->password);
        else
            $input['password'] = $user->password;

        // Save edited user to db
        $user->update($input);
        // Send notification
        Session::flash('notification', 'The user has been updated');

        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->photo) {
            unlink(public_path() . "/images/" . $user->photo->file); //removes image
        }
        // deleting user
        $user->delete();
        // Make notification
        Session::flash('notification', 'The user has been deleted');

        return redirect('admin/users');
    }
}
