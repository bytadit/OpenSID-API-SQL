<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodType extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public function populations()
    {
        return $this->hasMany(Population::class);
    }
    protected $table = 'tweb_golongan_darah';
}
