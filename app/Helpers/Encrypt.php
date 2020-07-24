<?php
namespace App\Helpers;

class Currency {
    public static function Encryption() {
        $plain_text .= "\x13";
        $n = strlen($plain_text);
        if ($n % 16) $plain_text .= str_repeat("\0", 16 - ($n % 16));
            $i = 0;
            $enc_text = get_rnd_iv($iv_len);
            $iv = substr($password ^ $enc_text, 0, 512);
            while ($i < $n) {
            $block = substr($plain_text, $i, 16) ^ pack('H*', md5($iv));
            $enc_text .= $block;
            $iv = substr($block . $iv, 0, 512) ^ $password;
            $i += 16;
        }
        $hasil=base64_encode($enc_text);
        return str_replace('+', '@', $hasil);
    }
}