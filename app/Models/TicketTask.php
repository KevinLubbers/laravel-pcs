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
    
    public function specialist() {
        return $this->belongsTo(User::class, 'specialist_id');
    }

    // Define relationship for cc_id
    public function cc() {
        return $this->belongsTo(User::class, 'cc_id');
    }
}
