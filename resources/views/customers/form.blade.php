@extends('layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h4><a href="{{ route('customers.index') }}">Customers</a> > @if($record->id) Edit @else Insert @endif</h4>
        </div>
    </div>
    <form action="{{ $record->id ? route('customers.update', $record->id) : route('customers.store') }}" method="post">
        @csrf
        @if(!$record->id)
            <input type="hidden" name="_method" value="PUT">
        @endif
        <div class="row">
            <div class="col-md-5 col-lg-4">
                <div class="form-group">
                    <label>Uuid</label>
                    <div class="input-group">
                        <input type="text" class="form-control" readonly value="{{ $record->uuid }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>First Name</label>
                    <div class="input-group">
                        <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="First Name" value="{{ !empty(old('first_name')) ? old('first_name') : $record->first_name }}">
                        @error('first_name')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <div class="input-group">
                        <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="Last Name" value="{{ !empty(old('last_name')) ? old('last_name') : $record->last_name }}">
                        @error('last_name')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Date of Birth</label>
                    <div class="input-group">
                        <input type="text" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" placeholder="YYYY-MM-DD" value="{{ !empty(old('date_of_birth')) ? old('date_of_birth') : ($record->id ? $record->date_of_birth->format('Y-m-d') : '') }}">
                        @error('date_of_birth')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <div class="input-group">
                        <select name="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="new" @if(!empty(old('status')) && old('status') == 'new' || $record->status == 'new') selected @endif>new</option>
                            <option value="pending" @if(!empty(old('status')) && old('status') == 'pending' || $record->status == 'pending') selected @endif>pending</option>
                            <option value="in review" @if(!empty(old('status')) && old('status') == 'in review' || $record->status == 'in review') selected @endif>in review</option>
                            <option value="approved" @if(!empty(old('status')) && old('status') == 'approved' || $record->status == 'approved') selected @endif>approved</option>
                            <option value="inactive" @if(!empty(old('status')) && old('status') == 'inactive' || $record->status == 'inactive') selected @endif>inactive</option>
                            <option value="deleted" @if(!empty(old('status')) && old('status') == 'deleted' || $record->status == 'deleted') selected @endif>deleted</option>
                        </select>
                        @error('status')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-lg-8">
                @if($record->id)
                    <h3 class="mt-0">Products <button style="font-size: 8px;" class="btn btn-success btn-sm btn-product-add" title="Add Product"><i class="fa fa-plus"></i></button></h3>
                        <table id="table-products" class="table table-tripped table-hover">
                            <thead>
                                <tr>
                                    <th>Issn</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th width="120px">Created at</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                             @foreach($record->products as $product)
                                 <tr>
                                     <td>
                                         <input type="text" class="form-control form-control-sm" name="products[{{ $product->id }}][issn]" value="{{ $product->issn }}" required>
                                     </td>
                                     <td>
                                         <input type="text" class="form-control form-control-sm" name="products[{{ $product->id }}][name]" value="{{ $product->name }}" required>
                                     </td>
                                     <td>
                                         <select name="products[{{ $product->id }}][status]" class="form-control form-control-sm" required>
                                             <option value="new" @if($product->status == 'new') selected @endif>new</option>
                                             <option value="pending" @if($product->status == 'pending') selected @endif>pending</option>
                                             <option value="in review" @if($product->status == 'in review') selected @endif>in review</option>
                                             <option value="approved" @if($product->status == 'approved') selected @endif>approved</option>
                                             <option value="inactive" @if($product->status == 'inactive') selected @endif>inactive</option>
                                             <option value="deleted" @if($product->status == 'deleted') selected @endif>deleted</option>
                                         </select>
                                     </td>
                                     <td>
                                         <input type="text" class="form-control form-control-sm" readonly value="{{ $product->created_at->format('Y-m-d') }}">
                                     </td>
                                     <td style="text-align: right;">
                                          <a href="" class="btn btn-danger btn-sm btn-product-delete" title="Delete">
                                             <i class="fa fa-trash"></i>
                                         </a>
                                     </td>
                                 </tr>
                             @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            <div class="col-md-12 mt-2">
                <button class="btn btn-primary btn-block" type="submit">Save changes</button>
            </div>
        </div>
    </form>
@stop
@push('js')
    <script>
            $(document).on('click', '.btn-product-delete', function(e){
                e.preventDefault();
               $(this).parents('tr').remove();
            });

            $('.btn-product-add').on('click', function(e){
                e.preventDefault();

                var id = Math.random().toString(36).substr(2, 9);

                var row = '<tr>\
                             <td>\
                                 <input type="text" class="form-control form-control-sm" name="products['+id+'][issn]" required>\
                             </td>\
                             <td>\
                                 <input type="text" class="form-control form-control-sm" name="products['+id+'][name]" required>\
                             </td>\
                             <td>\
                                 <select name="products['+id+'][status]" class="form-control form-control-sm" required>\
                                     <option value="new">new</option>\
                                     <option value="pending">pending</option>\
                                     <option value="in review">in review</option>\
                                     <option value="approved">approved</option>\
                                     <option value="inactive">inactive</option>\
                                     <option value="deleted">deleted</option>\
                                 </select>\
                             </td>\
                             <td>\
                                 <input type="text" class="form-control form-control-sm" readonly="">\
                             </td>\
                             <td style="text-align: right;">\
                                  <a href="" class="btn btn-danger btn-sm btn-product-delete" title="Delete">\
                                     <i class="fa fa-trash"></i>\
                                 </a>\
                             </td>\
                         </tr>';

                $('#table-products').append(row);

            });


    </script>
@endpush