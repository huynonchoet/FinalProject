<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Homestay;
use App\Models\StatisticIncome;
use App\Models\TypeRoom;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class DashBoardController extends Controller
{
    public function index()
    {
        $statisticByMonth = DB::table('bookings')->join('booking_details', 'bookings.id', '=', 'booking_details.booking_id')
            ->selectRaw('SUM(booking_details.price) as total')
            ->selectRaw('MONTH(bookings.day_end) as month')
            ->whereRaw('YEAR(bookings.day_end) = year(curdate())')
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
            ->whereRaw('YEAR(bookings.day_end) = year(curdate())')
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
        $month = date('m');
        foreach ($homestays as $homestay) {
            $dataIncome['total'] = 0;;
            $check = 0;
            $moneyIncome =  DB::table('bookings')->join('booking_details', 'bookings.id', '=', 'booking_details.booking_id')
                ->join('rooms', 'booking_details.room_id', '=', 'rooms.id')
                ->join('homestays', 'homestays.id', '=', 'rooms.homestay_id')
                ->selectRaw('SUM(booking_details.price / 100 * 5) as total')
                ->whereRaw('YEAR(bookings.day_end) = year(curdate())')
                ->whereRaw('MONTH(bookings.day_end) = ' . $month)
                ->where('bookings.status', '1')
                ->where('homestays.id', $homestay->id)
                ->get();
            if (!is_null($moneyIncome[0]->total)) {
                $dataIncome['total'] = $moneyIncome[0]->total;
            }
            foreach ($statisticIncomes as $statisticIncome) {
                if ($statisticIncome->homestay_id == $homestay->id && $statisticIncome->month == $month && $statisticIncome->year == date('Y')) {
                    $check = 1;
                    StatisticIncome::where('id', $statisticIncome->id)->update($dataIncome);
                }
            }
            if ($check == 0) {
                $dataIncome['homestay_id'] = $homestay->id;
                $dataIncome['month'] = $month;
                $dataIncome['year'] = date('Y');
                $dataIncome['status'] = '0';

                StatisticIncome::create($dataIncome);
            }
        }
        $statisticIncomes = StatisticIncome::select(
            'statistic_incomes.id',
            'homestay_id',
            'month',
            'year',
            'total',
            'status',
            'homestays.name'
        )->join('homestays', 'homestays.id', '=', 'statistic_incomes.homestay_id')->get();
        $taxs = DB::table('taxs')->get();

        return view('admin.income', ['statisticIncomes' => $statisticIncomes, 'taxs' => $taxs]);
    }

    public function updateStatus($id)
    {
        StatisticIncome::where('id', $id)->update(['status' => '1']);

        return redirect()->back()->with('message', 'Update successfully!!!');
    }

    public function remind($id)
    {
        $statisticIncome = StatisticIncome::select(
            'statistic_incomes.id',
            'homestay_id',
            'month',
            'year',
            'total',
            'status',
            'homestays.name',
            'homestays.user_id',
        )->join('homestays', 'homestays.id', '=', 'statistic_incomes.homestay_id')->where('statistic_incomes.id', $id)->get();
        $taxs = DB::table('taxs')->orderBy('day_start', 'asc')->get();
        $taxInMonth = 0;
        $day = Carbon::createFromFormat('Y-m-d', $statisticIncome[0]->year. '-' . $statisticIncome[0]->month . '-02');
        foreach ($taxs as $item){
            if($item->day_start < $day){
                $taxInMonth = $item->tax;
            }
        }
        $dataMail = [
            'month' => $statisticIncome[0]->month,
            'year' => $statisticIncome[0]->year,
            'total' => $statisticIncome[0]->total - ($statisticIncome[0]->total / 100 * 10),
            'name' => $statisticIncome[0]->name
        ];
        $user = User::find($statisticIncome[0]->user_id);
        Mail::send('mail.remind_money', $dataMail, function ($m) use ($user) {
            $m->to($user->email, $user->name)->subject('Notice of your homestay!!!');
        });

        return redirect()->back()->with('message', 'Send mail remind successfully!!!');
    }
}
