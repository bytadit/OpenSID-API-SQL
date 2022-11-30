<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\SexResource;
use Illuminate\Support\Facades\DB;

class SexController extends Controller
{
    public function index(){
        $sex = DB::table('tweb_penduduk')
            ->join('tweb_penduduk_sex', 'tweb_penduduk.sex', '=', 'tweb_penduduk_sex.id')
            ->select('tweb_penduduk_sex.id as id_jenis_kelamin','tweb_penduduk_sex.nama as jenis_kelamin', DB::raw('COUNT(*) as total'))
            ->groupBy('tweb_penduduk_sex.nama')
            ->get();

        return new SexResource(true, 'List Data Jenis Kelamin', $sex);
    }
}