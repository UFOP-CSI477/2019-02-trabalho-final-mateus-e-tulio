@extends('adminlte::page')

@section('title', ' - Resposta à Publicação')

@section('content_header')
    <h1 class="m-0 text-dark">{{ $post->title }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10 offset-1">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('feedbacks.store', ['i_hired'=> $i_hired, 'id'=> $post->id, 'user'=> $answer->users_id]) }}" method="get">
                    @csrf
                        <div class="row">
                            <div class="col-md-9">
                                <h4>{{ $i_hired ? 'Quem realizou meu serviço' : 'Quem me contratou' }}</h4>
                                <p>{{ $i_hired ? $answer->name : $post->username }}</p>
                            </div>
                            <div class="col-md-3">
                                    <h4> </h4>
                                    <button type="submit" class="btn btn-dark meu-botao">Avaliar {{ $i_hired ? 'Prestador' : 'Cliente'}}</button>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                    <h4>Qual nota você daria para este {{ $i_hired ? 'Prestador' : 'Cliente' }}?</h4>
                                    <select name="grade" id="grade" class="form-control" required>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10" selected>10</option>
                                    </select>
                            </div>
                            <div class="col-md-6">
                                    <h4>Deixe uma mensagem para {{ $i_hired ? $answer->name : $post->username }} (opcional)</h4>
                                    <textarea class="form-control" name="message" cols="30" rows="10" placeholder="Insira sua mensagem aqui"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop