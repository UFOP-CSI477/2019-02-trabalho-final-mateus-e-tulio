@extends('adminlte::page')

@section('title', ' - Notificações')

@section('content_header')
    <h1 class="m-0 text-dark">Notificações</h1>
@stop

@section('content')
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
                                            <th>Respostas à publicações</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($answers as $answer)
                                            <tr>
                                                <td>
                                                    <h3>{{ $answer->title }}</h3>
                                                    <p class="text-muted">
                                                        {{ $answer->comment }}
                                                    </p>
                                                </td>
                                                <td><a class="btn btn-dark meu-outro-botao" href="{{ route('posts.show', ['hire' => $answer->author_type == 'Prestador' ? 'hired' : 'hirer', 'id' => $answer->posts_id]) }}">Ver mais</a></td>
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
@stop