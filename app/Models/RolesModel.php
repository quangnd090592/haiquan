<?php namespace App\Models;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class RolesModel extends Model
{
	protected $table = 'roles';

	protected $fillable = ['name', 'slug', 'description'];

	/**
     * The users that belong to the role.
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'users_roles', 'roleId', 'userId');
    }

	/**
	 * create roles
	 *
	 * @author Quang <quangnd.92@gmail.com>
	 * 
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	public function storeRole($data)
	{
		$role =  $this->create($data);
		return $role;
	}

	/**
	 * edit roles
	 *
	 * @author Quang <quangnd.92@gmail.com>
	 * 
	 * @param [type] $data [description]
	 */
	public function updateRole($data)
	{
		$role = $this;
		$role->update($data);
		return $role;
	}

}