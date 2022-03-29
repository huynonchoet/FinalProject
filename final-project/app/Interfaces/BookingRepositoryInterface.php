<?php

namespace App\Interfaces;

interface BookingRepositoryInterface
{
    public function getAllBookings();
    public function getAllBookingsByIdUserLandLord();
    public function getBookingById($bookingId);
    public function updateBooking($bookingId, array $news);
    public function deleteBooking($bookingId);
    public function createBooking(array $attributes);
}
