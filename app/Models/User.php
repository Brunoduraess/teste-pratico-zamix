<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    protected $keyType = 'string';

    public $incrementing = 'false';

    const CREATED_AT = 'criado_em';

    const UPDATED_AT = 'atualizado_em';

    public function entradas(): HasMany
    {
        return $this->hasMany(Input::class, 'id_funcionario', 'id');
    }

    public function requisicoes(): HasMany
    {
        return $this->hasMany(Request::class, 'id_funcionario', 'id');
    }
}
