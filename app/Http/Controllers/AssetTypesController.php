<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\AssetTypesModel;

class AssetTypesController extends Controller
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
        $assetTypesModel = new AssetTypesModel();

        $assetTypes = $assetTypesModel->all();
        return view('assetTypes.index', compact('assetTypes'));
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
        $assetType = new AssetTypesModel();
        return view('assetTypes.create', compact('assetType'));
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
        $assetTypesModel = new AssetTypesModel();
        $assetType = $assetTypesModel->find($id);
        return view('assetTypes.create', compact('assetType'));
    }
}
