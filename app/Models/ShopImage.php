<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopImage extends Model
{    
	protected $table = 'shop_image';
    protected $guarded = [
        'id','created_at','updated_at'
    ];

    // public function photosBelongsToAlbum()
    // {
    //     return $this->belongsTo('App\Models\Album','album_id');
    // }

   
    
    

}
