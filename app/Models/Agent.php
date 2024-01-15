<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Agent extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [];
    protected $hidden = ['password', 'receipt_number', 'receptionist_id', 'course_id', 'client_id', 'left_id', 'right_id', 'parent_id', 'created_at', 'updated_at'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function parent()
    {
        return $this->belongsTo(Agent::class, 'parent_id');
    }

    public function left()
    {
        return $this->belongsTo(Agent::class, 'left_id');
    }

    public function right()
    {
        return $this->belongsTo(Agent::class, 'right_id');
    }
}

