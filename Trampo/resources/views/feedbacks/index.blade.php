@extends('adminlte::page')

@section('title', ' - Avaliações')

@section('css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat&display=swap">
    <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Avaliações</h1>
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
                                            <th>Comentários sobre publicações</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($feedbacks as $feedback)
                                            <tr>
                                                <td>
                                                    <h3>{{ $feedback->title }}</h3>
                                                    <p class="text-muted">
                                                        {{ $feedback->hired_id == auth()->user()->id ? $feedback->message_for_hired : $feedback->message_for_hirer }}
                                                    </p>
                                                </td>
                                                <td><a class="btn btn-dark meu-outro-botao" href="{{ route('feedbacks.show', $feedback->id) }}">Ver mais</a></td>
                                            </tr>
                                        @endforeach
                                        @foreach ($feedbacks_r as $feedback)
                                            <tr>
                                                <td>
                                                    <h3>{{ $feedback->title }}</h3>
                                                    <p class="text-muted">
                                                        {{ $feedback->hired_id == auth()->user()->id ? $feedback->message_for_hired : $feedback->message_for_hirer }}
                                                    </p>
                                                </td>
                                                <td></td>
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