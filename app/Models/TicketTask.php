<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class TicketTask extends Model
{
    use HasFactory;
     protected $table = 'tasks';
     protected $fillable = [
         'specialist_id',
         'cc_id',
         'name',
     ];
    public function users(){
        return $this->belongsToMany(User::class);
    }
}
