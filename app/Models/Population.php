<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Population extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function blood_type()
    {
        return $this->belongsTo(BloodType::class);
    }
    public function sex()
    {
        return $this->belongsTo(Sex::class);
    }
    public function citizen()
    {
        return $this->belongsTo(Citizen::class);
    }
    public function dusun()
    {
        return $this->belongsTo(Dusun::class);
    }
    public function family()
    {
        return $this->belongsTo(Family::class);
    }
    protected $table = 'tweb_penduduk';
}
