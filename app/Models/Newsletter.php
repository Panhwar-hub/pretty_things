<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Newsletter extends Model
{
	protected $table = 'newsletter';
    protected $fillable = [
        'email','long_desc', 'is_active','is_deleted'
    ];   
}
