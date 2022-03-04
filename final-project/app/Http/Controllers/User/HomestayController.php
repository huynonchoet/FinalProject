<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Interfaces\HomestayRepositoryInterface;
use App\Interfaces\RoomRepositoryInterface;
use Illuminate\Http\Request;

class HomestayController extends Controller
{
    private $homestayRepository;
    private $roomRepository;

    public function __construct(HomestayRepositoryInterface $homestayRepository, RoomRepositoryInterface $roomRepository)
    {
        $this->homestayRepository = $homestayRepository;
        $this->roomRepository = $roomRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(
            'user.homestay.index',
            [
                'homestay' => $this->homestayRepository->getAllHomestaysByIdUser()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        return view(
            'user.room.index',
            [
                'rooms' => $this->roomRepository->getAllRoomsByIdHomestay($id),
                'homestay' => $this->homestayRepository->getHomestayById($id)
            ]
        );
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
