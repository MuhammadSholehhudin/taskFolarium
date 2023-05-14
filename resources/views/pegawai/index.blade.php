@extends('layouts.main')

@section('content')

<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#myModal">Add New Data Pegawai</button>

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">ID Pegawai</th>
            <th scope="col">Nama Pegawai</th>
            <th scope="col">Jabatan</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1 ?>
        @foreach($pegawai as $item)
      <tr>
        <th scope="row">{{ $no++ }}</th>
        <td>{{ $item->id_pegawai }}</td>
        <td>{{ $item->nama_pegawai }}</td>
        <td>{{ $item->id_jabatan}}</td>
        <td>
            <form action="{{ url('pegawai/'.$item->id_pegawai) }}" method="POST">
                @csrf
              
                <!-- Tombol untuk menampilkan modal dalam mode edit -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" >Edit</button>
                
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete this data ?')">Delete</button>
            </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
@endsection


