<?php

function ResponseTemplate($data, $kode, $message){

    return [

        'data'    => $data,
        
        'status'  => $kode,
        
        'message' => $message

    ];

}

