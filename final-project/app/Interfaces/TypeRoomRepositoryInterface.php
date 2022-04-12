<?php

namespace App\Interfaces;

interface TypeRoomRepositoryInterface
{
    public function getAllTypeRooms();
    public function getTypeRoomById($typeroomId);
    public function updateTypeRoom($typeroomId, array $newDetails);
    public function deleteTypeRoom($typeroomId);
    public function createTypeRoom(array $attributes);
}
