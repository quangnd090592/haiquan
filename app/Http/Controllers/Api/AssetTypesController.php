<?php namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\AssetTypesModel;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\AssetTypeFormRequest;

class AssetTypesController extends Controller {

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(AssetTypeFormRequest $request)
	{
		$data = $request->all();
		$status = 1;

		$assetTypesModel = new AssetTypesModel();
		$assetType = $assetTypesModel->createAssetType($data);
		if(empty($assetType)) {
			$status = 0;
		}
		return new JsonResponse(['status' => $status, 'assetType' => $assetType]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(AssetTypeFormRequest $request, $id)
	{
		$data = $request -> all();
		$assetTypesModel = new AssetTypesModel();

		$assetType = $assetTypesModel->find($id);

		if(!empty($assetType)) {
			$assetType = $assetType->editAssetType($data);
			return new JsonResponse(['status' => 1, 'assetType' => $assetType]);
		}

		return new JsonResponse(['status' => 0,'errors' => [['Error']], 'assetType' => (new AssetTypesModel)]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$status = 0;
		$assetType = AssetTypesModel::find($id);
		if(!empty($assetType)) {
			$assetType->delete();
			$status = 1;
		}
		return new JsonResponse(['status'=>$status]);
	}

}
