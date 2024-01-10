<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Technology;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
    public function type() {
        return $this->belongsTo(Type::class);
    }    
    public function technologies() {
        return $this->hasMany(Technology::class);
    }
}
