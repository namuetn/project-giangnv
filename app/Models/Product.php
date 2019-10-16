<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'content',
        'quantity',
        'price',
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
