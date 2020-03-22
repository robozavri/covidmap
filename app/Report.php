<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reports';

    protected $fillable = [
        'location',
        'emergency',
        'address',
        'people',
        'description',
        'lat',
        'lng',
        'created_at',
        'deleted_at',
        'updated_at',
    ];
}
