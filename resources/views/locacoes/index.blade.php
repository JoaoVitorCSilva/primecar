@extends('adminlte::page')

@section('title', 'Controle de locação')

@section('content_header')
    
@stop

@section('plugins.Datatables', true)

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Controle de Locação</h3>
        </div>

        <div class="card-body">
            <div>
                <a href="{{ route('locacao.create') }}" type="button" class="btn btn-primary" style="width:80px;">Novo</a>
                {{-- <button id="btn-apagar-todas" class="btn btn-danger ml-2">Apagar todas as locações</button> --}}
            </div>
            <br>
            <table class="table table-bordered table-striped dataTable dtr-inline" id="locacao-table"
                style="font-size: 15px;">
                <thead>
                    <tr>
                        <th style="width: 5%">Id</th>
                        <th style="width: 30%">Cliente</th>
                        <th style="width: 30%">Veículo</th>
                        <th style="width: 10%">Dt. Locação</th>
                        <th style="width: 10%">Prev. Devolução</th>
                        <th style="width: 10%">Ações</th>
                    </tr>
                </thead>
            </table>
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

            $('#locacao-table').DataTable({
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
                ajax: "{{ route('locacao.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nome',
                        name: 'nome'
                    },
                    {
                        data: 'modelo',
                        name: 'modelo'
                    },
                    {
                        data: 'data_locacao',
                        name: 'data_locacao'
                    },
                    {
                        data: 'data_prevista_devolucao',
                        name: 'data_prevista_devolucao'
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>

    {{-- <script>
        $('#btn-apagar-todas').on('click', function() {
            if(confirm('Tem certeza que deseja apagar TODAS as locações?')) {
                $.ajax({
                    url: '{{ route('locacao.apagarTodas') }}',
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if(response.success) {
                            location.reload();
                        }
                    }
                });
            }
        });
    </script> --}}
@stop
