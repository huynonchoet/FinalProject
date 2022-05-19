@extends('admin.layouts.app')
@section('content')
    <div>
        <p class="h2">Tax Management</p>
    </div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <table class="table table-striped">
        <a href="{{ route('admin.taxs.create') }}"><button class="btn btn-primary float-right mb-2 mr-2">Update Tax</button></a>
        <thead>
            <tr>
                <th class="col-4">
                    Start Day
                </th>
                <th class="col-4">
                    End Day
                </th>
                <th class="col-4">
                    Applicable Tax
                </th>
            </tr>
        </thead>
    </table>
    <table class="table table-striped">
        <tbody>
            @foreach ($taxs as $item)
                <tr role="row">
                    <td class="col-4">{{ $item->day_start }}</td>
                    <td class="col-4">{{ $item->day_end }}</td>
                    <td class="col-4">{{ $item->tax }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@section('js')
@endsection
