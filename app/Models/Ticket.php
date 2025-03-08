<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\TicketTask;
use App\Models\Division;
use App\Models\CarModel;

class Ticket extends Model
{
    use HasFactory;
    protected $table = 'tickets';
    protected $fillable = [
        'email',
        'specialist_id',
        'task_id',
        'year',
        'division_id',
        'model_id',
        'misc',
        'info_type',
        'info_number',
        'details',
        'attachments',
        'status',
    ];

    public function users(){
        return $this->belongsTo(User::class, 'specialist_id');
    }
}
