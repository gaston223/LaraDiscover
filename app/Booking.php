<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['from', 'to'];

    public function bookable()
    {
        return $this->belongsTo(Bookable::class);
    }

    /**
     * @param Builder $query
     * @param $from
     * @param $to
     * @return Builder
     */
    public function scopeBetweenDates(Builder $query, $from, $to )
    {
        return $query->where('to', '>=', $from)
            ->where('from', '<=', $to);
    }
}
