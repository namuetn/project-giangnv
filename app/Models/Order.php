<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'total_price',
        'description',
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function products() {
        return $this->belongsToMany('App\Models\Product', 'product_order')
            ->withPivot('quantity');
    }
}
