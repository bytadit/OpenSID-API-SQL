<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Population extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public function populations()
    {
        return $this->hasMany(Population::class);
    }

    public function cluster()
    {
        return $this->belongsTo(Cluster::class);
    }
    protected $table = 'tweb_keluarga';
}
