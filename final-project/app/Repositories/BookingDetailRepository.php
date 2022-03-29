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
     * get all BookingDetails
     *
     * @return void
     */
    public function getAllBookingDetailsByIdUser()
    {
        return BookingDetail::where("user_id", Auth::id())->get();
    }

    /**
     * create BookingDetail 
     *
     * @param array
     * @return mixed
     */
    public function createBookingDetail(array $attributes)
    { 
        return BookingDetail::create($attributes);
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
     * Update BookingDetail 
     *
     * @return mixed
     */
    public function updateBookingDetail($id, array $attributes)
    {
        return BookingDetail::whereId($id)->update($attributes);
    }

    /**
     * delete BookingDetail by id 
     *
     * @param int
     */
    public function deleteBookingDetail($homestayId)
    {
    }
}
