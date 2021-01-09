<?php
namespace App\Helper;

class Helper
{

    // check pdf
    public static  function check_file($value)
    {
        return True;
    }


    // File Upload Setting
    public static $file_upload_setting = '1';


    // PDF Page Counter
    public static function count_pages($pdfname) {

        $pdftext = file_get_contents($pdfname);
        $num = preg_match_all("/\/Page\W/", $pdftext, $dummy);

        return $num;
    }

}
