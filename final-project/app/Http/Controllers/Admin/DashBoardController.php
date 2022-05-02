<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Homestay;
use App\Models\StatisticIncome;
use App\Models\TypeRoom;
use Illuminate\Support\Facades\DB;

class DashBoardController extends Controller
{
    public function index()
    {
        $statisticByMonth = DB::table('bookings')->join('booking_details', 'bookings.id', '=', 'booking_details.booking_id')
            ->selectRaw('SUM(booking_details.price) as total')
            ->selectRaw('MONTH(bookings.day_end) as month')
            ->whereRaw('YEAR(booking_details.created_at) = year(curdate())')
            ->where('bookings.status', '1')
            ->groupBy('month')
            ->get();
        $dataStatisticByMonth = array_fill(0, 12, 0);
        foreach ($statisticByMonth as $item) {
            $dataStatisticByMonth[$item->month - 1] = $item->total;
        }

        $statisticByTypeRoom = DB::table('bookings')->join('booking_details', 'bookings.id', '=', 'booking_details.booking_id')
            ->join('rooms', 'booking_details.room_id', '=', 'rooms.id')
            ->join('type_rooms', 'type_rooms.id', '=', 'rooms.type_room_id')
            ->select('type_rooms.name')
            ->selectRaw('SUM(booking_details.price) as total')
            ->whereRaw('YEAR(booking_details.created_at) = year(curdate())')
            ->where('bookings.status', '1')
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

        return view('admin.home', [
            'dataStatisticByMonth' => json_encode($dataStatisticByMonth),
            'dataStatisticByTypeRoom' => json_encode($dataStatisticByTypeRoom),
            'typeRoom' => json_encode($typeRoom)
        ]);
    }

    public function incomes()
    {
        $homestays = Homestay::all();
        $statisticIncomes = StatisticIncome::all();
        $month = 1;
        foreach ($homestays as $homestay) {
            $dataIncome = [];
            $check = 0;
            $moneyIncome =  DB::table('bookings')->join('booking_details', 'bookings.id', '=', 'booking_details.booking_id')
                ->join('rooms', 'booking_details.room_id', '=', 'rooms.id')
                ->join('homestays', 'homestays.id', '=', 'rooms.homestay_id')
                ->selectRaw('SUM(booking_details.price) as total')
                ->whereRaw('YEAR(booking_details.created_at) = year(curdate())')
                ->whereRaw('MONTH(booking_details.created_at) = ' . $month)
                ->where('bookings.status', '1')
                ->where('homestays.id', $homestay->id)
                ->get();
            if (is_null($moneyIncome[0]->total)) {
                $dataIncome['total'] = 0;
            } else {
                $dataIncome['total'] = $moneyIncome[0]->total;
            }
            foreach ($statisticIncomes as $statisticIncome) {
                if ($statisticIncome->homestay_id == $homestay->id && $statisticIncome->month == $month && $statisticIncome->year == date('Y')) {
                    $check = 1;
                }
            }
            if ($check == 0) {
                $dataIncome = [
                    'homestay_id' => $homestay->id,
                    'month' => $month,
                    'year' => date('Y'),
                    'status' => '0'
                ];
                StatisticIncome::create($dataIncome);
            }
        }
    }

    public function newStatisticIncomes()
    {
        $statisticIncomes = StatisticIncome::all();
    }
}
