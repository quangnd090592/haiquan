<?php namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UserFormRequest;

class UsersController extends Controller {

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(UserFormRequest $request)
	{
		$data = $request->all();
		$status = 1;

		$usersModel = new User();
		$user = $usersModel->storeUser($data);
		if(empty($user)) {
			$status = 0;
		}
		return new JsonResponse(['status' => $status, 'user' => $user]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(UserFormRequest $request, $id)
	{
		$data = $request -> all();
		$usersModel = new User();

		$user = $usersModel->find($id);

		if(!empty($user)) {
			$user = $user->updateRole($data);
			return new JsonResponse(['status' => 1, 'user' => $user]);
		}

		return new JsonResponse(['status' => 0,'errors' => [['Error']], 'user' => (new User)]);
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
		$user = User::find($id);
		if(!empty($user)) {
			$user->delete();
			$status = 1;
		}
		return new JsonResponse(['status'=>$status]);
	}

}
