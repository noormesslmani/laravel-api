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

    function placeValue($num){
        $negative=false;
        if ($num<0){
            $negative=true;
            $num=$num*(-1);
        }
        $numarr=str_split($num);
        for ($i=0;$i<count($numarr);$i++){
            $numarr[$i]=$numarr[$i]*(10**(count($numarr)-1-$i));
            if($negative){
                $numarr[$i]=$numarr[$i]*(-1);
            }
        }

        return response()->json([
            'result'=>$numarr
        ]);
    }

    function toBinary($str){
        $arr=str_split($str);
        $newstr='';
        $i=0;
        while($i<count($arr)){
            $number='';
            if(!($arr[$i]<='9' && $arr[$i]>='0')){
                $newstr.=$arr[$i];
            }
            else{
                for($j=$i;$j<count($arr);$j++){
                    if(!($str[$j]<='9' && $str[$j]>='0')){
                        $i=$j-1;
                        break; 
                    }
                    $number.=$arr[$j];
                }
                $number= decbin(intval($number));
                $newstr.=$number;
            }
            $i++;
        }
        return response()->json([
            'result'=>$newstr
        ]);
    }
    function calculate($exp){
        $equationarr= (explode(" ",$exp));
        if ($equationarr[0]=='+'){
            $solution= intval($equationarr[1])+intval($equationarr[2]);
        }
        else if ($equationarr[0]=='-'){
            $solution= intval($equationarr[1])-intval($equationarr[2]);
        }
        else if ($equationarr[0]=='*'){
            $solution= intval($equationarr[1])*intval($equationarr[2]);
        }
        else if ($equationarr[0]=='÷'){
            $solution= intval($equationarr[1])/intval($equationarr[2]);
        }
        return response()->json([
            'result'=>$solution
        ]);
    }
}
