@extends('adminlte::page')

@section('title', ' - Criar Publicação')

@section('content_header')
    <h1 class="m-0 text-dark">Criar Publicação</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-10 offset-1">
            <div class="card">
                <div class="card-body">
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
                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Insira o título aqui" required>
                        </div>
                        <div class="form-group">
                            <label for="descricao">Descrição</label>
                            <textarea class="form-control" name="descricao" cols="30" rows="10" placeholder="Insira a descrição aqui" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="cep">CEP do local (onde o publicação se refere)</label>
                            <input type="number" class="form-control" name="cep" placeholder="0000000" required>
                        </div>
                        <button class="btn btn-dark">Criar Publicação</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop