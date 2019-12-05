<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
use Illuminate\Support\Facades\Hash;

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

    public function generalSettings(Request $request){
        $user = User::findOrFail(auth()->user()->id);
        $user->fill($request->all());

        $user->save();

        Session::flash('menssagem','Dados alterados com sucesso.');
        Session::flash('classe-alerta', 'alert-success');

        return redirect('profile');
    }

    public function securitySettings(Request $request){

        $userObject = new User;

        $senha_atual = $request->senha_atual;
        $nova_senha = $request->nova_senha;
        $confirmacao_nova_senha = $request->confirmacao_nova_senha;

        $userObject->changePassword($senha_atual, $nova_senha, $confirmacao_nova_senha);

        return redirect('profile');
    }

    public function notifications()
    {

    }
}
