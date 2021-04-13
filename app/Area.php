<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Area extends Model
{
    protected $guarded = ['id'];
    protected $table = 'area';
    protected $fillable = ['id','parent_id','name','old_name','level','maps_id','post_code','geo'];
    CONST LUAR_JATENG = 32676;
    public $timestamps = false;



    static function getProvince(){
        return self::where('level',1);
    }
    CONST KORWIL_SEMARANG = [41585,39181,41558,39746,38917,37214];
    CONST KORWIL_PATI = [38136,38564,38706,37514,37826];
    CONST KORWIL_PEKALONGAN = [41779,40317,40053,40859,41831,41165,40622];
    CONST KORWIL_BANYUMAS = [32986,33603,32677,33345];
    CONST KORWIL_SURAKARTA = [35862,35575,36470,36290,36985,41501,36790];
    CONST KORWIL_KEDU = [34389,39436,34900,33902,35181,41480];

    /**
     * Get List Kabupaten / Kota
     * @param int $provinceId
     * @return mixed
     */
    static function getDistrict(int $provinceId = 32676){
        return self::where(['parent_id'=>$provinceId,'level'=>2]);
    }

    /**
     * Get List Kecamatan
     * @param id dari kabupaten
     * @return class
     */
    static function getSubDistrict($id){
        return self::where(['parent_id'=>$id,'level'=>3]);
    }

    /**
     * Get List Desa
     * @param id dari kecamatan
     * @return class
     */
    static function getVillage($id){
        return self::where(['parent_id'=>$id,'level'=>4]);
    }

    static function getIdByKode($kode){
        $data = self::select('id')->where('kdc',$kode)->first();
        if($data) $data = $data->id;
        return $data;
    }

    public static function listKorwil($userId){
        switch($userId){
            case 2878 : return self::KORWIL_SEMARANG;
            case 2879 : return self::KORWIL_PATI;
            case 2880 : return self::KORWIL_PEKALONGAN;
            case 2881 : return self::KORWIL_BANYUMAS;
            case 2882 : return self::KORWIL_SURAKARTA;
            case 2883 : return self::KORWIL_KEDU;
        }
    }

    public static function getKorwil($userId)
    {
        $listKorwil = self::listKorwil($userId);
        return self::whereIn('id',$listKorwil)->get();
    }

    public static function getKabByName(String $kabName,int $provId = 32676){
        return self::where([
            "name"      => strtoupper($kabName),
            'parent_id' => $provId
        ]);
    }

    public static function getKecByName(String $kabName,String $kecName,int $provId = 32676){
        return DB::select('
            select
                kec.id kec_id,
                kab.id kab_id
            from area kec
            join area kab on kab.id = kec.parent_id and kab.name = "'.$kabName.'" and kab.parent_id = '.$provId.'
            where kec.level = 3 and kec.name = "'.$kecName.'"
            limit 1;
        ');
    }

    public static function getKelByName(String $kabName,String $kecName,int $provId = 32676){
        return DB::select('
            select
                kec.id kec_id,
                kab.id kab_id
            from area kec
            join area kab on kab.id = kec.parent_id and kab.name = "'.$kabName.'" and kab.parent_id = '.$provId.'
            where kec.level = 3 and kec.name = "'.$kecName.'"
            limit 1;
        ');
    }

    public static function getKelById(int $kelId){
        return DB::select("
            select
                kec.id kec_id,
                kab.id kab_id
            from area kel
                join area kec on kec.id = kel.parent_id
                join area kab on kab.id = kec.parent_id
            where kel.id = '".$kelId."'
            limit 1
        ");
    }
}
