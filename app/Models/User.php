<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $keyType = 'string';

    public $incrementing = 'false';

    const CREATED_AT = 'criado_em';

    const UPDATED_AT = 'atualizado_em';
}
