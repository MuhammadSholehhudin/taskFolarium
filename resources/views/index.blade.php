@extends('layouts.main')

@section('content')

<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#myModal">Add New Data Kontrak</button>

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
            <th scope="col">ID Pegawai</th>
            <th scope="col">Name</th>
            <th scope="col">Jabatan</th>
            <th scope="col">Tanggal Mulai Kontrak</th>
            <th scope="col">Tanggal Berakhir Kontrak</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1 ?>
        @foreach($kontrakList as $kontrak)
      <tr>
        <th scope="row">{{ $no++ }}</th>
        <td>{{ $kontrak->id_pegawai }}</td>
        <td>{{ $kontrak->pegawai->nama_pegawai }}</td>
        <td>{{ $kontrak->jabatan->nama_jabatan}}</td>
        <td>{{ $kontrak->tgl_mulai_kontrak }}</td>
        <td>{{ $kontrak->tgl_berakhir_kontrak }}</td>
        <td>
            <form action="{{ url('employee/'.$kontrak->id_pegawai) }}" method="POST">
                @csrf
                {{-- <a href="{{ url('employee/'.$kontrak->id_pegawai.'/edit') }}" type="button" class="btn btn-secondary">Edit</a> --}}
              
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



{{-- Add/Edit Employee Modal --}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Add New Data Kontrak</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ url('employee') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama_pegawai" class="col-form-label">Nama Pegawai : </label>
                        <select name="nama_pegawai" class="form-control" aria-label="Default select example" id="nama_pegawai" required>
                            <option selected>Pilih Nama Pegawai...</option>
                            @foreach($pegawaiList as $pegawai)
                            <option value="{{ $pegawai->id_pegawai }}">{{ $pegawai->nama_pegawai }}</option>
                            @endforeach
                          </select>
                    </div>
                    <div class="form-group">
                        <label for="jabatan" class="col-form-label">Jabatan :</label>
                        <select name="jabatan" class="form-control" aria-label="Default select example" id="jabatan" required>
                            <option selected>Pilih Jabatan...</option>
                            @foreach($jabatanList as $jabatan)
                            <option value="{{ $jabatan->id_jabatan }}">{{ $jabatan->nama_jabatan }}</option>
                            @endforeach
                          </select>
                    </div>
                    <div class="form-group">
                        <label for="start_kontrak" class="col-form-label">Tanggal Mulai Kontrak :</label>
                        <input type="date" class="form-control" id="start_kontrak" name="start_kontrak" required>
                    </div>
                    <div class="form-group">
                        <label for="end_kontrak" class="col-form-label">Tanggal Berakhir Kontrak :</label>
                        <input type="date" class="form-control" id="end_kontrak" name="end_kontrak" required>
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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        let action = '';
        let id = '';
        console.log(id)

        $('[data-action]').on('click', function(){
            action = $(this).data('action');
            id = $(this).data('id');

            if(action === 'edit'){
                $.ajax({
                    url: 'employee/' + id + '/edit',
                    method: 'GET',
                    success: function(response){
                        $('select[name="nama_pegawai"]').val(response.nama_pegawai);
                        $('select[name="jabatan"]').val(response.nama_jabatan);
                        $('input[name="start_kontrak"]').val(response.tgl_mulai_kontrak);
                        $('input[name="end_kontrak"]').val(response.tgl_berakhir_kontrak);
                        console.log(response)
                    }
                });
            } else {
                $('select[name="nama"]').val('');
                $('select[name="jabatan"]').val('');
                $('input[name="start_kontrak"]').val('');
                $('input[name="end_kontrak"]').val('');
            }
            $('#myModal').modal('show');
        })
    });
</script>