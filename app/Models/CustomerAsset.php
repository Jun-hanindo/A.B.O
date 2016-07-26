<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAsset extends Model
{
    protected $table = 'customer_assets';
    protected $fillable = [
        'id', 'CustomerId', 'Merk', 'Ammount', 'Type', 'Model', 'Year', 'Colour', 'Status', 'NoPolisi', 'NoRangka', 'NoMesin', 'BPKBName'
    ];

    public static function getAssetCustById($userId) 
    {
    	$asset = CustomerAsset::where('CustomerId', '=', $userId)
    		->orderBy('created_at', 'desc')
    		->first();

    	return $asset;
    }
}
