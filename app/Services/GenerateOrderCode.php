<?php

namespace App\Services;

use App\Database\Migrations\Reservation;
use App\Models\ReservationModel;
use App\Models\CheckinModel;

class GenerateOrderCode
{
    public static function generateOrderId()
    {
        $model = new ReservationModel();
        $kodeOrder = $model->generateNewKodeOrder();

        return $kodeOrder;
    }

    protected static function isDuplicateId($idReservasi)
    {
        $reservasiModel = new ReservationModel();
        $reservasi = $reservasiModel->where('kode_order', $idReservasi)->first();

        $checkinModel = new CheckinModel();
        $checkin = $checkinModel->where('kode_order', $idReservasi)->first();

        if ($reservasi || $checkin) {
            return true;
        } else {
            return false;
        }
    }
}
