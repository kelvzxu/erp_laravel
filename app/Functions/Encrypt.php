<?php
namespace App\Functions;

class Encrypt {
    public static function get_rnd_iv($iv_len){
        $iv = '';
        while ($iv_len-- > 0) {
        $iv .= chr(mt_rand() & 0xff);
        }
        return $iv;
    }

    public static function Encryption($plain_text, $iv_len = 16) {
        $password = "ZW50ZXJwcmlzZXN5c3RlbQ==";
        $plain_text .= "\x13";
        $n = strlen($plain_text);
        if ($n % 16) $plain_text .= str_repeat("\0", 16 - ($n % 16));
        $i = 0;
        $enc_text = Encrypt::get_rnd_iv($iv_len);
        $iv = substr($password ^ $enc_text, 0, 512);
        while ($i < $n) {
            $block = substr($plain_text, $i, 16) ^ pack('H*', md5($iv));
            $enc_text .= $block;
            $iv = substr($block . $iv, 0, 512) ^ $password;
            $i += 16;
        }
        $hasil=base64_encode($enc_text);
        return str_replace('/', '@', $hasil);
    }

    public static function Decryption($enc_text, $iv_len = 16)
    {
        $password = "ZW50ZXJwcmlzZXN5c3RlbQ==";
        $enc_text = str_replace('@', '/', $enc_text);
        $enc_text = base64_decode($enc_text);
        $n = strlen($enc_text);
        $i = $iv_len;
        $plain_text = '';
        $iv = substr($password ^ substr($enc_text, 0, $iv_len), 0, 512);
        while ($i < $n) {
        $block = substr($enc_text, $i, 16);
        $plain_text .= $block ^ pack('H*', md5($iv));
        $iv = substr($block . $iv, 0, 512) ^ $password;
        $i += 16;
        }
        return preg_replace('/\\x13\\x00*$/', '', $plain_text);
    }
}
