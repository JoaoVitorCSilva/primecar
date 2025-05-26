@extends('adminlte::page')

@section('title', 'Cadastro de Veículos')

@section('content_header')

@stop

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Cadastro de Veículos</h3>
        </div>
        <div class="card-body"s>
            <div class="form-group">

                @if (isset($edit->id))
                    <form method="post" action="{{ route('veiculo.update', ['veiculo' => $edit->id]) }}">
                        @csrf
                        @method('PUT')
                    @else
                        <form method="post" action="{{ route('veiculo.store') }}">
                            @csrf
                @endif

                <div class="row">
                    <div class="col-sm-10">
                        <label for="modelo">Modelo</label>
                        <input type="text" class="form-control" id="modelo" name="modelo" placeholder=""
                            value="{{ $edit->modelo ?? old('modelo') }}">
                        @if ($errors->has('modelo'))
                            <span style="color: red;">
                                {{ $errors->first('modelo') }}
                            </span>
                        @endif
                        <br>
                    </div>
                    <div class="col-sm-2">
                        <label for="marca">Marca</label>
                        <input type="text" class="form-control" id="marca" name="marca" placeholder=""
                            value="{{ $edit->marca ?? old('marca') }}">
                        @if ($errors->has('marca'))
                            <span style="color: red;">
                                {{ $errors->first('marca') }}
                            </span>
                        @endif
                        <br>
                    </div>
                    <div class="col-sm-2">
                        <label for="placa">Placa</label>
                        <input type="text" class="form-control" id="placa" name="placa" placeholder=""
                            value="{{ $edit->placa ?? old('placa') }}">
                        @if ($errors->has('placa'))
                            <span style="color: red;">
                                {{ $errors->first('placa') }}
                            </span>
                        @endif
                        <br>
                    </div>
                    <div class="col-sm-2">
                        <label for="renavam">Renavam</label>
                        <input type="text" class="form-control" id="renavam" name="renavam" placeholder=""
                            value="{{ $edit->renavam ?? old('renavam') }}">
                        @if ($errors->has('renavam'))
                            <span style="color: red;">
                                {{ $errors->first('renavam') }}
                            </span>
                        @endif
                        <br>
                    </div>
                    <div class="col-sm-2">
                        <label for="chassi">Chassi</label>
                        <input type="text" class="form-control" id="chassi" name="chassi" placeholder=""
                            value="{{ $edit->chassi ?? old('chassi') }}">
                        @if ($errors->has('chassi'))
                            <span style="color: red;">
                                {{ $errors->first('chassi') }}
                            </span>
                        @endif
                        <br>
                    </div>
                    <div class="col-sm-2">
                        <label for="ano">Ano</label>
                        <input type="text" class="form-control" id="ano" name="ano" placeholder=""
                            value="{{ $edit->ano ?? old('ano') }}">
                        @if ($errors->has('ano'))
                            <span style="color: red;">
                                {{ $errors->first('ano') }}
                            </span>
                        @endif
                        <br>
                    </div>
                    <div class="col-sm-2">
                        <label for="cor">Cor</label>
                        <input type="text" class="form-control" id="cor" name="cor" placeholder=""
                            value="{{ $edit->cor ?? old('cor') }}">
                        @if ($errors->has('cor'))
                            <span style="color: red;">
                                {{ $errors->first('cor') }}
                            </span>
                        @endif
                        <br>
                    </div>
                    <div class="col-sm-2">
                        <label for="combustivel">Combustível</label>
                        <select class="form-control" id="combustivel" name="combustivel">
                            <option value="">Selecione</option>
                            <option value="Gasolina" {{ (isset($edit->combustivel) && $edit->combustivel == 'Gasolina') ? 'selected' : '' }}>Gasolina</option>
                            <option value="Álcool" {{ (isset($edit->combustivel) && $edit->combustivel == 'Álcool') ? 'selected' : '' }}>Álcool</option>
                            <option value="Diesel" {{ (isset($edit->combustivel) && $edit->combustivel == 'Diesel') ? 'selected' : '' }}>Diesel</option>
                            <option value="Flex" {{ (isset($edit->combustivel) && $edit->combustivel == 'Flex') ? 'selected' : '' }}>Flex</option>
                        </select>
                        @if ($errors->has('combustivel'))
                            <span style="color: red;">
                                {{ $errors->first('combustivel') }}
                            </span>
                        @endif
                        <br>
                    </div>
                    <div class ="col-sm-6">
                        <label for="observacao">Observação</label>
                        <textarea class="form-control" id="observacao" name="observacao" rows="3">{{ $edit->observacao ?? old('observacao') }}</textarea>
                        @if ($errors->has('observacao'))
                            <span style="color: red;">
                                {{ $errors->first('observacao') }}
                            </span>
                        @endif
                        <br>
                    </div>

                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Registrar</button>
            <a href="{{ route('veiculo.index') }}" type="button" class="btn btn-secondary">Voltar</a>
        </div>
        </form>

    </div>
@stop

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('js')
    <script src="{{ asset('vendor/jquery/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/jquery.maskMoney.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {

            // $('#cep').on('blur', function() {
                
            //     let cep = $('#cep').val();

            //     $.ajax({
            //         url: 'https://viacep.com.br/ws/' + cep + '/json/',
            //         type: 'GET',
            //         dataType: 'json',
            //         success: function(data) {
            //             if (!data.erro) {
            //                 $('#logradouro').val(data.logradouro);
            //                 $('#bairro').val(data.bairro);
            //                 $('#cidade').val(data.localidade);
            //                 $('#uf').val(data.uf);
            //             } else {
            //                 alert('CEP não encontrado.');
            //             }
            //         },
            //         error: function() {
            //             alert('Erro ao buscar o CEP.');
            //         }
            //     });
            // });

            $('#cep').on('blur', function() {
                
                let cep = $('#cep').val();

                let data_get = {
                    cep: cep
                };

                $.ajax({
                    url: '/consulta-cep',
                    type: 'GET',
                    dataType: 'json',
                    data: data_get,
                    success: function(data) {

                        console.log(data);

                        if (!data.erro) {
                            $('#logradouro').val(data.logradouro);
                            $('#bairro').val(data.bairro);
                            $('#cidade').val(data.localidade);
                            $('#uf').val(data.uf);
                        } else {
                            alert('CEP não encontrado.');
                        }
                    },
                    error: function() {
                        //alert('Erro ao buscar o CEP.');
                    }
                });
            });


        });
    </script>
@stop
