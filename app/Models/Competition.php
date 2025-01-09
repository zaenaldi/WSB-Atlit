<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    protected $fillable = ['name']; // Adjust as needed

    public function clubs()
    {
        return $this->belongsToMany(Club::class, 'participants')
                    ->withPivot('created_at');
    }
}
