<?php

function responseJson($status,$message,$data=null){
    $response=[
        'status'=>$status,
        'message'=>$message,
        'data'=>$data
    ];
    return response()->json($response);

}
function getUrl($route,$needle)
{
    $route=explode('/',$route);
    return in_array($needle,$route);
}