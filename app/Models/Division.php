<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\CarModel;

class Division extends Model
{
    use HasFactory;

    protected $table = 'divisions';
    protected $fillable = [
        'name',
        'specialist_id',  
    ];

    public function users(){
        return $this->belongsTo(User::class, 'specialist_id');
    }

    public function models(){
        return $this->hasMany(CarModel::class);
    }
}
