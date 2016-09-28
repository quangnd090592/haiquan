<?php namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\RolesModel;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\RoleFormRequest;

class RolesController extends Controller {

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(RoleFormRequest $request)
	{
		$data = $request->all();
		$status = 1;

		$rolesModel = new RolesModel();
		$role = $rolesModel->storeRole($data);
		if(empty($role)) {
			$status = 0;
		}
		return new JsonResponse(['status' => $status, 'role' => $role]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(RoleFormRequest $request, $id)
	{
		$data = $request -> all();
		$rolesModel = new RolesModel();

		$role = $rolesModel->find($id);

		if(!empty($role)) {
			$role = $role->updateRole($data);
			return new JsonResponse(['status' => 1, 'role' => $role]);
		}

		return new JsonResponse(['status' => 0,'errors' => [['Error']], 'role' => (new RolesModel)]);
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
		$role = RolesModel::find($id);
		if(!empty($role)) {
			$role->delete();
			$status = 1;
		}
		return new JsonResponse(['status'=>$status]);
	}

}
