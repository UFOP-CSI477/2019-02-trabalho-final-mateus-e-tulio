<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = ['posts_id','hirers_score','hireds_score','message_for_hirer','message_for_hired'];
    protected $primaryKey = 'posts_id';
}
