<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Interfaces\BookingDetailRepositoryInterface;
use App\Interfaces\BookingRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookingLandlordController extends Controller
{
    private $bookingRepository;
    private $bookingDetailsRepository;
    private $userRepository;

    public function __construct(
        BookingRepositoryInterface $bookingRepository,
        BookingDetailRepositoryInterface $bookingDetailRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->bookingRepository = $bookingRepository;
        $this->bookingDetailRepository = $bookingDetailRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->status = '0';
        $request->start_day = Carbon::yesterday()->format('Y-m-d');
        $request->end_day = Carbon::tomorrow()->format('Y-m-d');
        $bookinglandlords = $this->bookingRepository->getAllBookingsByIdUserLandLord($request);

        return view('user.booking_landlords.index', ['bookinglandlords' => $bookinglandlords]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSearch(Request $request)
    {
        $bookinglandlords = $this->bookingRepository->getAllBookingsByIdUserLandLord($request);
        foreach ($bookinglandlords as $value) {
            $value->total_price = number_format($value->total_price);
        }
        return $bookinglandlords;
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
        $newDetails = ['status' => $request->action];
        $this->bookingRepository->updateBooking($id, $newDetails);
        $this->sendMailBooking($id, $newDetails);

        return $newDetails;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $booking = $this->bookingRepository->getBookingById($id);
        $bookingDetails = $this->bookingDetailRepository->getBookingDetailByIdBooking($id);
        $user = $this->userRepository->getUserById($booking->user_id);

        return view('user.booking_landlords.show', ['booking' => $booking, 'bookingDetails' => $bookingDetails, 'user' => $user]);
    }

    public function sendMailBooking($id, $newDetails){
        $booking = $this->bookingRepository->getBookingById($id);
        $user = User::find($booking->user_id);
        Mail::send('mail.notice_booking', ['status' => $newDetails['status']], function ($m) use ($user) {
            $m->to($user->email, $user->name)->subject('Notice of your booking!!!');
        });
    }
}
