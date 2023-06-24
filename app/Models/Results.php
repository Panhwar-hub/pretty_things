<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Results extends Model
{    
	protected $table = 'results';
    protected $guarded = [
        'id','created_at','updated_at'
    ];

    public function resultBelongsToQuiz()
    {
        return $this->belongsTo('App\Models\Quiz','quiz_id');
    }
    public function resultBelongsToCourse()
    {
        return $this->belongsTo('App\Models\Course','course_id');
    }
    public function resultBelongsToUser()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
    // public function courseBelongsToInstructor()
    // {
    //     return $this->belongsTo('App\Models\User','teacher_id');
    // }
    // public function courseBelongsToState()
    // {
    //     return $this->belongsTo('App\Models\State','state_id');
    // }
    // public function CoursehasManyToc()
    // {
    // return $this->hasMany(Toc::class,'course_id','id');
    // }

    // public function CoursehasManyExam()
    // {
    // return $this->hasMany(Exam::class,'course_id','id');
    // }

}
