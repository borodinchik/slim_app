<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';
    protected $fillable = ['title', 'body', 'user_id'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}