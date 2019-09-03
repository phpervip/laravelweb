<?php

namespace App\Models\CourseLesson;

use App\Models\CourseLesson;
use Illuminate\Database\Eloquent\Model;

class CourseLessonRadio extends Model
{
    protected $table = 'edu_course_lesson_radio';

    public function lesson(){
        return $this->belongsTo(CourseLesson::class,'id','lesson_id');
    }
}
