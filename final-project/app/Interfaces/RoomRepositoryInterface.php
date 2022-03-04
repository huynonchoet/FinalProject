<?php

namespace App\Interfaces;

interface RoomRepositoryInterface
{
    public function getAllRooms();
    public function getAllRoomsByIdHomestay($homestayId);
    public function getRoomById($roomId);
    public function updateRoom($roomId, array $newDetails);
    public function deleteRoom($roomId);
    public function createRoom(array $attributes);
}
