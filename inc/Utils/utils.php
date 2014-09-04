<?php
/**
 * utils.php
 *
 * @author Koen Hendriks <info@koenhendriks.com>
 * @version 1.0 - Created on 6/5/14
 * @copyright 2014 Koen Hendriks
 */

class utils {

    /**
     * I love this hack <3
     *
     * @param $var
     * @return string
     */
    static function dump($var,$exit = 0){
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
        if($exit){
            exit();
        }
    }

    /**
     * Create spaces from html tag
     *
     * @param $data
     * @return mixed
     */
    static function spacer($data){
        $find = '&nbsp;';
        $replace = ' ';
        $data = str_replace($find, $replace, $data);
        return $data;

    }

    /**
     * Create error and kill the page
     *
     * @param $str1
     * @param $str2
     */
    static function error($str1, $str2) {
        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
        die('ERROR: '.$str1.' '.$str2);
    }

    /**
     * Removes html and characters that may cause problems.
     *
     * @param $data
     * @return mixed
     */
    static function xssCheck($data){
        $find = array(
            "'","`","©","ª","«",
            "®","°","±","¹","²","³","¼","½","¾","€",
            "á","à","ä","â","ã","æ","Æ","å",
            "Á","À","Ä","Â","Ã","Å",
            "ç","Ç",
            "Ð",
            "é","è","ë","ê",
            "É","È","Ë","Ê",
            "í","ì","ï","î",
            "Í","Ì","Î","Ï",
            "ñ","Ñ",
            "ó","ò","ö","ô","õ","ø",
            "Ó","Ò","Ö","Ô","Õ","Ø",
            "ß",
            "ú","ù","ü","û",
            "Ú","Ù","Ü","Û",
            "ý","ÿ","Ý","Ÿ",
            "<",">",
        );

        $replace = array(
            "&lsquo;","&acute;","&copy;","&ordf;","&laquo;",
            "&reg;","deg;","&plusmn;","&sup1;","&sup2;","&sup3;","&frac14;","&frac12;","&frac34;","&euro",
            "&aacute;","&agrave;","&auml;","&acirc;","&atilde;","&aelig;","&AElig;","&aring;",
            "&Aacute;","&Agrave;","&Auml;","&Acirc;","&Atilde;","&Aring;",
            "&ccedil;","&Ccedil;",
            "&ETH;",
            "&eacute;","&egrave;","&euml;","&ecirc;",
            "&Eacute;","&Egrave;","&Ecirc;","&Euml;",
            "&iacute;","&igrave;","&iuml;","&icirc;",
            "&Iacute;","&Igrave;","&Icirc;","&Iuml;",
            "&ntilde;","&Ntilde;",
            "&oacute;","&ograve;","&ouml;","&ocirc;","&otilde;","&oslash;",
            "&Oacute;","&Ograve;","&Ouml;","&Ocirc;","&Otilde;","&Oslash;",
            "&szlig;",
            "&uacute;","&ugrave;","&uuml;","&ucirc;",
            "&Uacute;","&Ugrave;","&Uuml;","&Ucirc;",
            "&yacute;","&yuml;;","&Yacute;","&Yuml;",
            "&lt;","&gt;"
        );

        $data = str_replace($find, $replace, $data);
        return $data;
    }

} 