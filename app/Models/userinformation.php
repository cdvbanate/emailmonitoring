<?php

namespace App\Models;

use App\Mail\Hellomail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

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
        'status',
    ];

    protected static function booted()
    {
        static::created(function ($userinformation) {
            Mail::to($userinformation->email)->send(new Hellomail($userinformation));
        });
    
        static::updated(function ($userinformation) {
            // Check if the status was changed to 'Approved'
            if ($userinformation->isDirty('status') && $userinformation->status === 'Approved') {
                Mail::to($userinformation->email)->send(new Hellomail($userinformation));
            }
        });
    }

}
