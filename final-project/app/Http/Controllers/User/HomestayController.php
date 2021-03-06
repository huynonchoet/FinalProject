<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddHomestayRequest;
use App\Http\Requests\UpdateHomestayRequest;
use App\Interfaces\HomestayRepositoryInterface;
use App\Interfaces\RoomRepositoryInterface;
use App\Models\BookingDetail;
use App\Models\Homestay;
use App\Models\HomestayReport;
use App\Models\Rate;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        return view('user.homestay.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddHomestayRequest $request)
    {
        $newImages = [];
        if ($request->hasFile('image')) {
            foreach ($request->image as $img) {
                $newImages[] = $nameImage = strtotime(date('Y-m-d H:i:s')) . "_" . $img->getClientOriginalName();
                $img->storeAs('public/homestays', $nameImage);
            }
        }
        $request['images'] = json_encode($newImages);
        $request['user_id'] = Auth::id();
        $newDetails = $request->only(
            [
                'user_id',
                'name',
                'images',
                'address',
                'phone',
            ]
        );
        $result = $this->homestayRepository->createHomestay($newDetails);
        if (!empty($result)) {
            return back()->with('success', __('messages.create.success'));
        }

        return back()->with('error', __('messages.create.fail'))->withInput();
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
        return view(
            'user.homestay.edit',
            [
                'homestay' => $this->homestayRepository->getHomestayById($id),
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
    public function update(UpdateHomestayRequest $request, $id)
    {
        $oldHomestay = $this->homestayRepository->getHomestayById($id);
        $oldImages =  json_decode($oldHomestay->images);
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
        if ($totalImage <= config('const.imageHomestay.max') && $totalImage >= config('const.imageHomestay.min')) {
            $oldImages = array_diff($oldImages, $request->imageDelete);
            foreach ($request->imageDelete as $item) {
                Storage::delete('/public/homestays/' . $item);
            }
            if ($request->hasFile('imageNew')) {
                foreach ($request->imageNew as $img) {
                    $newImages[] = $nameImage = strtotime(date('Y-m-d H:i:s')) . "_" . $img->getClientOriginalName();
                    $img->storeAs('public/homestays', $nameImage);
                }
            }
            $request['images'] = json_encode(array_merge($newImages, $oldImages));
            $newDetails = $request->only(
                [
                    'name',
                    'images',
                    'address',
                    'phone',
                ]
            );
            $this->homestayRepository->updateHomestay($id, $newDetails);

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
        $homestay = $this->homestayRepository->getHomestayById($id);
        $imageDelete = json_decode($homestay->images);
        $result = $this->homestayRepository->deleteHomestay($id);
        if (!empty($result)) {
            foreach ($imageDelete as $item) {
                Storage::delete('/public/homestays/' . $item);
            }

            return back()->with('success', __('messages.delete.success'));
        }

        return back()->with('error', __('messages.delete.fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function report($id)
    {
        $homestay = Homestay::find($id);

        return view("modal.report-homestay", compact("homestay"))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createReport(Request $request)
    {;
        $data = [
            'user_id' => auth()->id(),
            'homestay_id' => (int)$request->homestay_id,
            'content' => $request->content,
            'status' => '0',
        ];
        HomestayReport::create($data);

        return redirect()->back()->with('success', __('Report successfully!!!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function rate($id)
    {
        $bookingDetail = BookingDetail::find($id);
        $room_id = $bookingDetail->room_id;
        $room = Room::find($room_id);
        $homestay_id = $room->homestay_id;
        $homestay = Homestay::find($homestay_id);

        return view("modal.rate_homestays", compact("homestay","bookingDetail"))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createRate(Request $request, $id)
    {
        if($request->star == 0){
            return redirect()->back()->with('error', __('Rate failed, you must choose number of stars!!!'));
        }
        $bookingDetails_id =$request->bookingDetails_id;
        $data = [
            'user_id' => auth()->id(),
            'homestay_id' => $id,
            'star' => (int)$request->star,
            'bookingDetails_id' => $bookingDetails_id
        ];
        Rate::create($data);

        return redirect()->back()->with('success', __('Rate successfully!!!'));
    }
}
