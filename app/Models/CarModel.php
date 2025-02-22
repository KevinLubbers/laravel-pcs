<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Division;

class CarModel extends Model
{
    use HasFactory;
    protected $table = 'car_models';

    protected $fillable = [
        'name',
        'division_id',
        'specialist_id',
    ];

   

    public function divisions(){
        return $this->belongsTo(Division::class);
    }
}
