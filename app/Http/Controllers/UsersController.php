<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\User;

class UsersController extends Controller
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
        $usersModel = new User();

        $users = $usersModel->all();
        return view('users.index', compact('users'));
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
        $user = new User();
        return view('users.create', compact('user'));
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
        $usersModel = new User();
        $user = $usersModel->find($id);
        return view('users.create', compact('user'));
    }
}
