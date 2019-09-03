<?php

function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}


/**
 * 生成随机字符串
 * @param string $lenth 长度
 * @return string 字符串
 */
function create_randomstr($lenth = 6) {
    return random($lenth, '123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ');
}


/**
 * 对用户的密码进行加密
 * @param $password
 * @param $encrypt //传入加密串，在修改密码时做认证
 * @return array/password
 */
function password($password, $encrypt='') {
    $pwd = array();
    $pwd['encrypt'] =  $encrypt ? $encrypt : create_randomstr();
    $pwd['password'] = md5(md5(trim($password)).$pwd['encrypt']);
    return $encrypt ? $pwd['password'] : $pwd;
}


/**
* 产生随机字符串
*
* @param    int        $length  输出长度
* @param    string     $chars   可选的 ，默认为 0123456789
* @return   string     字符串
*/
function random($length, $chars = '0123456789') {
    $hash = '';
    $max = strlen($chars) - 1;
    for($i = 0; $i < $length; $i++) {
        $hash .= $chars[mt_rand(0, $max)];
    }
    return $hash;
}


// 客户端IP，
function getIp()
{
    if (getenv("HTTP_CLIENT_IP")) $ip = getenv("HTTP_CLIENT_IP"); else if (getenv("HTTP_X_FORWARDED_FOR")) $ip = getenv("HTTP_X_FORWARDED_FOR"); else if (getenv("REMOTE_ADDR")) $ip = getenv("REMOTE_ADDR"); else $ip = "Unknow";

    if (preg_match('/^((?:(?:25[0-5]|2[0-4]\d|((1\d{2})|([1-9]?\d)))\.){3}(?:25[0-5]|2[0-4]\d|((1\d{2})|([1 -9]?\d))))$/', $ip)) return $ip; else
        return '';
}

/**
 * 根据编号返回mp4_url地址,返回不带域名的后面一段。
 * 例： YS30-02-02，52-24-0001
 * mp4/52/52-24/52-24-0001.mp4
 */
function get_video_key($num, $type)
{
    if ($num) {
        $n = explode("-", $num);
        if (isset($n[0]) && isset($n[1])) {
            if (substr($num, 0, 2) == 'YS') {
                $a = str_replace('YS', '', $n[0]);
                if ($a) {
                    $item = 'YS' . '/' . $a . '/' . $num;
                } else {
                    $item = $n[0] . '/' . $n[0] . '-' . $n[1] . '/' . $num;
                }
            } else {
                $item = $n[0] . '/' . $n[0] . '-' . $n[1] . '/' . $num;
            }
            $mp4_key =  "/" . $item . "." . $type;
            return $mp4_key;
        }else{
            return '';
        }
    } else {
        return '';
    }
}


function get_video_url($domain, $key)
{
    return $domain.$key;
}

function get_radio_key($num, $type)
{
    return get_video_key($num, $type);
}

function get_radio_url($domain, $key)
{
    return get_video_url($domain, $key);
}

/**
 * 返回可读性更好的文件尺寸
 */
function human_filesize($bytes, $decimals = 2)
{
    $size = ['B', 'kB', 'MB', 'GB', 'TB', 'PB'];
    $factor = floor((strlen($bytes) - 1) / 3);

    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) .@$size[$factor];
}

/**
 * 判断文件的MIME类型是否为图片
 */
function is_image($mimeType)
{
    return starts_with($mimeType, 'image/');
}

