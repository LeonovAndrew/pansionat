<?php


function CurlBitrix24($method, $arData = array())
{
    $queryUrl = "https://pansionaty.bitrix24.ru/rest/1/yim02go3gtoi72s8/" . $method;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $queryUrl,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_POST => 1,
        CURLOPT_HEADER => 0,
        CURLOPT_RETURNTRANSFER => 1,
    ));
    if (!empty($arData)) {
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($arData));
    }
    $result = curl_exec($curl);
    curl_close($curl);
    return json_decode($result, true);
}

function CurlBitrix24Contact($method, $arData = array())
{
    $queryUrl = "https://pansionaty.bitrix24.ru/rest/1/1uhuyg275s6nqym0/" . $method;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $queryUrl,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_POST => 1,
        CURLOPT_HEADER => 0,
        CURLOPT_RETURNTRANSFER => 1,
    ));
    if (!empty($arData)) {
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($arData));
    }
    $result = curl_exec($curl);
    curl_close($curl);
    return json_decode($result, true);
}