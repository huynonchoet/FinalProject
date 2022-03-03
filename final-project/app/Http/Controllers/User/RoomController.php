<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Interfaces\HomestayRepositoryInterface;
use App\Interfaces\RoomRepositoryInterface;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    private $homestayRepository;
    private $roomRepository;

    public function __construct(HomestayRepositoryInterface $homestayRepository, RoomRepositoryInterface $roomRepository)
    {
        $this->homestayRepository = $homestayRepository;
        $this->roomRepository = $roomRepository;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(int $homestayId)
    {
        return view(
            'user.room.add',
            [
                'homestay' => $this->homestayRepository->getHomestayById($homestayId),
                'homestays' => $this->homestayRepository->getAllHomestaysByIdUser(),
                'room' => $this->roomRepository->getRoomById($homestayId)
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $room = $this->roomRepository->getRoomById($id);
        return view(
            'user.room.edit',
            [
                'homestay' => $this->homestayRepository->getHomestayById($room->homestay_id),
                'room' => $room
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
