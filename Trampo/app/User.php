<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'cpf', 'phone_number', 'cep'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
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
        return Post::join('feedback','posts.id','=','feedback.posts_id')
                ->select('feedback.hireds_score')
                ->where('posts.hired_id', '=', $id)
                ->whereRaw('feedback.hireds_score IS NOT NULL');
    }

    public function viewHirersFeedbacks($id) 
    {
        return Post::join('feedback','posts.id','=','feedback.posts_id')
                ->select('feedback.hirers_score')
                ->where('posts.hirer_id', '=', $id)
                ->whereRaw('feedback.hirers_score IS NOT NULL');
    }

    public function changePassword($senha_atual, $nova_senha, $confirmacao_nova_senha){
        $user = User::findOrFail(auth()->user()->id);

        if(Hash::check($senha_atual,auth()->user()->password)){
            if($nova_senha == $confirmacao_nova_senha){
                $user->password = Hash::make($nova_senha);
                $user->save();
                Session::flash('menssagem','A senha foi alterada com sucesso.');
                Session::flash('classe-alerta', 'alert-success');
            }else{
                Session::flash('menssagem','A nova senha não coincide com a confirmação da nova senha.');
                Session::flash('classe-alerta', 'alert-danger');
            }
        }else{
            Session::flash('menssagem','A senha atual informada não coincide com a correta.');
            Session::flash('classe-alerta', 'alert-danger');
        }
    }
}
