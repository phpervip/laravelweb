<?php

namespace App\Models\CourseLesson;

use App\Models\CourseLesson;
use Illuminate\Database\Eloquent\Model;

class CourseLessonVideo extends Model
{
    protected $table = 'edu_course_lesson_video';

    public function lesson(){
        return $this->belongsTo(CourseLesson::class,'id','lesson_id');
    }

    public function getVideoNumUrlAttribute()
    {
        return ($this->attributes['video_num']);
    }
}
