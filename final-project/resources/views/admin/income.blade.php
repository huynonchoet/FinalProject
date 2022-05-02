@extends('admin.layouts.app')
@section('content')
    <div>
        <p class="h2">System Revenue</p>
    </div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <table class="table table-striped">
        <thead>
            <tr>
                <th class="col-4">
                    Homestay Name
                </th>
                <th class="col-1">
                    Month
                </th>
                <th class="col-1">
                    Year
                </th>
                <th class="col-2">
                    Total Income
                </th>
                <th class="col-1">
                    Status
                </th>
                <th class="col-2">
                    Action
                </th>
            </tr>
        </thead>
    </table>
    @for ($i = 5; $i >= 1; $i--)
        <p class="h4">{{ $i }}/2022</p>
        <table class="table table-striped">
            <tbody>
                @foreach ($statisticIncomes as $item)
                    @if ($item->month == $i && $item->total > 0)
                        <tr role="row">
                            <td class="col-4">{{ $item->name }}</td>
                            <td class="col-1">{{ $item->month }}</td>
                            <td class="col-1">{{ $item->year }}</td>
                            <td class="col-2">{{ number_format($item->total) }} VNĐ</td>
                            @if ($item->status == 0)
                                <td class="col-1">
                                    <p class="text-warning">Unpaid</p>
                                </td>
                                <td class="col-2">
                                    <div class="d-flex">
                                        <form action="{{ route('admin.incomes.status', ['id' => $item->id]) }}"
                                            method="post">
                                            @csrf
                                            <button class="btn btn-success" type="submit">PAID</button>
                                        </form>
                                        <form action="{{ route('admin.incomes.remind', ['id' => $item->id]) }}"
                                            method="post">
                                            @csrf
                                            <button class="btn btn-warning ml-3" type="submit">REMIND</button>
                                        </form>
                                    </div>
                                </td>
                            @else
                                <td class="col-1">
                                    <p class="text-success">Paid</p>
                                </td>
                                <td class="col-2"></td>
                            @endif
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    @endfor
@endsection
@section('js')
@endsection
