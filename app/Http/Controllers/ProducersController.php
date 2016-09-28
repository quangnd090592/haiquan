<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\ProducersModel;

class ProducersController extends Controller
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
        $producersModel = new ProducersModel();

        $producers = $producersModel->all();
        return view('producers.index', compact('producers'));
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
        $producer = new ProducersModel();
        return view('producers.create', compact('producer'));
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
        $producersModel = new ProducersModel();
        $producer = $producersModel->find($id);
        return view('producers.create', compact('producer'));
    }
}
