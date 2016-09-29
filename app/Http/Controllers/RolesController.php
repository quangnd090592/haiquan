<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\RolesModel;
use App\Models\User;

class RolesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @author Quang <quangnd.92@gmail.com>
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rolesModel = new RolesModel();

        $roles = $rolesModel->all();
        return view('roles.index', compact('roles'));
    }

    /**
     * create Producers
     *
     * @author Quang <quangnd.92@gmail.com>
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = new RolesModel();
        return view('roles.create', compact('role'));
    }

    /**
     * edit Producers
     *
     * @author Quang <quangnd.92@gmail.com>
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rolesModel = new RolesModel();
        $role = $rolesModel->find($id);
        return view('roles.create', compact('role'));
    }

    /**
     * add user to role
     *
     * @author Quang <quangnd.92@gmail.com>
     * 
     * @param [type] $id [description]
     */
    public function addUser($id)
    {
        $rolesModel = new RolesModel();
        $usersModel = new User;
        $role = $rolesModel->findOrFail($id);
        $usersInRole = $role->users;
        $usersId = array_column($usersInRole->toArray(),'id');
        $usersNotInRole = $usersModel->whereNotIn('id', $usersId)->get();
        return view('roles.addUser', compact('usersInRole', 'usersNotInRole', 'role'));
    }
}
