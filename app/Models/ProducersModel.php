<?php namespace App\Models;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class ProducersModel extends Model
{
	protected $table = 'producers';

	protected $fillable = ['name'];

	/**
	 * create producer
	 *
	 * @author Quang <quangnd.92@gmail.com>
	 * 
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	public function createProducer($data)
	{
		$producer =  $this->create($data);
		return $producer;
	}

	/**
	 * edit producer
	 *
	 * @author Quang <quangnd.92@gmail.com>
	 * 
	 * @param [type] $data [description]
	 */
	public function EditProducer($data)
	{
		$producer = $this;
		$producer->update($data);
		return $producer;
	}

}