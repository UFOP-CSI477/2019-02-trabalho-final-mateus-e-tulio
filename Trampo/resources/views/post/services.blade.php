@extends('adminlte::page')

@section('title', ' - Serviços Disponíveis')

@section('content_header')
    <h1 class="m-0 text-dark">Serviços Disponíveis</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-10 offset-1">
            <div class="card">
                <div class="card-body">
                    <div class="accordion" id="filtersAccordion">
                        <div class="card">
                            <div class="card-header bg-dark" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn collapsed" style="color: #c2c7d0" type="button" data-toggle="collapse" data-target="#filters" aria-expanded="false" aria-controls="filters">
                                    Filtrar Resultados
                                    </button>
                                </h2>
                            </div>

                            <div id="filters" class="collapse" aria-labelledby="headingOne" data-parent="#filtersAccordion">
                              <div class="card-body">
                                <div class="row">
                                    <div class="col-4 form-group">
                                        <label for="estado">Estado</label>
                                        <select name="estado" id="estado" class="form-control">
                                                <option value="Prestador">Prestador</option>
                                        </select>
                                    </div>
                                    <div class="col-4 form-group">
                                        <label for="cidade">Cidade</label>
                                        <select name="cidade" id="cidade" class="form-control">
                                                <option value="Prestador">Prestador</option>
                                        </select>
                                    </div>
                                    <div class="col-4 form-group">
                                        <label for="bairro">Bairro</label>
                                        <select name="bairro" id="bairro" class="form-control">
                                                <option value="Prestador">Prestador</option>
                                        </select>
                                    </div>
                                    <div class="col-8 form-group">
                                        <label for="categoria">Categoria</label>
                                        <select name="categoria" id="categoria" class="form-control">
                                                <option value="Prestador">Prestador</option>
                                        </select>
                                    </div>
                                    <div class="col-4 form-group">
                                        <label for="send">  </label><br>
                                        <button class="btn btn-dark meu-botao" id="send">Filtrar Resultados</button>
                                    </div>
                                </div>
                              </div>
                            </div>
                          </div>
                    </div>

            </div>
        </div>
    </div>
@stop