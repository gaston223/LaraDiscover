<?php

namespace App\Http\Controllers\Api;

use App\Address;
use App\Bookable;
use App\Booking;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return \Illuminate\Support\Collection
     */
    public function __invoke(Request $request)
    {
        $data = $request->validate([
           'bookings' => 'required|array|min:1',
           'bookings.*.bookable_id' => 'required|exists:bookables,id',
           'bookings.*.from' => 'required|date|after_or_equal:today',
           'bookings.*.to' => 'required|date|after_or_equal:bookings.*.from',
           'bookings.*.user_id' => 'required',
           'customer.first_name' => 'required|min:2',
           'customer.last_name' => 'required|min:2',
           'customer.street' => 'required|min:3',
           'customer.city' => 'required|min:2',
           'customer.email' => 'required|email',
           'customer.zip' => 'required|min:2'
        ]);

        $data = array_merge($data, $request->validate([
            'bookings.*' => ['required', function($attribute, $value, $fail){
                $bookable = Bookable::findorFail($value['bookable_id']);

                if(!$bookable->availableFor($value['from'], $value['to'])){
                    $fail("The object is not available in given dates !");
                }
            }],
        ])) ;

        $bookingsData = $data['bookings'];
        $adressData = $data['customer'];

        $bookings = collect($bookingsData)->map(function ($bookingData) use($adressData){
            //
            $bookable = Bookable::findOrFail($bookingData['bookable_id']);
            $booking = new Booking();
            $booking->from = $bookingData['from'];
            $booking->to = $bookingData['to'];
            $booking->user_id = $bookingData['user_id'];
            $booking->price = $bookable->priceFor($booking->from, $booking->to)['total'];
            $booking->bookable()->associate($bookable);

            $booking->address()->associate(Address::create($adressData));

            $booking->save();

            return $booking;
        });

        return $bookings;
    }
}
