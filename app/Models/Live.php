<?php

namespace App\Models;


class Live extends Base
{
    protected $table = 'edu_live';

    public function stream()
    {
        return $this->hasOne(Stream::class, 'id', 'stream_id');
    }
}
