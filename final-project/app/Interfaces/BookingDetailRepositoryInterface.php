<?php

namespace App\Interfaces;

interface BookingDetailRepositoryInterface
{
    public function getAllBookingDetails();
    public function getAllBookingDetailsByIdUser();
    public function getBookingDetailById($bookingDetailId);
    public function updateBookingDetail($bookingDetailId, array $newDetails);
    public function deleteBookingDetail($bookingDetailId);
    public function createBookingDetail(array $attributes);
}
