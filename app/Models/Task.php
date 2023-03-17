<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = ['title', 'description', 'status', 'project_id', 'priority'];

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }
}
