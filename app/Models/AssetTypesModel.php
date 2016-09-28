<?php namespace App\Models;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class AssetTypesModel extends Model
{
	protected $table = 'asset_types';

	protected $fillable = ['name','description'];

	/**
	 * create asset type
	 *
	 * @author Quang <quangnd.92@gmail.com>
	 * 
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	public function createAssetType($data)
	{
		$assetType =  $this->create($data);
		return $assetType;
	}

	/**
	 * edit asset type
	 *
	 * @author Quang <quangnd.92@gmail.com>
	 * 
	 * @param [type] $data [description]
	 */
	public function EditAssetType($data)
	{
		$assetType = $this;
		$assetType->update($data);
		return $assetType;
	}

}