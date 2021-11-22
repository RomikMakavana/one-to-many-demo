<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Utils extends Model
{
    public static function getQueryGroupConcat($keyValues, $distinct = false){
        $groupConcat = ["'{'"];
        $vals = [];
        foreach ($keyValues as $key => $value) {
            $k = (string)Str::of('\'"?": \'')->replaceArray('?', [$key]);
            $v = (string)Str::of("JSON_QUOTE(IFNULL(?,''))")->replaceArray('?', [$value]);
            $vals[] = $k . "," . $v;
        }
        $vals = implode(",',',", $vals);
        $groupConcat[] = $vals;
        $groupConcat[] = "'}'";
        if($distinct == true){
            $query = "CONCAT( '[', GROUP_CONCAT( DISTINCT CONCAT(". implode(',', $groupConcat ) .") SEPARATOR ',')  ,']' )";        
        }else{
            $query = "CONCAT( '[', GROUP_CONCAT( CONCAT(". implode(',', $groupConcat ) .") SEPARATOR ',')  ,']' )";        
        }
        return $query;
    }    
}
