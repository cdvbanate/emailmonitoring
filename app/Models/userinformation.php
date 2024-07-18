<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userinformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullname',
        'sex',
        'email',
        'date_received',
        'date_emailed',
        'mode_of_communication',
        'nature_of_concern',
        'actual_inquiry',
        'recommendation',
        'person_in_charge',
    ];
}
