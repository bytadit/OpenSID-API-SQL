<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Population extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public function families()
    {
        return $this->hasMany(Family::class);
    }
    protected $table = 'tweb_wil_clusterdesa';
}
