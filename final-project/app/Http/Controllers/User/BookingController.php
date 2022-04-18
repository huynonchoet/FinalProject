<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Interfaces\BookingDetailRepositoryInterface;
use App\Interfaces\BookingRepositoryInterface;
use App\Interfaces\HomestayRepositoryInterface;
use App\Interfaces\RoomRepositoryInterface;
use App\Interfaces\TypeRoomRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Booking;
use App\Models\BookingDetail;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Requests\CheckroomRequest;

class BookingController extends Controller
{
    private $homestayRepository;
    private $roomRepository;
    private $typeRoomRepository;
    private $userRepository;
    private $bookingRepository;
    private $bookingDetailRepository;


    public function __construct(
        HomestayRepositoryInterface $homestayRepository,
        RoomRepositoryInterface $roomRepository,
        TypeRoomRepositoryInterface $typeRoomRepository,
        UserRepositoryInterface $userRepository,
        BookingRepositoryInterface $bookingRepository,
        BookingDetailRepositoryInterface $bookingDetailRepository
    ) {
        $this->homestayRepository = $homestayRepository;
        $this->roomRepository = $roomRepository;
        $this->typeRoomRepository = $typeRoomRepository;
        $this->userRepository = $userRepository;
        $this->bookingRepository = $bookingRepository;
        $this->bookingDetailRepository = $bookingDetailRepository;
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

        return view('user.booking.index', ['homestay' => $homestay, 'rooms' => $rooms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function roomDetail($roomId)
    {
        $room = $this->roomRepository->getRoomById($roomId);
        $homestay = $this->homestayRepository->getHomestayById($room->homestay_id);
        $user = $this->userRepository->getUserById($homestay->user_id);

        return view('user.booking.room-detail', [
            'room' => $room,
            'user' => $user,
            'homestay' => $homestay
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function check(CheckroomRequest $request, $roomId)
    {
        $begin = date('Y-m-d', strtotime($request->fromDate));
        $end =  date('Y-m-d', strtotime(Carbon::parse($request->toDate)->add("+1 days")));
        $datetime1 = strtotime($begin); // convert to timestamps
        $datetime2 = strtotime($end); // convert to timestamps
        $days = (int)(($datetime2 - $datetime1 - 1) / 86400);
        $period1 = new DatePeriod(
            new DateTime($begin),
            new DateInterval('P1D'),
            new DateTime($end)
        );
        $days_book1 = [];
        foreach ($period1 as $date) {
            $days_book1[] = $date->format("Y-m-d");
        }
        $bookingDetails = $this->bookingDetailRepository->getBookingDetailByIdRoom($roomId);
        $quantityRoom = $this->roomRepository->getRoomById($roomId)->quantity_room;
        $check_qty = array();
        foreach ($days_book1 as $day_book1) {
            $array = array($day_book1 => $quantityRoom);
            $check_qty = array_merge($check_qty, $array);
        }
        foreach ($bookingDetails as $bookingDetail) {
            $bookingId = $bookingDetail->booking_id;
            $booking = $this->bookingRepository->getBookingById($bookingId);
            $day_start = date('Y-m-d', strtotime($booking->day_start));
            $day_end = date('Y-m-d', strtotime(Carbon::parse($booking->day_end)->add("+1 days")));
            $period2 = new DatePeriod(
                new DateTime($day_start),
                new DateInterval('P1D'),
                new DateTime($day_end)
            );
            $days_book2 = [];
            foreach ($period2 as $date) {
                $days_book2[] = $date->format("Y-m-d");
            }
            foreach ($days_book2 as $day_book2) {
                if (in_array($day_book2, $days_book1)) {
                    foreach ($check_qty as $day => $qty) {
                        if ($day == $day_book2)
                            $check_qty[$day] -= $bookingDetail->quantity_room;
                    }
                }
            }
        }
        foreach ($check_qty as $qty) {
            if ($qty < $request->qty) {

                return redirect()->back()->with('message', __('messages.check.full'));
            }
        }

        return redirect()->back()->with('message', __('messages.check.availavle'))
            ->with('from', $request->fromDate)
            ->with('to', $request->toDate)
            ->with('qty', $request->qty)
            ->with('days', $days);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function booking(Request $request, $roomId)
    {
        $homestayId = $this->roomRepository->getRoomById($roomId)->homestay_id;
        $cart = session()->get('cart');
        $key = $roomId . "" . $request->from . "" . $request->to;
        if (isset($cart)) {
            foreach ($cart as $key1 => $booking) {
                $homestayIdCurrent = $this->roomRepository->getRoomById($cart[$key1]['roomId'])->homestay_id;
            }
            if ($homestayId != $homestayIdCurrent) {
                return redirect()->back()->with('message', __('messages.booking.error'));
            }
            if (isset($cart[$key])) {
                $cart[$key]['qty'] += $request->qty;
                session()->put('cart', $cart);
            } else {
                $roomName = $this->roomRepository->getRoomById($roomId)->name;
                $roomType = $this->roomRepository->getRoomById($roomId)->typeRoom->name;
                $cart[$key] = [
                    "roomId" => $roomId,
                    "roomType" => $roomType,
                    "roomName" => $roomName,
                    "from" => $request->from,
                    "to" => $request->to,
                    "qty" => $request->qty,
                    "price" => $request->price
                ];
                session()->put('cart', $cart);
            }
        } else {
            $roomName = $this->roomRepository->getRoomById($roomId)->name;
            $roomType = $this->roomRepository->getRoomById($roomId)->typeRoom->name;
            $cart[$key] = [
                "roomId" => $roomId,
                "roomType" => $roomType,
                "roomName" => $roomName,
                "from" => $request->from,
                "to" => $request->to,
                "qty" => $request->qty,
                "price" => $request->price
            ];
            session()->put('cart', $cart);
        }
        // $begin = date('Y-m-d', strtotime($request->from));
        // $end =  date('Y-m-d', strtotime(Carbon::parse($request->to)));
        // $booking = Booking::create(['user_id' => auth()->user()->id, 'day_start' => $begin, 'day_end' => $end, 'status' => 1]);
        // BookingDetail::create(['booking_id' => $booking->id, 'room_id' => $roomId, 'price' => $request->price, 'quantity_room' => $request->qty]);
        return redirect()->back()->with('message', __('messages.booking.sucsess'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $cart = array();
        $homestay = array();
        if (session()->has('cart')) {
            $cart = session()->get('cart');
            foreach ($cart as $key => $booking) {
                $homestayId = $this->roomRepository->getRoomById($cart[$key]['roomId'])->homestay_id;
                $homestay = $this->homestayRepository->getHomestayById($homestayId);
            }
        }
        return view('user.booking.my-booking', [
            'cart' => $cart,
            'homestay' => $homestay
        ]);
    }

    /**
     * checkout
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function checkout()
    {
        $cart = session()->get('cart');
        $check = array();
        foreach ($cart as $key => $value) {
            $begin = date('Y-m-d', strtotime($cart[$key]['from']));
            $end =  date('Y-m-d', strtotime(Carbon::parse($cart[$key]['from'])));
            $days = $begin . "" . $end;
            if (!isset($check[$days])) {
                $booking = Booking::create(['user_id' => auth()->user()->id, 'day_start' => $begin, 'day_end' => $end, 'status' => 1]);
                BookingDetail::create(['booking_id' => $booking->id, 'room_id' => $cart[$key]['roomId'], 'price' => $cart[$key]['price'], 'quantity_room' => $cart[$key]['qty']]);
                $check[$days] = [
                    "booking_id" => $booking->id,
                ];
            } else {
                BookingDetail::create(['booking_id' => $check[$days]['booking_id'], 'room_id' => $cart[$key]['roomId'], 'price' => $cart[$key]['price'], 'quantity_room' => $cart[$key]['qty']]);
            }
        }
        Session()->forget('cart');

        return redirect()->back()->with('message', __('messages.booking.sucsess'));
    }

    /**
     * cancel the booking
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel($key)
    {
        dd($key);
    }

    /**
     * history
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function history()
    {
        $booking = $this->bookingRepository->getBookingByIdUser(auth()->user()->id);
        $bookingDetails = array();
        foreach ($booking as $value) {
            $bookingDetail = $this->bookingDetailRepository->getBookingDetailByIdBooking($value['id']);
            foreach ($bookingDetail as $key => $value1) {
                $mang = array($bookingDetail[$key]);
                $bookingDetails = array_merge($bookingDetails, $mang);
            }
        }
        dd($bookingDetails);

        return view('user.booking.history', ['bookingDetails' => $bookingDetails]);
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
