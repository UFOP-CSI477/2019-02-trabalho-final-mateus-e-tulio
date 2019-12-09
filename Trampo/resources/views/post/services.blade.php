@extends('adminlte::page')

@section('title', ' - Encontrar Trabalho')

@section('content_header')
    <h1 class="m-0 text-dark">Encontrar Trabalho</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10 offset-1">
            <div class="card">
                <div class="card-body">
                    <div class="accordion" id="filtersAccordion">
                        <div class="card">
                            <div class="card-header bg-dark" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn" style="color: #c2c7d0" type="button" data-toggle="collapse" data-target="#filters" aria-expanded="true" aria-controls="filters">
                                    Filtrar Resultados
                                    </button>
                                </h2>
                            </div>

                            <div id="filters" class="collapse show" aria-labelledby="headingOne" data-parent="#filtersAccordion">
                              <div class="card-body">
                                <form action="{{ route('services') }}" action="get">
                                    @csrf
                                    @method('get')
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <label for="estado">Estado</label>
                                            <select name="estado" id="estado" class="form-control dynamic" data-dependent="cidade">
                                                <option value="">Selecionar Estado</option>
                                                @foreach ($states as $state)
                                                    <option value="{{ $state->state }}" {{ $request->estado == $state->state ?  'selected' : '' }}  >{{ $state->state }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="cidade">Cidade</label>
                                            <select name="cidade" id="cidade" class="form-control dynamic" data-dependent="bairro">
                                                <option value="">Selecionar Cidade</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="bairro">Bairro</label>
                                            <select name="bairro" id="bairro" class="form-control dynamic">
                                                <option value="">Selecionar Bairro</option>
                                            </select>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <label for="categoria">Categoria</label>
                                            <select name="categoria" id="categoria" class="form-control">
                                                <option value="">Selecionar Categoria</option>
                                                @foreach ($categorias as $categoria)
                                                    <option value="{{$categoria->id}}" {{ $request->categoria == $categoria->id ?  'selected' : '' }} >{{$categoria->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="send">  </label><br>
                                            <button class="btn btn-dark meu-botao" id="send">Filtrar Resultados</button>
                                        </div>
                                    </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>

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
                                        @foreach ($posts as $post)
                                            <tr>
                                                <td>
                                                    <h3>{{ $post->title }}</h3>
                                                    <p class="text-muted">
                                                        @if (strlen($post->description) > 130)
                                                            {{ substr($post->description, 0, 127) . '...' }}
                                                        @else
                                                            {{ $post->description }}
                                                        @endif
                                                    </p>
                                                </td>
                                                <td><a class="btn btn-dark meu-outro-botao" href="{{ route('posts.show', ['hire' => 'hirer', 'id' => $post->id]) }}">Ver mais</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.dynamic').change(function(){
                var select = $(this).attr("id");
                var value = $(this).val();
                var _token = $('input[name="_token"]').val();
                if(value != '')
                {
                    var dependent = $(this).data('dependent');
                    if (select == 'cidade' || select == 'estado') {
                        $.ajax({
                            url:"{{ route('posts.dynamic') }}",
                            method:"POST",
                            data:{select:select, value:value, _token:_token, dependent:dependent, hire:'hired_id'},
                            success:function(result)
                            {
                                $('#'+dependent).html(result);
                            }
                        });
                    }
                }
                $.ajax({
                    url:"{{ route('posts.dcat') }}",
                    method:"POST",
                    data:{select:select, value:value, _token:_token, hire:'hired_id'},
                    success:function(result)
                    {
                        $('#categoria').html(result);
                    }
                });
            });

            $('#estado').change(function(){
                $('#cidade').val('');
                $('#bairro').val('');
            });

            $('#cidade').change(function(){
                $('#bairro').val('');
            });
        });
    </script>
@stop