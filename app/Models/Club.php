<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    protected $fillable = ['name']; // Adjust as needed

    public function competitions()
    {
        return $this->belongsToMany(Competition::class, 'participants')
                    ->withPivot('created_at');
    }
}
