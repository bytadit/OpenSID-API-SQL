<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sex extends Model
{
    use HasFactory;

    public function penduduk()
    {
        return $this->hasMany(Penduduk::class);
        // return $this->belongsTo(GolonganDarah::class);
    }
    protected $table = 'tweb_penduduk_sex';
    protected $guarded = ['id'];
}