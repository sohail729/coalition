<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function owner()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    public function tasks()
    {
        return $this->hasMany('App\Models\Task');
    }

}
