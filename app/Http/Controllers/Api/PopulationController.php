<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Models\Population;
// use App\Models\Dusun;
use App\Http\Resources\PopulationResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
class PopulationController extends Controller
{
    //     /**
    //  * index
    //  *
    //  * @return void
    //  */
    public function index()
    {
        $population = DB::table('tweb_penduduk')
                        ->leftJoin('tweb_wil_clusterdesa', 'tweb_penduduk.id_cluster', '=', 'tweb_wil_clusterdesa.id')
                        ->leftJoin('tweb_penduduk_sex', 'tweb_penduduk.sex', '=', 'tweb_penduduk_sex.id')
                        ->select(['tweb_wil_clusterdesa.id as DusunID', 'tweb_wil_clusterdesa.dusun as DusunName', 'tweb_wil_clusterdesa.rt AS RT', 'tweb_wil_clusterdesa.rw AS RW',
                                    DB::raw("COUNT(DISTINCT tweb_penduduk.id_kk) as 'Jumlah KK'"),
                                    DB::raw("COUNT(CASE WHEN tweb_penduduk_sex.nama = 'LAKI-LAKI' THEN 1 END) as Pria"),
                                    DB::raw("COUNT(CASE WHEN tweb_penduduk_sex.nama = 'PEREMPUAN' THEN 1 END) as Wanita"),
                                    DB::raw("COUNT(*) AS Total_PW")
                                 ]
                                )
                        ->groupBy(['tweb_wil_clusterdesa.dusun'])
                        ->get();

        return new PopulationResource(true, 'Data Populasi', $population);
    }
}
