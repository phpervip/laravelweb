<?php

namespace App\Models;

use Encore\Admin\Traits\AdminBuilder;
use Illuminate\Database\Eloquent\Model;

use App\Models\CourseLesson\CourseLessonContent;
use App\Models\CourseLesson\CourseLessonRadio;
use App\Models\CourseLesson\CourseLessonVideo;

class CourseLesson extends Model
{
    use AdminBuilder;
    protected $table = 'edu_course_lesson';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */

    public function content()
    {
        return $this->hasOne(CourseLessonContent::class,'lesson_id','id');
    }

    public function video0()
    {
        return $this->hasOne(CourseLessonVideo::class,'lesson_id','id');
    }

    public function Video1()
    {
        return $this->hasOne(CourseLessonVideo::class,'lesson_id','id');
    }

    public function Video2()
    {
        return $this->hasOne(CourseLessonVideo::class,'lesson_id','id');
    }

    public function radio()
    {
        return $this->hasOne(CourseLessonRadio::class,'lesson_id','id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class,'course_id','id');
    }
}
