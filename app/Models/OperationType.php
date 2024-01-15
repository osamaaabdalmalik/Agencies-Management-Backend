<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationType extends Model
{
    use HasFactory;
    const CREATE_COURSE = 1;
    const UPDATE_COURSE = 2;
    const CREATE_RECIPTIONIST = 3;
    const UPDATE_RECIPTIONIST = 4;
    protected $guarded=[];

}
