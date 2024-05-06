<?php

namespace App\Helpers;

function date_convertion($tgl) {
    $tgb_obj = \DateTime::createFromFormat('d/m/Y H.i', $tgl);
        if ($tgb_obj !== false) {
            $tgb_mysql = $tgb_obj->format('Y-m-d H:i:s');
            return $tgb_obj;
        } else {
            // Penanganan kesalahan jika format tanggal tidak sesuai
            echo "Format tanggal tidak sesuai";
    }
}
