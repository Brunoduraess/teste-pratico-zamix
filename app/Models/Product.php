<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    protected $keyType = 'string';

    public $incrementing = false;

    const CREATED_AT = 'criado_em';

    const UPDATED_AT = 'atualizado_em';

    public function composicoes(): HasMany
    {
        return $this->hasMany(Composition::class, 'id_produto_composto', 'id');
    }

    public function estoque(): HasOne
    {
        return $this->hasOne(Stock::class, 'id_produto', 'id');
    }

    public function entrada(): HasMany
    {
        return $this->hasMany(Input::class, 'id_produto', 'id');
    }

    public function requisicoes(): HasMany
    {
        return $this->hasMany(RequestProduct::class, 'id_produto', 'id');
    }
}
