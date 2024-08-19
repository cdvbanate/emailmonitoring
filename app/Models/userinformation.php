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
    ];

    protected static function booted()
    {
        static::created(function ($userinformation) {
            Mail::to($userinformation->email)->send(new Hellomail($userinformation));
        });

        static::updated(function ($userinformation) {
            // You can also send an email when the record is updated
            // Mail::to($userinformation->email)->send(new Hellomail($userinformation));
        });
    }

}
