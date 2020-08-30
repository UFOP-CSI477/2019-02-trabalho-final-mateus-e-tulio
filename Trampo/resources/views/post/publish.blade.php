@extends('adminlte::page')

@section('title', ' - Criar Publicação')

@section('css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat&display=swap">
    <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Criar Publicação</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-10 offset-1">
            <div class="card">
                <div class="card-body">
                    @if (Session::has('message'))
                    <div class="alert {{Session::get('alert-class','alert-info')}}">{{Session::get('message')}}</div>
                    @endif
                    <form action="{{ route('posts.store') }}" method="post">
                    @csrf
                        <div class="form-group">
                            <label for="tipo">Tipo</label>
                            <select name="tipo" id="tipo" class="form-control" required>
                                    <option value="Contratante">Contratante</option>
                                    <option value="Prestador">Prestador</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="categoria">Categoria</label>
                            <select name="categoria" id="categoria" class="form-control" required>
                                @foreach ($categorias as $categoria)
                                    <option value="{{$categoria->id}}">{{$categoria->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="cep">CEP</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="cep" id="meu_cep" value="meu" checked>
                                <label class="form-check-label" for="meu_cep">
                                Meu CEP ({{auth()->user()->cep}})
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="cep" id="radio_outro_cep" value="">
                                <label class="form-check-label" for="radio_outro_cep">
                                Outro CEP
                                </label>
                                <input type="text" class="form-control" name="input_outro_cep" id="input_outro_cep">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Insira o título aqui" required>
                        </div>
                        <div class="form-group">
                            <label for="descricao">Descrição</label>
                            <textarea class="form-control" name="descricao" cols="30" rows="10" placeholder="Insira a descrição aqui" required></textarea>
                        </div>
                        <button class="btn btn-dark">Criar Publicação</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
    $(document).ready(function () { 
        var $campoCep = $("#input_outro_cep");
        $campoCep.mask("00.000-000");
    });
</script>
@endpush