@extends('layouts.main')

@section('content')


<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">ID Pegawai</th>
            <th scope="col">Nama Pegawai</th>
            <th scope="col">Tgl Mulai Kontrak</th>
            <th scope="col">Tgl Berakhir Kontrak</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1 ?>
        @foreach($kontrak as $item)
      <tr>
        <th scope="row">{{ $no++ }}</th>
        <td>{{ $item->id_pegawai }}</td>
        <td>{{ $item->id_jabatan }}</td>
        <td>{{ $item->tgl_mulai_kontrak}}</td>
        <td>{{ $item->tgl_berakhir_kontrak}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
@endsection


