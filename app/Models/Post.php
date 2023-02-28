<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'body',
        'image_main',
        'image_sub1',
        'image_sub2',
        'image_sub3',
        'image_sub4',
        'hp_adress',
        'area_id',
        'park',
        'indoor_fac',
        'shopping',
        'gourmet',
        'others',
        'infant',
        'lower_grade',
        'higher_grade',
        'over13',
        'dogs',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function area() {
        return $this->belongsTo(Area::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function getFacilityKubun() {
        $str="";
        if($this->park      ==true){
            $str.="公園　";
        }
        if($this->indoor_fac==true){
            $str.="屋内施設　";
        }
        if($this->shopping  ==true){
            $str.="買物　";
        }
        if($this->gourmet   ==true){
            $str.="グルメ　";
        }
        if($this->others    ==true){
            $str.="その他　";
        }
        return $str;
    }

    public function getAgeStr($age){
        $str="";
        for($i=0;$i<$age;$i++){
            $str.="☆";
        }
        return $str;
    }

    public function getDogsStr(){
        $str="";
        switch($this->dogs){
            case 1:
                $str="NG";
                break;
            case 2:
                $str="OK";
                break;
            default:
                $str="不明";
        }

        return $str;
    }
}
