<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itineraire extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'category',
        'duration',
        'img',
        'start_distenation',
        'final_distenation',
    ];

    public function destinations()
    {
        return $this->hasMany(Destination::class);
    }

    public function usersToVisit()
    {
        return $this->belongsToMany(User::class);
    }
}
