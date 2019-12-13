@extends('adminlte::page')

@section('title', ' - Publicações')

@section('content')
    <div class="row">
        <div class="col-md-10 offset-1">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <h4>Autor</h4>
                            <p>{{ $post->username }}</p>
                        </div>
                        <div class="col-md-3 text-center">
                            <h4>Tipo</h4>
                            <p>{{ $post->author_type }} de serviços</p>
                        </div>
                        <div class="col-md-2 text-center">
                            <h4>Categoria</h4>
                            <p>{{ $post->category }}</p>
                        </div>
                        <div class="col-md-2 text-center">
                            <h4>Local</h4>
                            <p>{{ $post->neighborhood . ' - ' . $post->city . ' - ' . $post->state }}</p>
                        </div>
                        <div class="col-md-2 text-center">
                            <h4>Status</h4>
                            <p>{{ $post->status }}</p>
                        </div>
                        <div class="col-md-12 mt-2 text-center">
                            <h2>{{ $post->title }}</h2>
                            <p>{{ $post->description }}</p>
                        </div>
                    </div>
                    @if ($post->userid == auth()->user()->id)
                        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#modalExcluir">Excluir Publicação</button>
                    @else
                        <a class="btn btn-dark" href="{{route('users.other_profile',['id'=>$post->userid])}}">Ver Perfil</a>
                    @endif
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
                                                <th>E-mail</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($answers as $answer)
                                                <tr>
                                                    <td>
                                                        <p>{{ $answer->comment }}</p>
                                                        <p class="text-muted">
                                                            {{ $answer->name }}
                                                        </p>
                                                    </td>
                                                    <td>{{ $answer->email }}</td>
                                                    <td>
                                                        <a class="btn btn-dark meu-outro-botao" href="{{route('users.other_profile',['id'=>$answer->users_id])}}">Ver Perfil</a>
                                                        <a class="btn btn-dark meu-outro-botao" href="{{route('users.send_message_to',['id'=>$answer->users_id,'title'=>$post->title])}}">Entrar em contato</a>
                                                        <a class="btn btn-dark meu-outro-botao" href="{{route('posts.rate', ['hire'=>$hire, 'id'=>$post->id, 'user'=>$answer->users_id])}}">Avaliar serviço</a>
                                                    </td>
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

        <!-- Modal Excluir Post -->
        <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="modalExcluir" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalExcluir">Excluir Publicação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                    <div class="modal-body">
                        @csrf
                        @method('delete')
                        <p>Você tem certeza que deseja excluir essa publicação?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                        <button type="submit" class="btn btn-primary">Sim</button>
                    </div>
                </form>
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