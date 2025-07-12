@extends('adminlte::page')

@section('title', 'Cadastro de Veículos')

@section('content_header')
@section('plugins.Datatables', true)

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de Veículos</h3>
        </div>

        <div class="card-body">
            {{-- <div>
                <a href="{{ route('veiculo.create') }}" type="button" class="btn btn-primary" style="width:80px;">Novo</a>
            </div>
            <br> --}}
            {{-- 
            <table class="table table-bordered table-striped dataTable dtr-inline" id="veiculo-table" style="font-size: 15px;">
                <thead>
                    <tr>
                        <th style="width: 15%">Modelo</th>
                        <th style="width: 10%">Marca</th>
                        <th style="width: 10%">Origem</th>
                        <th style="width: 10%">Ano</th>
                        <th style="width: 10%">Cor</th>
                        <th style="width: 10%">Combustível</th>
                        <th style="width: 10%">Status</th>
                        <th style="width: 20%">Observação</th>
                    </tr>
                </thead>
            </table>
            --}}

            <div class="container">
                <div class="row">
                    @foreach($veiculos as $veiculo)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow">
                            @php
                                // Busca a foto marcada como capa, se não houver pega a primeira
                                $fotoCapa = $veiculo->fotos->where('capa', true)->first() ?? $veiculo->fotos->first();
                            @endphp
                            @if($fotoCapa)
                                <img src="{{ asset('storage/' . $fotoCapa->caminho) }}" class="card-img-top" alt="Foto do veículo" style="width: 100%; height: 200px; object-fit: cover;">
                            @else
                                <img src="{{ asset('img/sem-foto.png') }}" class="card-img-top" alt="Sem foto">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $veiculo->modelo }}</h5>
                                <p class="card-text">
                                    Marca: {{ $veiculo->marca }}<br>
                                    Ano: {{ $veiculo->ano_fabricacao ?? '' }}<br>
                                    Cor: {{ $veiculo->cor }}<br>
                                    Status:
                                    @if($veiculo->saldo == 1)
                                        <span class="badge badge-success">Disponível</span>
                                    @elseif($veiculo->saldo == 0)
                                        <span class="badge badge-danger">Alugado</span>
                                    @else
                                        <span class="badge badge-secondary">Indefinido</span>
                                    @endif
                                </p>
                                <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#carroModal{{ $veiculo->id }}">Ver detalhes</button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="carroModal{{ $veiculo->id }}" tabindex="-1" role="dialog" aria-labelledby="carroModalLabel{{ $veiculo->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="carroModalLabel{{ $veiculo->id }}">{{ $veiculo->modelo }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div id="carouselExampleIndicators{{ $veiculo->id }}" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    @foreach($veiculo->fotos as $index => $foto)
                                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                            <img src="{{ asset('storage/' . $foto->caminho) }}" class="d-block w-100" alt="Foto do veículo" style="width: 100%; height: 300px; object-fit: cover;">
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <a class="carousel-control-prev" href="#carouselExampleIndicators{{ $veiculo->id }}" role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control-next" href="#carouselExampleIndicators{{ $veiculo->id }}" role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <h5>Detalhes do Veículo</h5>
                                            <p>
                                                <strong>Marca:</strong> {{ $veiculo->marca }}<br>
                                                <strong>Ano de Fabricação:</strong> {{ $veiculo->ano_fabricacao }}<br>
                                                <strong>Cor:</strong> {{ $veiculo->cor }}<br>
                                                <strong>Combustível:</strong> {{ $veiculo->tipo_combustivel }}<br>
                                                <strong>Origem:</strong> {{ $veiculo->origem == 0 ? 'Nacional' : 'Importado' }}<br>
                                                <strong>Status:</strong> {{ $veiculo->saldo == 1 ? 'Disponível' : 'Indisponível' }}<br>
                                                <strong>Observações:</strong> {{ $veiculo->observacoes }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css">
@stop

@section('js')

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {

            $('#veiculo-table').DataTable({
                // Desabilita a pesquisa, paginação e informações
                searching: false,
                lengthChange: false,
                paging: false,
                info: false,
            
                language: {
                    "url": "{{ asset('js/pt-br.json') }}"
                },
                processing: true,
                serverSide: true,

                ajax: "{{ route('veiculo.index') }}",
                columns: [
                    {
                        data: 'modelo',
                        name: 'modelo'
                    },
                    {
                        data: 'marca',
                        name: 'marca'
                    },
                    {
                         data: 'origem',
                         name: 'origem',
                        render: function (data) {
                            if (data == 0) {
                                 return '<span class="badge badge-success">Nacional</span>';
                            } else if (data == 1) {
                                return '<span class="badge 	badge bg-danger ">Importado</span>';
                             }
                                return data;
                        }
                 },
            
                    {
                        data: 'ano_fabricacao',
                        name: 'ano_fabricacao',
                    },
                    {
                        data: 'cor',
                        name: 'cor'
                    },
                    {
                        data: 'tipo_combustivel',
                        name: 'tipo_combustivel'
                    },
                    {
                        data: 'saldo',
                        name: 'saldo',
                        render: function(data, type, row) {
                            if (data == 1) {
                                return '<span class="badge badge-success">Disponível</span>';
                            } else if (data == 0) {
                                return '<span class="badge badge-danger">Alugado</span>';
                            } else {
                                return data;
                            }
                        }
                    },
                    {
                        data: 'observacoes',
                        name: 'observacoes'
                    },

                ]
            });
        });
    </script>
@stop

