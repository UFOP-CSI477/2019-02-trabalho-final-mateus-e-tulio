@extends('adminlte::page')

@section('title', ' - Perfil')

@section('content_header')
    @if (Session::has('menssagem'))
    <div class="alert {{Session::get('classe-alerta','alert-info')}}">{{Session::get('menssagem')}}</div>
    @endif
    <h1 class="m-0 text-dark">Perfil de {{$user->name}}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
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
                            <label>Nº de recomendações como prestador</label>
                            <p>{{$countHireds}}</p>
                        </div>
                        <div class="col-md-6">
                            <label>Nº de recomendações como contratante</label>
                            <p>{{$countHirers}}</p>
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
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <label>Serviços Anteriores</label>
                    <div class="col-md-12">
                        <a class="btn btn-dark meu-botao">Serviços Prestados</a>
                    </div>
                    <div class="col-md-12 mt-2">
                        <a class="btn btn-dark meu-botao">Serviços Solicitados</a>
                    </div>
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
