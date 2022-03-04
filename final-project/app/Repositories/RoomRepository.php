<?php

namespace App\Repositories;

use App\Interfaces\RoomRepositoryInterface;
use App\Models\Room;
use Illuminate\Support\Facades\DB;

class RoomRepository implements RoomRepositoryInterface
{
    /**
     * get all Rooms
     *
     * @return void
     */
    public function getAllRooms()
    {
        return Room::all();
    }

    /**
     * get all Rooms
     *
     * @return void
     */
    public function getAllRoomsByIdHomestay($homestayId)
    {
        return Room::where("homestay_id", $homestayId)->get();
    }

    /**
     * create Room 
     *
     * @param array
     * @return mixed
     */
    public function createRoom(array $attributes)
    { 
        return Room::create($attributes);
    }

    /**
     * Get Room by id 
     *
     * @param int
     */
    public function getRoomById($roomId)
    {
        return Room::findOrFail($roomId);
    }

    /**
     * Update Room 
     *
     * @return mixed
     */
    public function updateRoom($id, array $attributes)
    {
        return Room::whereId($id)->update($attributes);
    }

    /**
     * delete Room by id 
     *
     * @param int
     */
    public function deleteRoom($roomId)
    {
        $room = $this->getRoomById($roomId);
        $result = DB::transaction(function () use ($room) {
            $room->products()->delete();

            return $room->delete();
        });

        return $result;
    }
}
