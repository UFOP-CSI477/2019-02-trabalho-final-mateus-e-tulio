@extends('adminlte::page')

@section('title', ' - Publicações')

@section('content_header')
    <h1 class="m-0 text-dark">{{ $post->category }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10 offset-1">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <h4>Autor</h4>
                            <p>{{ $post->username }}</p>
                        </div>
                        <div class="col-md-3">
                            <h4>Tipo</h4>
                            <p>{{ $post->author_type }} de serviços</p>
                        </div>
                        <div class="col-md-3">
                            <h4>Local</h4>
                            <p>{{ $post->neighborhood . ' - ' . $post->city . ' - ' . $post->state }}</p>
                        </div>
                        <div class="col-md-3">
                            <h4>Status</h4>
                            <p>{{ $post->status }}</p>
                        </div>
                        <div class="col-md-12 mt-2">
                            <h2>{{ $post->title }}</h2>
                            <p>{{ $post->description }}</p>
                        </div>
                    </div>
                    <a class="btn btn-dark" href="{{route('users.other_profile',['id'=>$post->userid])}}">Ver Perfil</a>
                </div>
            </div>
        </div>
    </div>

    @if ($post->userid == auth()->user()->id)
        <div class="row">
            <div class="col-md-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Respostas à publicação</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($answers as $answer)
                                                <tr>
                                                    <td>
                                                        <h3>{{ $answer->name }}</h3>
                                                        <p class="text-muted">
                                                            {{ $answer->comment }}
                                                        </p>
                                                    </td>
                                                    <td><a class="btn btn-dark meu-outro-botao" href="{{route('users.other_profile',['id'=>$answer->users_id])}}">Ver Perfil</a></td>
                                                    <td><a class="btn btn-dark meu-outro-botao" href="{{route('users.send_message_to',['id'=>$answer->users_id,'title'=>$post->title])}}">Entrar em contato</a></td>
                                                    <td><a class="btn btn-dark meu-outro-botao" href="#">Avaliar serviço</a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        @if ($hasInterest)
                            <a href="{{route('posts.remove_interest',['post_id'=>$post->id])}}" class="btn btn-dark">Retirar Interesse</a>
                        @else
                            <form action="{{route('posts.express_interest')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="comment" id="comment" class="form-control" placeholder="Insira uma mensagem (Opcional)">
                                </div>
                                <input type="hidden" name="posts_id" value="{{$post->id}}">
                                <button type="submit" class="btn btn-dark">Manifestar Interesse</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
@stop