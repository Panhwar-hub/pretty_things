<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderInquiry extends Model
{
    protected $table = 'order_inquiry';
	// public $primaryKey = 'id';
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public function productsBelongsToOrder()
    {
        return $this->belongsTo('App\Models\Products','product_id');
    }
}

