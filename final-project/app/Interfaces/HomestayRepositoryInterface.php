<?php

namespace App\Interfaces;

interface HomestayRepositoryInterface
{
    public function getAllHomestays();
    public function getAllHomestaysByIdUser();
    public function getHomestayById($homestayId);
    public function updateHomestay($homestayId, array $newDetails);
    public function deleteHomestay($homestayId);
    public function createHomestay(array $attributes);
}
