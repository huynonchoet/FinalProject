<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashBoardController extends Controller
{
    public function index(){
        $statisticByMonth = DB::table('bookings')->join('booking_details', 'bookings.id', '=', 'booking_details.booking_id')
            ->selectRaw('SUM(booking_details.price) as total')
                ->selectRaw('MONTH(bookings.day_end) as month')
                ->whereRaw('YEAR(booking_details.created_at) = year(curdate())')
                ->where('bookings.status', '1')
                ->groupBy('month')
        ->get();
        dd($statisticByMonth);

        return view('admin.home');
    }
}
