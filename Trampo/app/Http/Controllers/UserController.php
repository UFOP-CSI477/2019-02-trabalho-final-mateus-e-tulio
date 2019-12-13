<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Answer;
use App\Feedback;
use Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

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

        $servicosPrestados = $userObject->servicosPrestados($user->id);
        $servicosSolicitados = $userObject->servicosSolicitados($user->id);

        return view('user.index',compact('user','countHireds','avgHireds','countHirers','avgHirers','servicosPrestados','servicosSolicitados'));
    }

    public function otherProfile($id)
    {
        $userObject = new User();
        $user = User::where('users.id',$id)->first();
        
        $hiredsFeedbacks = $userObject->viewHiredsFeedbacks($id);
        $countHireds = $hiredsFeedbacks->count();
        $auxHireds = $hiredsFeedbacks->avg('hireds_score');
        $avgHireds = $auxHireds == '' ? 0 : intval($auxHireds*10);

        $hirersFeedbacks = $userObject->viewHirersFeedbacks($id);
        $countHirers = $hirersFeedbacks->count();
        $auxHirers = $hirersFeedbacks->avg('hirers_score');
        $avgHirers = $auxHirers == '' ? 0 : intval($auxHirers*10);

        return view('user.other_profile',compact('user','countHireds','avgHireds','countHirers','avgHirers'));
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
        $answers = Post::join('answers', 'posts.id', 'posts_id')
            ->where(function ($query) {
                $query->where('posts.hired_id', auth()->user()->id)
                    ->where('posts.author_type', 'Prestador');
            })->orWhere(function ($query) {
                $query->where('posts.hirer_id', auth()->user()->id)
                    ->where('posts.author_type', 'Contratante');
            })
            ->orderBy('answers.viewed', 'asc')->orderBy('answers.created_at', 'desc');
        
        $answers->update(array('viewed' => 'Sim'));

        return view('user.notifications', ['answers' => $answers->paginate('10')]);
    }

    public function sendMessageTo($title, $id){
        $phone_number = User::where('id',$id)->pluck('phone_number')->first();
        $phone_number_wpp = preg_replace('/[^0-9]/', '', $phone_number);
        return Redirect::to("https://api.whatsapp.com/send?phone=55$phone_number_wpp&text=Olá!%20Vi%20que%20você%20respondeu%20à%20minha%20publicação%20\"$title\"");
    }
}
