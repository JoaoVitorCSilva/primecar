<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
    protected $table = 'carros';
    protected $guarded = ['id'];

    // Relacionamento com Foto
    public function fotos()
    {
        return $this->hasMany(Foto::class, 'carro_id');
    }

    // Relacionamento com Locacao
    public function locacoes()
    {
        return $this->hasMany(Locacao::class, 'carro_id');
    }

    // Relacionamento com Cliente (muitos para muitos via locacoes)
    public function clientes()
    {
        return $this->belongsToMany(Cliente::class, 'locacoes', 'carro_id', 'cliente_id');
    }

    // Relacionamento com Veiculo
    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class, 'veiculo_id');
    }

    // Relacionamento com Catalogo
    public function catalogo()
    {
        return $this->belongsTo(Catalogo::class, 'catalogo_id');
    }
}

// Ensure to run the migration to create the carros table
// You can use the command: php artisan make:migration create_carros_table
// Then define the schema in the migration file.    
