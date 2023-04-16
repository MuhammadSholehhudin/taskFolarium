@extends('layouts.main')

@section('content')

<div class="container mt-5">
    <form action="{{ url('employee/'.$data->id) }}" method="POST">
                        
        @csrf
        <div class="form-group">
            <label for="name" class="col-form-label">Name : </label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}">
        </div>
        <div class="form-group">
            <label for="dob" class="col-form-label">Date of Birth :</label>
            <input type="date" class="form-control" id="dob" name="dob" value="{{ $data->birth_of_date }}">
        </div>
        <div class="form-group">
            <label for="title" class="col-form-label">Title : </label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $data->title }}">
        </div>
        <div class="form-group">
            <label for="nip" class="col-form-label">NIK :</label>
            <input type="number" class="form-control" id="nip" name="nip" value="{{ $data->id_employee }}">
        </div>
        <a href="{{ url('employee') }}" type="button" class="btn btn-secondary">Cancel</a>
                @method('PUT')
                <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>


@endsection