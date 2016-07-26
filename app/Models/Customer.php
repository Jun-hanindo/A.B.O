<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    protected $fillable = [
        'id','IDNumber', 'FullName', 'MobilePhone', 'BirthPlace', 'BirthDate', 'Gender', 'MaritalStatus', 'NumOfDependence', 'HomeStatus', 'Education', 'PersonalNPWP', 'Email', 'Religion', 'Nationality'
    ];

    /**
     * The customer that belongs to residance_address.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function residanceAddress()
    {
        return $this->belongsTo(ResidanceAddress::class, 'id', 'CustomerId');
    }
}
