<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Request extends Model
{
    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    public function produtos(): HasManyThrough
    {
        return $this->hasManyThrough(Product::class, RequestProduct::class, 'id_requisicao', 'id', 'id', 'id_produto');
    }

    public function requisicoes(): HasMany
    {
        return $this->hasMany(RequestProduct::class, 'id_requisicao', 'id');
    }

    public function usuarios(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_funcionario', 'id');
    }

    public function avaliador(): BelongsTo
    {
        return $this->belongsTo(User::class, 'avaliado_por', 'id');
    }
}
