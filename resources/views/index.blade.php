@extends('layouts.main')

@section('content')

<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#myModal">Employee</button>

@if(session('added'))
    <div class="alert alert-success">{{ session('added') }}</div>
@elseif(session('updated'))
<div class="alert alert-success">{{ session('updated') }}</div>
@elseif(session('deleted'))
<div class="alert alert-danger">{{ session('deleted') }}</div>
@endif
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Name</th>
            <th scope="col">Birth of Date</th>
            <th scope="col">Title</th>
            <th scope="col">NIK</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1 ?>
        @foreach($datas as $key=>$value)
      <tr>
        <th scope="row">{{ $no++ }}</th>
        <td>{{ $value->name }}</td>
        <td>{{ $value->birth_of_date }}</td>
        <td>{{ $value->title }}</td>
        <td>{{ $value->id_employee }}</td>
        <td>
            <form action="{{ url('employee/'.$value->id) }}" method="POST">
                @csrf
                <a href="{{ url('employee/'.$value->id.'/edit') }}" type="button" class="btn btn-secondary">Edit</a>
                {{-- <a href="" type="button" class="btn btn-secondary" data-toggle="modal" data-target="#myEditModal" data-id="{{ $value->id }}">Edit</a> --}}
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete this data ?')">Delete</button>
            </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
@endsection


{{-- Add Employee Modal --}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Add Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ url('employee') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="col-form-label">Name : </label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="dob" class="col-form-label">Date of Birth :</label>
                        <input type="date" class="form-control" id="dob" name="dob" required>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-form-label">Title : </label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="nip" class="col-form-label">NIK :</label>
                        <input type="number" class="form-control" id="nip" name="nip" required>
                    </div>
                
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>

        </div>
    </div>
</div>

{{-- Edit Modal --}}
<div class="modal fade" id="myEditModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Edit Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ url('employee/'.$value->id) }}" method="POST">
                    
                    @csrf
                    <div class="form-group">
                        <label for="name" class="col-form-label">Name : </label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $value->name }}">
                    </div>
                    <div class="form-group">
                        <label for="dob" class="col-form-label">Date of Birth :</label>
                        <input type="date" class="form-control" id="dob" name="dob" value="{{ $value->birth_of_date }}">
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-form-label">Title : </label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $value->title }}">
                    </div>
                    <div class="form-group">
                        <label for="nip" class="col-form-label">NIK :</label>
                        <input type="number" class="form-control" id="nip" name="nip" value="{{ $value->id_employee }}">
                    </div>
                
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                @method('PUT')
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>

        </div>
    </div>
</div>

