<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Composition extends Model
{
    protected $table = 'compositions';

    protected $keyType = 'string';

    public $incrementing = false;
    
    public $timestamps = false;

    protected $fillable = [
        'id',
        'id_produto_composto',
        'id_produto_simples',
        'quantidade'
    ];

    public function produtoSimples(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'id_produto_simples', 'id');
    }

    public function produtoComposto(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'id_produto_composto', 'id');
    }
}
