<?php

namespace App\Http\Controllers\Movie;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;

class MovieController extends Controller
{
    public function movie(){
        $seat='hall_one';
        $keys='movie_shop_'.$seat;
        $data=[];
        for ($i=1;$i<=30;$i++){
            $bit=Redis::getBit($keys,$i);
            $data[$i]=$bit;
        }
        $info=[
            'data'=>$data
        ];
        return view('movie.movie',$info);
    }
    public function doMovie($k){
        $status=1;
        $seat='hall_one';
        $keys='movie_shop_'.$seat;
        Redis::setbit($keys,$k,$status);
        echo "订座成功";
        header('refresh:2;url=/movie');
    }
}
