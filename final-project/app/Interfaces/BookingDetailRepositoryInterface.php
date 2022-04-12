<?php

namespace App\Interfaces;

interface BookingDetailRepositoryInterface
{
    public function getAllBookingDetails();
    public function getBookingDetailById($bookingDetailId);
    public function getBookingDetailByIdBooking($bookingId);
    public function getBookingDetailByIdRoom($roomId);
}
