@extends('adminlte::page')

@section('title', ' - Perfil')

@section('css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat&display=swap">
    <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Perfil de {{$user->name}}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    @if (Session::has('message'))
                    <div class="alert {{Session::get('alert-class','alert-info')}}">{{Session::get('message')}}</div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <label>Nome</label>
                            <p>{{$user->name}}</p>
                        </div>
                        <div class="col-md-6">
                            <label>E-mail</label>
                            <p>{{$user->email}}</p>
                        </div>
                        <div class="col-md-6">
                            <label>Celular</label>
                            <p>{{$user->phone_number}}</p>
                        </div>
                        <div class="col-md-6">
                            <label>CEP</label>
                            <p>{{$user->cep}}</p>
                        </div>
                        <div class="col-md-6">
                            <label>Nº de recomendações como<br> prestador</label>
                            <p>{{$countHireds}}</p>
                        </div>
                        <div class="col-md-6">
                            <label>Nº de recomendações como<br> contratante</label>
                            <p>{{$countHirers}}</p>
                        </div>
                        <div class="col-md-6 mt-3">
                            <button type="button" class="btn btn-dark meu-botao" data-toggle="modal" data-target="#modalAlterarDados">Alterar dados</button>
                        </div>
                        <div class="col-md-6 mt-3">
                            <button type="button" class="btn btn-dark meu-botao" data-toggle="modal" data-target="#modalAlterarSenha">Alterar senha</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <label>Recomendações - Notas médias</label>
                    <div class="row progress-labels">
                        <div class="col-md-6">Como prestador</div>
                        <div class="col-md-6 text-right">{{$avgHireds}}%</div>
                    </div>
                    <div class="progress">
                        <div data-percentage="0%" style="width: {{$avgHireds}}%;" class="progress-bar progress-bar-blue" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="row progress-labels mt-1">
                        <div class="col-md-6">Como contratante</div>
                        <div class="col-md-6 text-right">{{$avgHirers}}%</div>
                    </div>
                    <div class="progress">
                        <div data-percentage="0%" style="width: {{$avgHirers}}%;" class="progress-bar progress-bar-blue" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <label>Serviços Anteriores</label>
                    <div class="col-md-12">
                        <a type="button" class="btn btn-dark meu-botao" data-toggle="modal" data-target="#modalServicosPrestados">Serviços Prestados</a>
                    </div>
                    <div class="col-md-12 mt-3">
                        <a type="button" class="btn btn-dark meu-botao" data-toggle="modal" data-target="#modalServicosSolicitados">Serviços Solicitados</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Alterar Dados -->
    <div class="modal fade" id="modalAlterarDados" tabindex="-1" role="dialog" aria-labelledby="modalAlterarDados" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAlterarDados">Alterar Dados</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/profile/settings/general" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input class="form-control" name="name" type="text" placeholder="Insira seu nome aqui" value="{{$user->name}}" required>
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Número de telefone</label>
                        <input class="form-control" name="phone_number" id="phone_number" type="text" placeholder="Insira seu número de telefone aqui" value="{{$user->phone_number}}" required>
                    </div>
                    <div class="form-group">
                        <label for="cep">CEP</label>
                        <input class="form-control" name="cep" id="cep" type="text" placeholder="Insira seu CEP aqui" value="{{$user->cep}}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar mudanças</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- Modal Alterar Senha -->
    <div class="modal fade" id="modalAlterarSenha" tabindex="-1" role="dialog" aria-labelledby="modalAlterarSenha" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAlterarSenha">Alterar Senha</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/profile/settings/security" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="senha_atual">Senha atual</label>
                        <input class="form-control" name="senha_atual" type="password" placeholder="Insira sua senha atual aqui" required>
                    </div>
                    <div class="form-group">
                        <label for="nova_senha">Nova senha</label>
                        <input class="form-control" name="nova_senha" type="password" placeholder="Insira sua nova senha aqui" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmacao_nova_senha">Confirme sua nova senha</label>
                        <input class="form-control" name="confirmacao_nova_senha" type="password" placeholder="Informe sua nova senha novamente" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar mudanças</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    {{-- Modal Listar Serviços Prestados --}}
    <div class="modal fade" id="modalServicosPrestados" tabindex="-1" role="dialog" aria-labelledby="modalServicosPrestados" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modalServicosPrestados">Serviços Prestados</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Publicação</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($servicosPrestados as $post)
                                        <tr>
                                            <td>
                                                <h3>{{ $post->title }}</h3>
                                                <p class="text-muted">
                                                    {{$post->username}} • {{$post->category}}
                                                </p>
                                            </td>
                                            <td><a class="btn btn-dark meu-outro-botao" href="{{ route('posts.show', ['hire' => 'hired', 'id' => $post->id]) }}">Ver mais</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
        </div>
    </div>
    
    {{-- Modal Listar Serviços Solicitados --}}
    <div class="modal fade" id="modalServicosSolicitados" tabindex="-1" role="dialog" aria-labelledby="modalServicosSolicitados" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modalServicosSolicitados">Serviços Solicitados</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Publicação</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($servicosSolicitados as $post)
                                        <tr>
                                            <td>
                                                <h3>{{ $post->title }}</h3>
                                                <p class="text-muted">
                                                    {{$post->username}} • {{$post->category}}
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
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
        </div>
    </div>
@stop

@push('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
    $(document).ready(function () { 

        var $campoTelefone = $('#phone_number');
        $campoTelefone.mask("(00) 0-0000-0000");

        var $campoCep = $("#cep");
        $campoCep.mask("00.000-000");
    });
</script>
@endpush
