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

    public function getRadioNumUrlAttribute()
    {
        $radio_num_url = get_video_url(MY_QINIU.'/storage/mp3',get_video_key($this->attributes['radio_num'],'mp3'));
        return $radio_num_url;
    }


    public function getRadioUrlOnlyAttribute()
    {
        if($this->attributes['radio_url']){
            return $this->attributes['radio_url'];
        }elseif($this->attributes['radio_num']){
            return get_radio_url(MY_QINIU.'/storage/mp3',get_radio_key($this->attributes['radio_num'],'mp4'));
        }else{
            return '';
        }
    }
}
