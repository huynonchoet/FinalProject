<?php

namespace App\Repositories;

use App\Interfaces\TypeRoomRepositoryInterface;
use App\Models\TypeRoom;
use Illuminate\Support\Facades\DB;

class TypeRoomRepository implements TypeRoomRepositoryInterface
{
    /**
     * get all TypeRooms
     *
     * @return void
     */
    public function getAllTypeRooms()
    {
        return TypeRoom::all();
    }

    /**
     * create TypeRoom 
     *
     * @param array
     * @return mixed
     */
    public function createTypeRoom(array $attributes)
    { 
        return TypeRoom::create($attributes);
    }

    /**
     * Get TypeRoom by id 
     *
     * @param int
     */
    public function getTypeRoomById($typeRoomId)
    {
        return TypeRoom::findOrFail($typeRoomId);
    }

    /**
     * Update TypeRoom 
     *
     * @return mixed
     */
    public function updateTypeRoom($id, array $attributes)
    {
        return TypeRoom::whereId($id)->update($attributes);
    }

    /**
     * delete TypeRoom by id 
     *
     * @param int
     */
    public function deleteTypeRoom($typeRoomId)
    {
        $typeRoom = $this->getTypeRoomById($typeRoomId);
        $result = DB::transaction(function () use ($typeRoom) {
            $typeRoom->products()->delete();

            return $typeRoom->delete();
        });

        return $result;
    }
}
