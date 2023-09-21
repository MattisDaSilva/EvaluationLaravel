<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'reference',
        'prix',
        'marque_id',
    ];

    public function marque()
    {
        return $this->belongsTo(Marque::class);
    }
}
