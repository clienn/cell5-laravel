<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = ['', 'asc', 'desc'];
        $sorts = $request->input('sorts');
        $records = $request->input('records');

        $users = User::select('users.id', 'users.firstname', 'users.lastname', 
            'users.middlename', 'users.gender', 'users.email');

        foreach ($sorts as $val) {
            $field = $val[0];
            $type = $orders[$val[1]];

            if ($val[1] > 0) {
                $users = $users->orderBy($field, $type);
            }
        }

        $users = $users->paginate($records);

        return response(['data' => $users, 'success' => true]);
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
        $id = $request->id ? $request->id : 0;

        $user = $request->isMethod('put') ? 
            User::findOrFail($id) : new User;

        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->middlename = $request->input('middlename');
        $user->email = $request->input('email');
        $user->gender = $request->input('gender');
        $user->password = Hash::make('');

        if ($user->save()) {
            response(['success' => true]);
        }

        response(['success' => false]);
    }

    public function delete(Request $request) {
        $ids = $request->input('ids');
        $ids = explode(',', $ids);

        $user = User::whereIn('users.id', $ids);

        if ($user->delete()) {
            response(['success' => true]);
        }

        response(['success' => false]);
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
