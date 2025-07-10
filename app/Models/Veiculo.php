<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    protected $table = 'veiculos';
    protected $guarded = ['id'];

    public function locacoes()
    {
        return $this->hasMany(\App\Models\Locacao::class);
    }
    
    public function fotos()
    {
        return $this->hasMany(Foto::class);
    }

    public function clientes()
    {
        return $this->hasManyThrough(
            \App\Models\Cliente::class, // Model final
            \App\Models\Locacao::class, // Model intermediário
            'veiculo_id', // Foreign key em Locacao para Veiculo
            'id',         // Foreign key em Cliente (normalmente 'id')
            'id',         // Local key em Veiculo
            'cliente_id'  // Foreign key em Locacao para Cliente
        );
    }

    public function getSaldoAttribute()
    {
        // Retorna 1 se disponível, 0 se alugado
        $locacaoAtiva = $this->locacoes()->whereNull('data_devolucao')->where('deletado', 0)->exists();
        return $locacaoAtiva ? 0 : 1;
    }
}
