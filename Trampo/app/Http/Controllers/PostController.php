<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;

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
        $newPost->cep = $request->cep;

        $local = json_decode(file_get_contents('https://viacep.com.br/ws/'.$request->cep.'/json/'), true);
        $newPost->state = $local['uf'];
        $newPost->city = $local['localidade'];
        $newPost->neighborhood = $local['bairro'];

        $newPost->save();

        return redirect('publish');

    }
    
    public function services(Request $request)
    {
        $categorias = Post::join('categories', 'categories.id', '=', 'categories_id')->orderBy('name')->get();
        $posts = Post::join('categories', 'categories.id', '=', 'categories_id')
            ->where('state', 'like', '%' . $request->estado . '%')
            ->where('city', 'like', '%' . $request->cidade . '%')
            ->where('neighborhood', 'like', '%' . $request->bairro . '%')
            ->where('categories_id', 'like', '%' . $request->categoria . '%')
            ->orderBy('posts.created_at', 'asc');
        $state_list = Post::select('state')->groupBy('state')->get();

        return view('post.services', ['request' => $request, 'categorias' => $categorias, 'states' => $state_list, 'posts' => $posts->get()]);
    }

    function dynamic(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        if ($select == 'estado') {
            $data = Post::select('city')
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

    public function freelancers(Post $post)
    {

    }
}
