<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Imagetable extends Model
{
	protected $table = 'imagetable';
	public $primaryKey = 'id';
    protected $fillable = [
        'img_path', 'table_name','img_width','img_height' ,'ref_id','type','is_active_img','headings'
    ];
}
