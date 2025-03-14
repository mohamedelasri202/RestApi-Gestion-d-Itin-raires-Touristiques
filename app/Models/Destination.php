<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'itineraire_id',
        'type',
        'name',
        'lodging',
        'activities',
    ];
    public function itineraire()
    {
        return $this->belongsTo(itineraire::class);
    }
}
