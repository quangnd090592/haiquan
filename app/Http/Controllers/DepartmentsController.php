<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\DepartmentsModel;

class DepartmentsController extends Controller
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
        $departmentModel = new DepartmentsModel();

        $departments = $departmentModel->all();
        return view('departments.index', compact('departments'));
    }

    /**
     * create department
     *
     * @author Quang <quangnd.92@gmail.com>
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $department = new DepartmentsModel();
        return view('departments.create', compact('department'));
    }

    /**
     * edit Department
     *
     * @author Quang <quangnd.92@gmail.com>
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departmentModel = new DepartmentsModel();
        $department = $departmentModel->find($id);
        return view('departments.create', compact('department'));
    }
}
