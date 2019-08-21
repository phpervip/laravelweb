<?php

namespace App\Models;

use Encore\Admin\Traits\AdminBuilder;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use AdminBuilder;
    protected $table = 'edu_profession';
}
