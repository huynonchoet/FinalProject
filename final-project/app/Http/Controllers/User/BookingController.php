<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Interfaces\HomestayRepositoryInterface;
use App\Interfaces\RoomRepositoryInterface;
use App\Interfaces\TypeRoomRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    private $homestayRepository;
    private $roomRepository;
    private $typeRoomRepository;
    private $userRepository;


    public function __construct(HomestayRepositoryInterface $homestayRepository, RoomRepositoryInterface $roomRepository, TypeRoomRepositoryInterface $typeRoomRepository, UserRepositoryInterface $userRepository)
    {
        $this->homestayRepository = $homestayRepository;
        $this->roomRepository = $roomRepository;
        $this->typeRoomRepository = $typeRoomRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($homestayId)
    {
        $homestay = $this->homestayRepository->getHomestayById($homestayId);
        $rooms = $this->roomRepository->getAllRoomsByIdHomestay($homestayId);

        return view('user.booking.index',['homestay'=>$homestay,'rooms'=>$rooms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function roomDetail($roomId)
    {
        $room = $this->roomRepository->getRoomById($roomId);
        $homestay=$this->homestayRepository->getHomestayById($room->homestay_id);
        $user=$this->userRepository->getUserById($homestay->user_id);

        return view('user.booking.room-detail',['room'=>$room,'user'=>$user,'homestay'=>$homestay]);
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
        //
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
