<?php namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\ProducersModel;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ProducerFormRequest;

class ProducersController extends Controller {

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(ProducerFormRequest $request)
	{
		$data = $request->all();
		$status = 1;

		$producersModel = new ProducersModel();
		$producer = $producersModel->createProducer($data);
		if(empty($producer)) {
			$status = 0;
		}
		return new JsonResponse(['status' => $status, 'producer' => $producer]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(ProducerFormRequest $request, $id)
	{
		$data = $request -> all();
		$producersModel = new ProducersModel();

		$producer = $producersModel->find($id);

		if(!empty($producer)) {
			$producer = $producer->editProducer($data);
			return new JsonResponse(['status' => 1, 'producer' => $producer]);
		}

		return new JsonResponse(['status' => 0,'errors' => [['Error']], 'producer' => (new ProducersModel)]);
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
		$producer = ProducersModel::find($id);
		if(!empty($producer)) {
			$producer->delete();
			$status = 1;
		}
		return new JsonResponse(['status'=>$status]);
	}

}
