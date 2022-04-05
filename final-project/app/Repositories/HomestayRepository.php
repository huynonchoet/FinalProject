<?php

namespace App\Repositories;

use App\Interfaces\HomestayRepositoryInterface;
use App\Models\Homestay;
use Illuminate\Support\Facades\Auth;
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
     * get all Homestays
     *
     * @return void
     */
    public function getAllHomestaysByIdUser()
    {
        return Homestay::where("user_id", Auth::id())->get();
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
            $homestay->rooms()->delete();
            $homestay->comments()->delete();
            $homestay->rates()->delete();

            return $homestay->delete();
        });

        return $result;
    }

    /**
     *search
     *
     * @param int
     */
    public function searchHomestays()
    {
        $homestay = Homestay::query();
        $homestay->when(request('search'), function ($query) {
            $search = trim(request('search'));
            return $query->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('address', 'LIKE', '%' . $search . '%');
        });
        return $homestay->simplePaginate(9);
    }
}
