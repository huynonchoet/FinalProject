<?php

namespace App\Repositories;

use App\Interfaces\BookingDetailRepositoryInterface;
use App\Models\BookingDetail;
use Illuminate\Support\Facades\Auth;


class BookingDetailRepository implements BookingDetailRepositoryInterface
{
    /**
     * get all BookingDetails
     *
     * @return void
     */
    public function getAllBookingDetails()
    {
        return BookingDetail::all();
    }

    /**
     * Get BookingDetail by id 
     *
     * @param int
     */
    public function getBookingDetailById($BookingDetailId)
    {
        return BookingDetail::findOrFail($BookingDetailId);
    }

    /**
     * Get BookingDetail by id booking
     *
     * @param int
     */
    public function getBookingDetailByIdBooking($bookingId)
    {
        return BookingDetail::where('booking_id', $bookingId)->get();
    }

    /**
     * Get BookingDetail by id room
     *
     * @param int
     */
    public function getBookingDetailByIdRoom($roomId)
    {
        return BookingDetail::where('room_id', $roomId)->get();
    }
}
