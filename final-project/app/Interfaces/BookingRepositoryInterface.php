<?php

namespace App\Interfaces;

interface BookingRepositoryInterface
{
    public function getAllBookings();
    public function getAllBookingsByIdUserLandLord($status);
    public function getBookingById($bookingId);
    public function getBookingByIdUser($userId);
    public function updateBooking($bookingId, array $news);
    public function deleteBooking($bookingId);
    public function createBooking(array $attributes);
}
