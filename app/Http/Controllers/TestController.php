<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    function sortString($string){
        $stringarr=str_split($string);
        $chararr=[];
        $intarr=[];
        $result=[];
        foreach ($stringarr as $i) {
            if ($i<='9' && $i>='0'){
                array_push($intarr,$i);
            }
            else{
                array_push($chararr,$i);
            }
        }
        sort($intarr);
        natcasesort($chararr);
        $chararr=array_values($chararr);
        for ($i=0;$i<count($chararr)-1;$i++){
            if(ctype_upper($chararr[$i])==1){
                for($j=$i+1;$j<count($chararr);$j++){
                    if(strtolower($chararr[$i])==$chararr[$j]){
                        $temp=$chararr[$i];
                        $chararr[$i]=$chararr[$j];
                        $chararr[$j]=$temp;
                    }
                }
            }
        }
        $result=array_merge($chararr, $intarr);
        $string= implode($result);
        return response()->json([
            'result'=>$string
        ]);
    }
}
