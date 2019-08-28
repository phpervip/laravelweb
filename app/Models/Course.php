<?php

namespace App\Models;

use Encore\Admin\Traits\AdminBuilder;

class Course extends Base
{
    use AdminBuilder;
    protected $table = 'edu_course';


    public function courseLesson()
    {
        return $this->hasMany(CourseLesson::class,'course_id','id');
    }

    public function teacher(){
        return $this->hasOne(User::class,'id','teacher_id');
    }


    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable', 'edu_taggables');
    }
}
