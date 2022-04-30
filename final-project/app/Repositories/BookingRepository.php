<?php

namespace App\Repositories;

use App\Interfaces\BookingRepositoryInterface;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingRepository implements BookingRepositoryInterface
{
    /**
     * get all Bookings
     *
     * @return void
     */
    public function getAllBookings()
    {
        return Booking::all();
    }

    /**
     * get all Bookings
     *
     * @return void
     */
    public function getAllBookingsByIdUserLandLord($request)
    {
        return Booking::select(
            'bookings.user_id',
            'bookings.id',
            'bookings.day_start',
            'bookings.day_end',
            'bookings.status',
            'users.name',
            DB::raw('SUM(booking_details.price) as total_price')
        )
            ->leftJoin('booking_details', 'booking_id', 'bookings.id')
            ->leftJoin('rooms', 'rooms.id', 'booking_details.room_id')
            ->leftJoin('homestays', 'homestays.id', 'rooms.homestay_id')
            ->join('users', 'users.id', 'bookings.user_id')
            ->where('homestays.user_id', Auth::id())
            ->where('bookings.status', (string)$request->status)
            ->whereBetween('day_start', [$request->start_day, $request->end_day])
            ->distinct()
            ->orderBy('day_start', 'asc')
            ->groupBy(
                'bookings.user_id',
                'bookings.id',
                'bookings.day_start',
                'bookings.day_end',
                'bookings.status',
                'users.name'
            )
            ->get();
    }

    /**
     * create Booking 
     *
     * @param array
     * @return mixed
     */
    public function createBooking(array $attributes)
    {
        return Booking::create($attributes);
    }

    /**
     * Get Booking by id 
     *
     * @param int
     */
    public function getBookingById($bookingId)
    {
        return Booking::findOrFail($bookingId);
    }

    /**
     * Update Booking 
     *
     * @return mixed
     */
    public function updateBooking($id, array $attributes)
    {
        return Booking::whereId($id)->update($attributes);
    }

    /**
     * delete Booking by id 
     *
     * @param int
     */
    public function deleteBooking($homestayId)
    {
    }

    /**
     * delete Booking by id 
     *
     * @param int
     */
    public function getBookingByIdUser($userId)
    {
        return Booking::where('user_id', $userId)->get();
    }
}
