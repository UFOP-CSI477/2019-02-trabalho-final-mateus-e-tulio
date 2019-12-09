@extends('adminlte::page')

@section('title', ' - Publicações')

@section('content_header')
    <h1 class="m-0 text-dark">{{ $post->category }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-10 offset-1">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <h4>Autor</h4>
                            <p>{{ $post->username }}</p>
                        </div>
                        <div class="col-3">
                            <h4>Tipo</h4>
                            <p>{{ $post->author_type }} de serviços</p>
                        </div>
                        <div class="col-3">
                            <h4>Local</h4>
                            <p>{{ $post->neighborhood . ' - ' . $post->city . ' - ' . $post->state }}</p>
                        </div>
                        <div class="col-3">
                            <h4>Status</h4>
                            <p>{{ $post->status }}</p>
                        </div>
                        <div class="col-12 mt-2">
                            <h2>{{ $post->title }}</h2>
                            <p>{{ $post->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($post->userid == auth()->user()->id)
        <div class="row">
            <div class="col-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Respostas à publicação</th>
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
                                                    <td><a class="btn btn-dark meu-outro-botao" href="{{ route('posts.show', ['hire' => 'hirer', 'id' => $post->id]) }}">Ver mais</a></td>
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
    @endif
@stop