<?php

function randomString($len)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $ret = '';
    for ($i = 0; $i < $len; ++$i) {
        $ret .= $characters[rand(0, $charactersLength - 1)];
    }
    return $ret;
}
