<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookable extends Model
{

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Fonction qui retourne un booleen si le bookable est disponible ou pas
     * @param $from
     * @param $to
     * @return bool
     */
    public function availableFor($from, $to)
    {
        return 0 === $this->bookings()->betweenDates($from, $to)->count();
    }
}
