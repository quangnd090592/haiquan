<?php namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\DepartmentsModel;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\DepartmentsFormRequest;
use App\Models\User;

class DepartmentsController extends Controller {

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(DepartmentsFormRequest $request)
	{
		$data = $request->all();
		$status = 1;

		$departmentModel = new DepartmentsModel();
		$department = $departmentModel->createDepartments($data);
		if(empty($department)) {
			$status = 0;
		}
		return new JsonResponse(['status' => $status, 'department' => $department]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(DepartmentsFormRequest $request, $id)
	{
		$data = $request -> all();
		$departmentModel = new DepartmentsModel();

		$department = $departmentModel->find($id);

		if(!empty($department)) {
			$department = $department->editDepartment($data);
			return new JsonResponse(['status' => 1, 'department' => $department]);
		}

		return new JsonResponse(['status' => 0,'errors' => [['Error']], 'department' => (new DepartmentsModel)]);
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
		$department = DepartmentsModel::find($id);
		if(!empty($department)) {
			$department->delete();
			$status = 1;
		}
		return new JsonResponse(['status'=>$status]);
	}

	/**
	 * add user to department
	 *
	 * @author Quang <quangnd.92@gmail.com>
	 * 
	 * @param Request $request [description]
	 */
	public function addUser(Request $request)
	{
		$data = $request->all();

		$departmentsModel = new DepartmentsModel();
		$usersModel = new User();

		$department = $departmentsModel->findOrFail($data['departmentId']);
		$checkUser = $department->users()->where('userId', $data['userId'])->count();

		if(!$checkUser) {
			$department->users()->attach(['userId'=>$data['userId']]);
			return new JsonResponse(['status' => 1]);
		}
		return new JsonResponse(['status' => 0]);
	}

	/**
	 * remove user from department
	 *
	 * @author Quang <quangnd.92@gmail.com>
	 * 
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function removeUser(Request $request)
	{
		$data = $request->all();

		$departmentsModel = new DepartmentsModel();
		$usersModel = new User();

		$department = $departmentsModel->findOrFail($data['departmentId']);
		$checkUser = $department->users()->where('userId', $data['userId'])->count();

		if($checkUser) {
			$department->users()->detach(['userId'=>$data['userId']]);
			return new JsonResponse(['status' => 1]);
		}
		return new JsonResponse(['status' => 0]);
	}

}
