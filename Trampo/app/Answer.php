<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['posts_id','users_id','viewed','comment'];
    protected $primaryKey = 'posts_id';
}
