<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Land extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $table = 'lands';

    protected $fillable = [
        'name',
        'nik',
        'dob',
        'type',
        'land_status',
        'photo',
        'size',
        'status',
        'address',
        'phone',
        'latitude',
        'longitude',
        'car_capacity',
        'motor_capacity',
        'bicycle_capacity'
    ];

    protected $casts = [
        'dob' => 'date',
    ];


    public function getPhotoUrlAttribute()
    {
        return $this->photo ? asset('storage/' . $this->photo) : null;
    }

    public function getAgeAttribute()
    {
        return $this->dob->age;
    }

    public function getFormattedDobAttribute()
    {
        return $this->dob->format('d F Y');
    }
}
