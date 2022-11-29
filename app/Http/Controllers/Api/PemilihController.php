<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Models\Population;
// use App\Models\Dusun;
use App\Http\Resources\PemilihResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
class PemilihController extends Controller
{
    //     /**
    //  * index
    //  *
    //  * @return void
    //  */
    public function index()
    {
        $pemilih = DB::table('tweb_penduduk')->where('tweb_penduduk.tanggallahir','>=', Carbon::now()->subYear(18))
                    ->leftJoin('tweb_wil_clusterdesa', 'tweb_penduduk.id_cluster', '=', 'tweb_wil_clusterdesa.id')
                    ->leftJoin('tweb_penduduk_sex', 'tweb_penduduk.sex', '=', 'tweb_penduduk_sex.id')
                    ->select(['tweb_wil_clusterdesa.id as DusunID', 'tweb_wil_clusterdesa.dusun as DusunName', 'tweb_wil_clusterdesa.rt AS RT', 'tweb_wil_clusterdesa.rw AS RW',
                                DB::raw("COUNT(CASE WHEN tweb_penduduk_sex.nama = 'LAKI-LAKI' THEN 1 END) as Lk"),
                                DB::raw("COUNT(CASE WHEN tweb_penduduk_sex.nama = 'PEREMPUAN' THEN 1 END) as Pr"),
                                DB::raw("COUNT(*) AS Jiwa")
                             ]
                            )
                        ->groupBy(['tweb_wil_clusterdesa.dusun'])
                        ->get();

        return new PemilihResource(true, 'Data Calon Pemilih', $pemilih);
    }

    // public function store(Request $request)
    // {
    //     //define validation rules
    //     $validator = Validator::make($request->all(), [
    //         'name'      => 'required|max:100',
    //         'nik'       => 'required|unique:populations|size:16',
    //         'dusun_id'     => 'required|integer|between:1,4',
    //         'sex_id'   => 'required|integer|between:1,2',
    //         'citizen_id'     => 'required|integer|between:1,3',
    //         'blood_type_id'   => 'required|integer|between:1,4',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 422);
    //     }

    //     $populations = Population::create([
    //         'name'     => $request->name,
    //         'nik'     => $request->nik,
    //         'dusun_id'     => $request->dusun_id,
    //         'sex_id'     => $request->sex_id,
    //         'citizen_id'     => $request->citizen_id,
    //         'blood_type_id'   => $request->blood_type_id,
    //     ]);

    //     return new PopulationResource(true, 'Data Penduduk Berhasil Ditambahkan!', $populations);
    // }

    // public function show(Population $population)
    // {
    //     return new PopulationResource(true, 'Data Penduduk Ditemukan!', $population);
    // }

    // public function update(Request $request, Population $population)
    // {
    //     $rules = [
    //         'name'      => 'required|max:100',
    //         'dusun_id'     => 'required|integer|between:1,4',
    //         'sex_id'   => 'required|integer|between:1,2',
    //         'citizen_id'     => 'required|integer|between:1,3',
    //         'blood_type_id'   => 'required|integer|between:1,4',
    //     ];
    //     if($request->nik != $population->nik){
    //         $rules['nik'] = 'required|unique:populations|size:16';
    //     };

    //     $validatedData = $request->validate($rules);
    //     Population::where('id', $population->id)
    //                 ->update($validatedData);

    //     return new PopulationResource(true, 'Data Penduduk Berhasil Diubah!', $population);
    // }
    // public function destroy(Population $population)
    // {

    //     $population->delete();

    //     //return response
    //     return new PopulationResource(true, 'Data Penduduk Berhasil Dihapus!', null);
    // }
}
