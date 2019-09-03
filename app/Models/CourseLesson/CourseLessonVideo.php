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

    // 前台可用。后台这个方法不起作用 ?
    public function getVideoNumUrlAttribute()
    {
        // return ($this->attributes['video_num']);
        $video_num_url = get_video_url(MY_QINIU.'/storage/mp4',get_video_key($this->attributes['video_num'],'mp4'));
        return $video_num_url;
    }


    // 前台可用。后台这个方法不起作用 ?
    public function getVideoUrlOnlyAttribute()
    {
        if($this->attributes['video_url']){
            return $this->attributes['video_url'];
        }else{
            return get_video_url(MY_QINIU.'/storage/mp4',get_video_key($this->attributes['video_num'],'mp4'));
        }
    }

    public function getFileTypeAttribute($value)
    {
        return explode(',', $value);
    }

    public function setFileTypeAttribute($value)
    {
        $this->attributes['file_type'] = implode(',', $value);
    }

    public function getVideoQualityAttribute($value)
    {
        return explode(',', $value);
    }

    public function setVideoQualityAttribute($value)
    {
        $this->attributes['video_quality'] = implode(',', $value);
    }

     public function getM3u8QualityAttribute($value)
    {
        return explode(',', $value);
    }

    public function setM3u8QualityAttribute($value)
    {
        $this->attributes['m3u8_quality'] = implode(',', $value);
    }

}
