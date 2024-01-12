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
        'image',
        'type_id'
    ];
    public function type() {
        return $this->belongsTo(Type::class);
    }    
    public function technologies() {
        return $this->belongsToMany(Technology::class);
    }
}
