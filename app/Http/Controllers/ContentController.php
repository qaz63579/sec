<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContentController extends Controller
{
    //
    public function index()
    {
        
        $data = file_get_contents('http://www.tjflcpw.com/report/ssc_jiben_report.aspx?term_num=100');
        preg_match_all('/["][0-9\W]{29}["]/', $data, $output_array);

        $str = $output_array[0]; // $str[0] 格式為:"20190823009", "02|05|01|07|09"
/*       
        $str2 = preg_replace('/[2][0-9]{7}/', '$0-', $str[0]); // str2 = "20190823-009", "02|05|01|07|09"
        preg_match('/[2][0-9\W]{11}/', $str2, $str3); // $str3[0] = "20190823-008"
        preg_match('/([0-9]{2}[|]){4}[0-9]{2}/', $str2, $str4); // $str4[0] = "02|05|01|07|09"
        $str4[0]=str_replace("|",",",$str4[0]);

        $data_arr = array($str3[0]=>$str4[0]);
*/


        for($i=0 ; $i<sizeof($str) ; $i++ )
        {
            $str2 = preg_replace('/[2][0-9]{7}/', '$0-', $str[$i]); // str2 = "20190823-009", "02|05|01|07|09"
            preg_match('/[2][0-9\W]{11}/', $str2, $str3); // $str3[0] = "20190823-008"
            preg_match('/([0-9]{2}[|]){4}[0-9]{2}/', $str2, $str4); // $str4[0] = "02|05|01|07|09"
            $str4[0]=str_replace("|",",",$str4[0]);
    

            $data_arr[$str3[0]]=$str4[0];

        }


        return $data_arr;
    }
}
