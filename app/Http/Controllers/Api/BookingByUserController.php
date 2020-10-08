<?php

namespace App\Http\Controllers\Api;

use App\Booking;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookingByUserResource;
use Illuminate\Http\Request;

class BookingByUserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke($id)
    {
        //$bookings = DB::table('bookings')->where('user_id',$id)->get();

        $bookings = Booking::where('user_id',$id)->get();
        return BookingByUserResource::collection($bookings);

    }
}
