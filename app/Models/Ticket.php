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
        'status',
        'attachments',
    ];
    protected $casts = [
        'attachments' => 'array',
    ];

    public function users(){
        return $this->belongsTo(User::class, 'specialist_id');
    }
    public function tasks()
    {
    return $this->belongsTo(TicketTask::class, 'task_id');
    }
    public function divisions()
    {
    return $this->belongsTo(Division::class, 'division_id');
    }
    public function models()
    {
    return $this->belongsTo(CarModel::class, 'model_id');
    }

    public function getDisplayNumberAttribute(): string
    {
        return 'PCS-' . str_pad($this->id, 7, '0', STR_PAD_LEFT);
    }

    public function getInfoTypeLabelAttribute(): string
    {
        return match ($this->info_type) {
            'fo' => 'FO Number',
            'customer' => 'Customer 9 Number',
            default => '',
        };
    }
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'completed' => 'Resolved Ticket',
            'unresolved' => 'New Ticket - Unsolved',
            'in_progress' => 'In Progress',
            'escalated' => 'Escalated Ticket',
            default => '',
        };
    }

}
