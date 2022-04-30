<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
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

    public function __construct(HomestayRepositoryInterface $homestayRepository, RoomRepositoryInterface $roomRepository, TypeRoomRepositoryInterface $typeRoomRepository)
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
        $newImages = [];
        if ($request->hasFile('image')) {
            foreach ($request->image as $img) {
                $newImages[] = $nameImage = strtotime(date('Y-m-d H:i:s')) . "_" . $img->getClientOriginalName();
                $img->storeAs('public/rooms', $nameImage);
            }
        }
        $request['images'] = json_encode($newImages);
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
        $result = $this->roomRepository->createRoom($newDetails);
        if (!empty($result)) {
            return back()->with('success', __('messages.create.success'));
        }

        return back()->with('error', __('messages.create.fail'))->withInput();
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
                'room' => $room,
                'typeRooms' => $this->typeRoomRepository->getAllTypeRooms()
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
    public function update(UpdateRoomRequest $request, $id)
    {
        $oldRoom = $this->roomRepository->getRoomById($id);
        $oldImages =  json_decode($oldRoom->images);
        $totalImage = count($oldImages);
        $newImages = [];
        if (!empty($request->imageDelete)) {
            $totalImage -= count($request->imageDelete);
        } else {
            $request->imageDelete = [''];
        }
        if ($request->hasFile('imageNew')) {
            $totalImage += count($request->imageNew);
        }
        if ($totalImage <= config('const.imageRoom.max') && $totalImage >= config('const.imageRoom.min')) {
            $oldImages = array_diff($oldImages, $request->imageDelete);
            foreach ($request->imageDelete as $item) {
                Storage::delete('/public/rooms/' . $item);
            }
            if ($request->hasFile('imageNew')) {
                foreach ($request->imageNew as $img) {
                    $newImages[] = $nameImage = strtotime(date('Y-m-d H:i:s')) . "_" . $img->getClientOriginalName();
                    $img->storeAs('public/rooms', $nameImage);
                }
            }
            $request['images'] = json_encode(array_merge($newImages, $oldImages));
            $request['homestay_id'] = $oldRoom->homestay_id;
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
            $this->roomRepository->updateRoom($id, $newDetails);

            return back()->with('success', __('messages.update.success'));
        }

        return back()->with('error', __('messages.update.fail'))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $room = $this->roomRepository->getRoomById($id);
        $imageDelete = json_decode($room->images);
        $result = $this->roomRepository->deleteRoom($id);
        if (!empty($result)) {
            foreach ($imageDelete as $item) {
                Storage::delete('/public/rooms/' . $item);
            }

            return back()->with('success', __('messages.delete.success'));
        }

        return back()->with('error', __('messages.delete.fail'));
    }
}
