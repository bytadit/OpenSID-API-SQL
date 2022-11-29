<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Models\Population;
// use App\Models\BloodType;
use App\Http\Resources\BloodTypeResource;
use Illuminate\Support\Facades\DB;

class BloodTypeController extends Controller
{
    //     /**
    //  * index
    //  *
    //  * @return void
    //  */
    public function index()
    {
        $bloodType = DB::table('tweb_penduduk')
                        ->leftJoin('tweb_golongan_darah', 'tweb_penduduk.golongan_darah_id', '=', 'tweb_golongan_darah.id')
                        ->leftJoin('tweb_penduduk_sex', 'tweb_penduduk.sex', '=', 'tweb_penduduk_sex.id')
                        ->select(['tweb_golongan_darah.id as BloodTypeID', 'tweb_golongan_darah.nama as BloodTypeName',
                                    DB::raw("COUNT(CASE WHEN tweb_penduduk_sex.nama = 'LAKI-LAKI' THEN 1 END) as Pria"),
                                    DB::raw("COUNT(CASE WHEN tweb_penduduk_sex.nama = 'PEREMPUAN' THEN 1 END) as Wanita"),
                                    DB::raw("COUNT(*) AS Total")
                                 ]
                                )
                        ->groupBy('tweb_golongan_darah.nama')
                        ->get();

        return new BloodTypeResource(true, 'Data Golongan Darah', $bloodType);
    }
}
