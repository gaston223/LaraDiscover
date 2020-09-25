<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Bookable extends Model
{

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function review()
    {
        return $this->hasMany(Review::class);
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

    //Recupérer la moyenne globale d'un bookable
    public function getAverageRatingAttribute()
    {
        $totalReview = $this->review()->count();
        $sumReview = $this->review()->sum('rating');

        if ($totalReview > 0) return $sumReview/ $totalReview;
        return 0;


    }

    public function getSumReviewAttribute()
    {
        return $this->review()->count();
    }

    public function priceFor($from, $to) :array
    {
        $days = (new Carbon($from))->diffInDays(new Carbon ($to)) + 1;
        $price = $days * $this->price;

        return [
            'total' => $price,
            'breakdown' => [
                $this->price => $days
            ]
        ];
    }

}
