<?php

namespace App\Models\User;

use App\Models\ChinaArea;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

    protected $connection = 'mysql_member';
    protected $table = 'member_address';

    protected $fillable = [
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function province()
    {
        return $this->belongsTo(ChinaArea::class);
    }

    public function city()
    {
        return $this->belongsTo(ChinaArea::class);
    }

    public function district()
    {
        return $this->belongsTo(ChinaArea::class);
    }
}
