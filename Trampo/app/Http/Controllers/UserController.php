<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $userObject = new User();
        $user = auth()->user();
        
        $hiredsFeedbacks = $userObject->viewHiredsFeedbacks($user->id);
        $countHireds = $hiredsFeedbacks->count();
        $auxHireds = $hiredsFeedbacks->avg('hireds_score');
        $avgHireds = $auxHireds == '' ? 0 : intval($auxHireds*10);

        $hirersFeedbacks = $userObject->viewHirersFeedbacks($user->id);
        $countHirers = $hirersFeedbacks->count();
        $auxHirers = $hirersFeedbacks->avg('hirers_score');
        $avgHirers = $auxHirers == '' ? 0 : intval($auxHirers*10);

        $userObject->viewHiredsFeedbacks($user->id)->count();
        return view('user.index',compact('user','countHireds','avgHireds','countHirers','avgHirers'));
    }

    public function notifications()
    {

    }
}
