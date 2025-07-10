@extends('adminlte::page')

@section('title', 'Cadastro de Veículos')

@section('content')
<div class="container">
    <div class="row">
        @foreach($veiculos as $veiculo)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow">
                @php
                    $fotoCapa = $veiculo->fotos->where('capa', true)->first() ?? $veiculo->fotos->first();
                @endphp

                @if($fotoCapa)
                    <img src="{{ asset('storage/' . $fotoCapa->caminho) }}" class="card-img-top" alt="Foto do veículo">
                @else
                    <img src="{{ asset('img/sem-foto.png') }}" class="card-img-top" alt="Sem foto">
                @endif

                <div class="card-body">
                    <h5 class="card-title">{{ $veiculo->modelo }}</h5>
                    <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#carroModal{{ $veiculo->id }}">Ver detalhes</button>
                </div>
            </div>
        </div>

        <!-- Modal com carrossel -->
        <div class="modal fade" id="carroModal{{ $veiculo->id }}" tabindex="-1" role="dialog" aria-labelledby="carroModalLabel{{ $veiculo->id }}" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="carroModalLabel{{ $veiculo->id }}">{{ $veiculo->modelo }} - {{ $veiculo->marca }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-7">
                    <!-- Carrossel -->
                    <div id="carousel{{ $veiculo->id }}" class="carousel slide" data-ride="carousel">
                      <div class="carousel-inner">
                        @foreach($veiculo->fotos as $key => $foto)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                          <img class="d-block w-100" src="{{ asset('storage/' . $foto->caminho) }}" alt="Foto {{ $key+1 }}">
                        </div>
                        @endforeach
                      </div>
                      <a class="carousel-control-prev" href="#carousel{{ $veiculo->id }}" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Anterior</span>
                      </a>
                      <a class="carousel-control-next" href="#carousel{{ $veiculo->id }}" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Próximo</span>
                      </a>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <!-- Informações do carro -->
                    <p><strong>Placa:</strong> {{ $veiculo->placa }}</p>
                    <p><strong>Ano:</strong> {{ $veiculo->ano_fabricacao }}</p>
                    <p><strong>Cor:</strong> {{ $veiculo->cor }}</p>
                    <p><strong>Combustível:</strong> {{ $veiculo->tipo_combustivel }}</p>
                    <p><strong>Origem:</strong> {{ $veiculo->origem }}</p>
                    <p><strong>Observações:</strong> {{ $veiculo->observacoes }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
    </div>
</div>
@endsection