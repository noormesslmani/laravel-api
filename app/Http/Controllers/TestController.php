<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //function that returns a string sorted as aAbB....123...etc
    function sortString($string){
        $stringarr=str_split($string);
        $chararr=[];
        $intarr=[];
        $result=[];
        //separate letters and integers
        foreach ($stringarr as $i) {
            if ($i<='9' && $i>='0'){
                array_push($intarr,$i);
            }
            else{
                array_push($chararr,$i);
            }
        }
        //sort integers
        sort($intarr);
        //case insensitive sort letters 
        natcasesort($chararr);
        $chararr=array_values($chararr);
        //loop over sorted letters and place uppercase letters after lowercase letters of same type
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
        //merge letters and numbers arrays and then turn into a string
        $result=array_merge($chararr, $intarr);
        $string= implode($result);
        return response()->json([
            'status'=>'success',
            'result'=>$string
        ]);
    }
    //a function that recives a number and returns each place value in the number
    function placeValue($num){
        //check the sign of the number
        $negative=false;
        if ($num<0){
            $negative=true;
            $num=$num*(-1);
        }
        //split the number
        $numarr=str_split($num);
        //multiply each element according to its position in the number 
        for ($i=0;$i<count($numarr);$i++){
            $numarr[$i]=$numarr[$i]*(10**(count($numarr)-1-$i));
            if($negative){
                $numarr[$i]=$numarr[$i]*(-1);
            }
        }
        return response()->json([
            'status'=>'success',
            'result'=>$numarr
        ]);
    }
    //function that replaces the numbers in a string with their binary form
    function toBinary($str){
        $arr=str_split($str);
        $newstr='';
        $i=0;
        //loop over the array of characters in string
        while($i<count($arr)){
            $number='';
            //if its non numerical character append it to newstr
            if(!($arr[$i]<='9' && $arr[$i]>='0')){
                $newstr.=$arr[$i];
            }
            //otherwise loop over numerical characters, convert into binary, then append to newstr
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
            'status'=>'success',
            'result'=>$newstr
        ]);
    }
    //function that takes care of Prefix Notation Evaluation
    function calculate($exp){
        //split the equation by space
        $equationarr= (explode(" ",$exp));
        $calculate=[];
        //pop the last element of equationarray and push it into calculate array untill we reach an operand
        //when an oporand is reached pop the last 2 elements from calculate array, do the operation, then push again into the same array
        while(count($equationarr)>0){
            $x=array_pop($equationarr);
            if($x=='+'){
                $ans=intval(array_pop($calculate))+intval(array_pop($calculate));
                array_push($calculate,$ans);
            }
            else if($x=='-'){
                $ans=intval(array_pop($calculate))-intval(array_pop($calculate));
                array_push($calculate,$ans);
            }
            else if($x=='*'){
                $ans=intval(array_pop($calculate))*intval(array_pop($calculate));
                array_push($calculate,$ans);
            }
            else if($x=='÷'){
                $ans=intval(array_pop($calculate))/intval(array_pop($calculate));
                array_push($calculate,$ans);
            }
            else{
                array_push($calculate,$x);
            }  
        }
        return response()->json([
            'status'=>'success',
            'result'=>$calculate[0]
        ]);
    }
}
