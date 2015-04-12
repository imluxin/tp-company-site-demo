<?php

/**
 * 生成GUID
 * @return string
 */
function create_guid()
{
    mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
    $charid = strtoupper(md5(uniqid(rand(), true)));
//         $hyphen = chr(45);// "-"real_name_verify
    $uuid = substr($charid, 0, 8)
            .substr($charid, 8, 4)
            .substr($charid,12, 4)
            .substr($charid,16, 4)
            .substr($charid,20,12);
    return $uuid;
}

function ylx_str_replace_textarea($text, $replace = '</p><p>')
{
    $search = array("\r\n", "\n", "\r");
    echo str_replace($search, $replace, $text);
}

function ylx_mb_substr($str, $length, $replace = '...')
{
    if(mb_strlen($str, 'UTF-8') > $length){
        return mb_substr($str, 0, $length, 'UTF-8').$replace;
    }
    return $str;
}
