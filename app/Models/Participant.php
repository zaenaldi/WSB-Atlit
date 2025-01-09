<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = ['id_competition', 'id_club', 'ranking'];

    public function club()
    {
        return $this->belongsTo(Club::class, 'id_club', 'id');
    }

    public function competition()
    {
        return $this->belongsTo(Competition::class, 'id_competition', 'id');
    }
}
