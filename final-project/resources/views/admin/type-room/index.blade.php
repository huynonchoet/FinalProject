@extends('admin.layouts.app')
@section('content')
    <script type="text/javascript">
        $(document).ready(function() {
            //button accept click
            $('button#accept').on('click', function() {
                var id = $(this).closest("tr").find('input#id-booking').val()
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'PATCH',
                    url: '/admin/type-rooms/update/' + id,
                    data: {
                        status: 1,
                        id: id
                    },
                    success: function(data) {
                        document.getElementById("action-" + id).hidden = true;
                        $('td#status-' + id).text('Accepted');
                    }
                });
            })

            //button cancel click
            $('button#cancel').on('click', function() {
                var id = $(this).closest("tr").find('input#id-booking').val()
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'DELETE',
                    url: '/admin/type-rooms/delete/' + id,
                    data: {
                        id: id
                    },
                    success: function(data) {
                        document.getElementById("action-" + id).hidden = true;
                        $('td#status-' + id).text('Deleted');
                    }
                });
            })
        });
    </script>
    <table class="table table-striped">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <a href="{{ route('admin.type-rooms.create') }}"><button style="margin-top: 11px;"
                class="btn btn-primary float-right mb-2 mr-2">Add New
                TypeRoom</button></a>
        <thead style="width: 650px;margin-inline: auto;">
            <tr>
                <th>
                    Name
                </th>
                <th>
                    Status
                </th>
                <th>
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($typeRooms as $key => $item)
                <tr role="row">
                    <td>{{ $item->name }}</td>
                    <td id="status-{{ $item->id }}">{{ $item->statusLabel }}</td>
                    @if ($item->status == '0')
                        <td style="display: flex;" id="action-{{ $item->id }}">
                            <input id="id-booking" type="hidden" value="{{ $item->id }}">
                            <button type="button" id="accept" class="btn btn-success">
                                <i class="bi bi-check-circle-fill"></i>Accept
                            </button>
                            <button type="button" id="cancel" class="btn btn-danger">
                                <i class="bi bi-check-circle-fill"></i>Delete
                            </button>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
@section('js')
@endsection
