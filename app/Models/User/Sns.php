<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Sns extends Model
{

    protected $connection = 'mysql_member';
    protected $table = 'member_sns';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
