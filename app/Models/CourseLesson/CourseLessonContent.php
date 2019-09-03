<?php

namespace App\Models\CourseLesson;

use App\Models\CourseLesson;
use Illuminate\Database\Eloquent\Model;

class CourseLessonContent extends Model
{

    protected $table = 'edu_course_lesson_content';

    public function lesson(){
        return $this->belongsTo(CourseLesson::class,'id','lesson_id');
    }
}
