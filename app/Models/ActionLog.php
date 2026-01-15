<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActionLog extends Model
{
    protected $fillable = [
        'actionLog_id','user_id','post_id'
    ];
   use HasFactory;
}
