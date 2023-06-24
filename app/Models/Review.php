<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{    
	protected $table = 'review';
    protected $guarded = [
        'id','created_at','updated_at'
    ];

    public function reviewBelongsToUser()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
    public function reviewBelongsToProducts()
    {
        return $this->belongsTo('App\Models\Products','item_id')->where('type',1);
    }
    public function reviewBelongsToMerchandise()
    {
        return $this->belongsTo('App\Models\Merchandise','item_id')->where('type',2);
    }

    // public function productsHasMainImage()
    // {
    // return $this->hasMany(ShopImage::class,'ref_id','id')->where('img_type', 1);
    // }

    // public function productsHasMultiImages()
    // {
    // return $this->hasMany(ShopImage::class,'ref_id','id')->where('img_type', 2);
    // }

   
    
    

}
