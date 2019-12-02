@extends('adminlte::page')

@section('title', ' - Perfil')

@section('content_header')
    <h1 class="m-0 text-dark">Perfil de {{$user->name}}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
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
                            <a class="btn btn-dark meu-botao">Alterar dados</a>
                        </div>
                        <div class="col-md-6 mt-3">
                            <a class="btn btn-dark meu-botao">Alterar senha</a>
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
                        <a class="btn btn-dark meu-botao">Serviços Prestados</a>
                    </div>
                    <div class="col-md-12 mt-3">
                        <a class="btn btn-dark meu-botao">Serviços Solicitados</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
