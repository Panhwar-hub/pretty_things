<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "users";
    protected $guarded = [
        'id', 'created_at','updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function img_tab()
    {
        return $this->hasOne('App\Models\Imagetable', 'ref_id','id')->where('table_name', 'users');
    }
    
    public function wishlist()
    {
       return $this->hasMany('App\Models\Wishlist', 'user_id','id');
    }

    public function userHasProductReview()
    {
            return $this->hasMany(Review::class,'user_id','id')->where('type', 1);
    }
    public function userHasMerchandiseReview()
    {
            return $this->hasMany(Review::class,'user_id','id')->where('type', 2);
    }
}
