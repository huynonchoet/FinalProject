<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Homestay;
use App\Models\TypeRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function statistic()
    {
        $statisticByMonth = DB::table('bookings')->join('booking_details', 'bookings.id', '=', 'booking_details.booking_id')
            ->join('rooms', 'booking_details.room_id', '=', 'rooms.id')
            ->join('homestays', 'homestays.id', '=', 'rooms.homestay_id')
            ->selectRaw('SUM(booking_details.price) as total')
            ->selectRaw('MONTH(bookings.day_end) as month')
            ->whereRaw('YEAR(bookings.day_end) = year(curdate())')
            ->where('bookings.status', '1')
            ->where('homestays.user_id', auth()->id())
            ->groupBy('month')
            ->get();
        $dataStatisticByMonth = array_fill(0, 12, 0);
        foreach ($statisticByMonth as $item) {
            $dataStatisticByMonth[$item->month - 1] = $item->total;
        }

        $statisticByTypeRoom = DB::table('bookings')->join('booking_details', 'bookings.id', '=', 'booking_details.booking_id')
            ->join('rooms', 'booking_details.room_id', '=', 'rooms.id')
            ->join('homestays', 'homestays.id', '=', 'rooms.homestay_id')
            ->join('type_rooms', 'type_rooms.id', '=', 'rooms.type_room_id')
            ->select('type_rooms.name')
            ->selectRaw('SUM(booking_details.price) as total')
            ->whereRaw('YEAR(bookings.day_end) = year(curdate())')
            ->where('bookings.status', '1')
            ->where('homestays.user_id', auth()->id())
            ->groupBy('type_rooms.name')
            ->get();
        $typeRooms = TypeRoom::select('name')->get();
        $dataStatisticByTypeRoom = array_fill(0, count($typeRooms), 0);
        $i = 0;
        $typeRoom = [];
        foreach ($typeRooms as $item) {
            $typeRoom[$i] = $item->name;
            foreach ($statisticByTypeRoom as $item_child)
                if ($item_child->name == $item->name) {
                    $dataStatisticByTypeRoom[$i] = $item_child->total;
                }
            $i++;
        }

        $statisticByHomestay = DB::table('bookings')->join('booking_details', 'bookings.id', '=', 'booking_details.booking_id')
            ->join('rooms', 'booking_details.room_id', '=', 'rooms.id')
            ->join('homestays', 'homestays.id', '=', 'rooms.homestay_id')
            ->select('homestays.name')
            ->selectRaw('SUM(booking_details.price) as total')
            ->whereRaw('YEAR(bookings.day_end) = year(curdate())')
            ->where('bookings.status', '1')
            ->where('homestays.user_id', auth()->id())
            ->groupBy('homestays.name')
            ->get();
        $homestays = Homestay::select('name')->where('user_id', auth()->id())->get();
        $dataStatisticByHomestay = array_fill(0, count($homestays), 0);
        $i = 0;
        $homestay = [];
        foreach ($homestays as $item) {
            $homestay[$i] = $item->name;
            foreach ($statisticByHomestay as $item_child)
                if ($item_child->name == $item->name) {
                    $dataStatisticByHomestay[$i] = $item_child->total;
                }
            $i++;
        }

        return view('user.statistic', [
            'dataStatisticByMonth' => json_encode($dataStatisticByMonth),
            'dataStatisticByTypeRoom' => json_encode($dataStatisticByTypeRoom),
            'typeRoom' => json_encode($typeRoom),
            'dataStatisticByHomestay' => json_encode($dataStatisticByHomestay),
            'homestay' => json_encode($homestay)
        ]);
    }
}
