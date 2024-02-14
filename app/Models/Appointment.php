<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Appointment extends Model
{
  use Notifiable;
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'name',
        'email',
        'appointmenttype',
        'appointmentdate',
        'appointmenttime',
        'appointmentendtime',
        
       

    ];
     



    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    
}
