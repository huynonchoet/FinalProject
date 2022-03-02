<?php

namespace App\Repositories;

use App\Interfaces\HomestayRepositoryInterface;
use App\Models\Homestay;
use Illuminate\Support\Facades\DB;

class HomestayRepository implements HomestayRepositoryInterface
{
    /**
     * get all Homestays
     *
     * @return void
     */
    public function getAllHomestays()
    {
        return Homestay::all();
    }

    /**
     * create Homestay 
     *
     * @param array
     * @return mixed
     */
    public function createHomestay(array $attributes)
    {
        return Homestay::create($attributes);
    }

    /**
     * Get Homestay by id 
     *
     * @param int
     */
    public function getHomestayById($homestayId)
    {
        return Homestay::findOrFail($homestayId);
    }

    /**
     * Update Homestay 
     *
     * @return mixed
     */
    public function updateHomestay($id, array $attributes)
    {
        return Homestay::whereId($id)->update($attributes);
    }

    /**
     * delete Homestay by id 
     *
     * @param int
     */
    public function deleteHomestay($homestayId)
    {
        $homestay = $this->getHomestayById($homestayId);
        $result = DB::transaction(function () use ($homestay) {
            $homestay->products()->delete();

            return $homestay->delete();
        });

        return $result;
    }
}
