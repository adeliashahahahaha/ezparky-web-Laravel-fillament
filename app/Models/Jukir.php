<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Jukir extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $table = 'jukirs';

    protected $fillable = [
        'name',
        'nik',
        'dob',
        'address',
        'phone',
        'religion',
        'photo',
        'gender',
        'status'
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

    public function getFormattedPhoneAttribute()
    {
        return $this->phone ? substr_replace($this->phone, '****', 0, 4) : null;
    }

    public function getFormattedReligionAttribute()
    {
        return $this->religion ? ucfirst($this->religion) : null;
    }

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('d F Y H:i');
    }

    public function getFormattedUpdatedAtAttribute()
    {
        return $this->updated_at->format('d F Y H:i');
    }
}
