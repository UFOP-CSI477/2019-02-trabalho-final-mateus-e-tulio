<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Answer;
use Illuminate\Http\Request;
use Session;

class PostController extends Controller
{

    public function publish()
    {
        $categorias = Category::orderBy('name')->get();
        return view('post.publish', compact('categorias'));
    }

    public function store(Request $request)
    {
        $newPost = new Post;
        if ($request->tipo == 'Contratante') {
            $newPost->hirer_id = auth()->user()->id;
        } else {
            $newPost->hired_id = auth()->user()->id;
        }
        $newPost->categories_id = $request->categoria;
        $newPost->author_type = $request->tipo;
        $newPost->title = $request->titulo;
        $newPost->description = $request->descricao;
        if ($request->cep == 'meu') {
            $cep = auth()->user()->cep;
        } else {
            $cep = $request->input_outro_cep;
        }
        $newPost->cep = $cep;

        $local = json_decode(file_get_contents('https://viacep.com.br/ws/'. preg_replace('/\D/', '', $cep) .'/json/'), true);
        $newPost->state = $local['uf'];
        $newPost->city = $local['localidade'];
        $newPost->neighborhood = $local['bairro'];

        $newPost->save();

        Session::flash('message', 'Publicação criada com sucesso!'); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('profile');

    }
    
    public function destroy($id)
    {
        $myPost = Post::findOrFail($id);
        $myPost->delete();

        Session::flash('message', 'Publicação excluída com sucesso!'); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('profile');
    }

    public function show($hire, $id)
    {
        $post = Post::select('posts.id AS id', 'author_type','title','description','state','city','neighborhood','status','users.name AS username','categories.name AS category', 'users.id AS userid')
            ->join('categories', 'categories.id', '=', 'categories_id')
            ->join('users', 'users.id', '=', $hire.'_id')
            ->where('posts.id', $id)->first();

        $answers = Answer::join('users', 'users.id', '=', 'users_id')->where('posts_id', $id)->orderBy('answers.created_at', 'desc')->get();
        
        $hasInterest = Answer::where('posts_id',$id)->where('users_id',auth()->user()->id)->exists();
        
        return view('post.index', ['hire' => $hire, 'post' => $post, 'answers' => $answers, 'hasInterest' => $hasInterest]);
    }

    public function rate($hire, $id, $user)
    {
        $post = Post::select('posts.id AS id', 'author_type','title','description','state','city','neighborhood','status','users.name AS username','categories.name AS category', 'users.id AS userid')
            ->join('categories', 'categories.id', '=', 'categories_id')
            ->join('users', 'users.id', '=', $hire.'_id')
            ->where('posts.id', $id)->first();

        $answer = Answer::join('users', 'users.id', '=', 'users_id')
            ->where('posts_id', $id)
            ->where('users_id', $user)->first();
            
        $i_hired = ((auth()->user()->id == $answer->users_id) && ($hire == 'hired')) || ((auth()->user()->id == $post->userid) && ($hire == 'hirer'));
        
        return view('post.rate', ['i_hired' => $i_hired, 'hire' => $hire, 'post' => $post, 'answer' => $answer]);
    }
    
    public function services(Request $request)
    {
        $categorias = Post::select('categories.id AS id', 'name')->join('categories', 'categories.id', '=', 'categories_id')
            ->whereNull('hired_id')
            ->orderBy('name')
            ->groupBy('categories.id')->get();
        $posts = Post::select('description', 'title', 'posts.id AS id')
            ->join('categories', 'categories.id', '=', 'categories_id')
            ->whereNull('hired_id')
            ->where('state', 'like', '%' . $request->estado . '%')
            ->where('city', 'like', '%' . $request->cidade . '%')
            ->where('neighborhood', 'like', '%' . $request->bairro . '%')
            ->where('categories_id', 'like', '%' . $request->categoria . '%')
            ->orderBy('posts.created_at', 'desc');
        $state_list = Post::select('state')
            ->whereNull('hired_id')->groupBy('state')->get();

        return view('post.services', ['request' => $request, 'categorias' => $categorias, 'states' => $state_list, 'posts' => $posts->paginate('10')]);
    }

    function dynamic(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        if ($select == 'estado') {
            $data = Post::select('city')
                ->whereNull($request->get('hire'))
                ->where('state', $value)
                ->groupBy('city')
                ->get();
            $output = '<option value="">Selecionar Cidade</option>';
            foreach($data as $row)
            {
                $output .= '<option value="'.$row->city.'">'.$row->city.'</option>';
            }
        }
        if ($select == 'cidade') {
            $data = Post::select('neighborhood')
                ->whereNull($request->get('hire'))
                ->where('city', $value)
                ->groupBy('neighborhood')
                ->get();
            $output = '<option value="">Selecionar Bairro</option>';
            foreach($data as $row)
            {
                $output .= '<option value="'.$row->neighborhood.'">'.$row->neighborhood.'</option>';
            }
        }
        echo $output;
    }
    
    function dynamicCategories(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        if ($value == '') {
            $data = Post::select('categories.id AS id', 'name')->join('categories', 'categories.id', '=', 'categories_id')
                ->whereNull($request->get('hire'))
                ->orderBy('name')
                ->groupBy('categories.id')->get();
        } else {
            $data = Post::select('categories.id AS id', 'name')->join('categories', 'categories.id', '=', 'categories_id')
                ->whereNull($request->get('hire'))
                ->where($select=='estado'?'state':($select=='cidade'?'city':'neighborhood'), $value)
                ->orderBy('name')
                ->groupBy('categories.id')->get();
        }
        $output = '<option value="">Selecionar Categoria</option>';
        foreach($data as $row)
        {
            $output .= '<option value="'.$row->id.'">'.$row->name.'</option>';
        }
        echo $output;
    }

    public function freelancers(Post $post, Request $request)
    {
        $categorias = Post::join('categories', 'categories.id', '=', 'categories_id')
            ->whereNull('hirer_id')->orderBy('name')->get();
        $posts = Post::select('description', 'title', 'posts.id AS id')
            ->join('categories', 'categories.id', '=', 'categories_id')
            ->whereNull('hirer_id')
            ->where('state', 'like', '%' . $request->estado . '%')
            ->where('city', 'like', '%' . $request->cidade . '%')
            ->where('neighborhood', 'like', '%' . $request->bairro . '%')
            ->where('categories_id', 'like', '%' . $request->categoria . '%')
            ->orderBy('posts.created_at', 'desc');
        $state_list = Post::select('state')
            ->whereNull('hirer_id')->groupBy('state')->get();

        return view('post.freelancers', ['request' => $request, 'categorias' => $categorias, 'states' => $state_list, 'posts' =>  $posts->paginate('10')]);
    }

    public function removeInterest($post_id){
        Answer::where('users_id',auth()->user()->id)->where('posts_id',$post_id)->delete();
        return back();
    }

    public function expressInterest(Request $request){
        $answer = new Answer;
        
        $answer->fill($request->all());
        $answer->users_id = auth()->user()->id;
        $answer->save();
        return back();
    }
}
