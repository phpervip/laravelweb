<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class Base extends Model
{

    public function getCoverUrlAttribute()
    {
        if(Str::startsWith($this->attributes['cover'],['http://','https://'])){
            return $this->attributes['cover'];
        }
        return Storage::disk('public')->url($this->attributes['cover']);
    }
}
