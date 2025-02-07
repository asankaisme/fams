<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FixedAsset extends Model
{
    //model class for fixed assets

    protected $fillable = [
        'fa_category',
        'fa_number',
        'description',
        'cost',
        'nbv',
        'doc',
        'location',
        'status', // a-available, d-disposable
        'remarks'
    ];
}
