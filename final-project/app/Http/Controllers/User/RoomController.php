<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddRoomRequest;
use App\Interfaces\HomestayRepositoryInterface;
use App\Interfaces\RoomRepositoryInterface;
use App\Interfaces\TypeRoomRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Image;

class RoomController extends Controller
{
    private $homestayRepository;
    private $roomRepository;
    private $typeRoomRepository;

    public function __construct(HomestayRepositoryInterface $homestayRepository, RoomRepositoryInterface $roomRepository,TypeRoomRepositoryInterface $typeRoomRepository)
    {
        $this->homestayRepository = $homestayRepository;
        $this->roomRepository = $roomRepository;
        $this->typeRoomRepository = $typeRoomRepository;
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
                'room' => $this->roomRepository->getRoomById($homestayId),
                'typeRooms' => $this->typeRoomRepository->getAllTypeRooms()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddRoomRequest $request)
    {
        $nameImages = [];
        if ($request->hasFile('image')) {
            foreach ($request->image as $img) {
                $nameImages[] = $nameImage = strtotime(date('Y-m-d H:i:s')) . "_" . $img->getClientOriginalName();
                $img->storeAs('public/rooms', $nameImage);
            }
        }
        $request['images'] = json_encode($nameImages);
        $request['homestay_id'] = $request->homestayId;
        $request['type_room_id'] = $request->typeroom;
        $newDetails = $request->only(
            [
                'name',
                'images',
                'price',
                'description',
                'discount',
                'quantity_room',
                'homestay_id',
                'type_room_id',
            ]
        );
        $this->roomRepository->createRoom($newDetails);

        return back()->with('success', __('messages.create.success'));
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
