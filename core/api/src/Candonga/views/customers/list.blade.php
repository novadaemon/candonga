@extends('layout')

@section('content')
    <div class="row pt-5">
        <div class="col-md-12">
            <h4>Customers</h4>
            <a href="{{ route('customers.add') }}" class="btn btn-primary">Add new customer</a>
        </div>
        <div class="col-md-12 pt-5">
            <table class="table table-stripped table-hover">
                <thead>
                    <tr>
                        <th>Uuid</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Date of Birth</th>
                        <th>Created_at</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($records as $record)
                        <tr>
                            <td>{{ $record->uuid }}</td>
                            <td>{{ $record->first_name }}</td>
                            <td>{{ $record->last_name }}</td>
                            <td>{{ $record->date_of_birth->format('Y-m-d') }}</td>
                            <td>{{ $record->created_at->format('Y-m-d') }}</td>
                            <td><span class="badge badge-warning">{{ $record->status }}</span></td>
                            <td>
                                <a href="{{ route('customers.edit', $record->id) }}" class="btn btn-secondary btn-sm" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="" data-id="{{ $record->id }}" class="btn btn-danger btn-sm btn-delete" title="Delete">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@push('js')
    <script>
        $(document).on('click', '.btn-delete', function(e){
            e.preventDefault();

            var i = confirm('Are you sure?');
            var row = $(this).parents('tr').remove();
            var id = $(this).data('id');

            if(i){
                $.ajax({
                    type: 'post',
                    url: id,
                    data: {
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(resp, status){
                        if(resp.statusCode == 200)
                            row.remove();
                        else
                            alert('Han error has occurred. Try again.');
                    },
                    fail: function(){
                        alert('Han error has occurred. Try again.');
                    }
                })
            }


        });
    </script>
@endpush