<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function viewHiredsFeedbacks($id) 
    {
        return DB::table('posts')
            ->crossJoin('feedback')
            ->select('feedback.hireds_score')
            ->where('posts.hired_id', '=', $id)
            ->whereRaw('feedback.hireds_score IS NOT NULL');
    }

    public function viewHirersFeedbacks($id) 
    {
        return DB::table('posts')
            ->crossJoin('feedback')
            ->select('feedback.hirers_score')
            ->where('posts.hirer_id', '=', $id)
            ->whereRaw('feedback.hirers_score IS NOT NULL');
    }
}
