<?php namespace App\Models;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class DepartmentsModel extends Model
{
	protected $table = 'departments';

	protected $fillable = ['name', 'description'];

	/**
	 * create department
	 *
	 * @author Quang <quangnd.92@gmail.com>
	 * 
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	public function createDepartments($data)
	{
		$department =  $this->create($data);
		return $department;
	}

	/**
	 * edit department
	 *
	 * @author Quang <quangnd.92@gmail.com>
	 * 
	 * @param [type] $data [description]
	 */
	public function EditDepartment($data)
	{
		$department = $this;
		$department->update($data);
		return $department;
	}

}