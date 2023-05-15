@extends('layouts.main')

@section('content')

<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#myModal" data-action="create">Add New Data Kontrak</button>

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
            <th scope="col">Nama Pegawai</th>
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
            <form id="actionForm" action="{{ url('employee/'.$kontrak->id_kontrak) }}" method="POST">
                @csrf
                
                @method('PUT')
                <button type="button" class="btn btn-primary" id="editButton" data-toggle="modal" data-target="#myModal" data-action="edit" data-id="{{ $kontrak->id_kontrak }}">Edit</button>
           
                @method('DELETE')
                <button type="submit" class="btn btn-danger deleteButton" data-id="{{ $kontrak->id_kontrak }}">Delete</button>
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
                <h5 class="modal-title" id="modalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="kontrakForm" method="POST">
                    @csrf
            
                    <div class="form-group">
                        <label for="nama_pegawai" class="col-form-label">Nama Pegawai : </label>
                        <select name="nama_pegawai" class="form-control" aria-label="Default select example" id="nama_pegawai" required>
                            <option value="default" selected>Pilih Nama Pegawai...</option>
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
                <button type="submit" class="btn btn-primary" id="saveButton">Save</button>
            </div>
        </form>

        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        let action = '';
        let editId = '';
       

        $('[data-action]').on('click', function(){
            let action = $(this).data('action');
            let editId = $(this).data('id');

                if(action === 'create'){
                    $('#modalLabel').text('Add New Data Kontrak');
                    $('#kontrakForm').attr('action', '/employee');
                    $('#saveButton').text('Save');

                    $('select[name="nama_pegawai"]').val("");
                    $('select[name="jabatan"]').val("");
                    $('input[name="start_kontrak"]').val("");
                    $('input[name="end_kontrak"]').val("");

                    $('select[name="nama_pegawai"] option:selected').prop('selected', false);
                    $('select[name="jabatan"] option:selected').prop('selected', false);
                    $('select[name="nama_pegawai"] option:first').prop('selected', true);
                    $('select[name="jabatan"] option:first').prop('selected', true);
            } else if (action === 'edit'){
                    $('#kontrakForm').attr('action', '/employee/' + editId);
                    $('#kontrakForm').attr('method', 'POST');
                    $('#modalLabel').text('Edit Data Kontrak');
                    $('#saveButton').text('Update');
                    populateFormWithEditData(editId);
                }

            $('#myModal').modal('show');
        });

        $('#kontrakForm').submit(function(e) {
                e.preventDefault();

                var action = $('#saveButton').text() === 'Save' ? 'create' : 'edit';
                var url = action === 'create' ? '/employee' : $('#kontrakForm').attr('action');
                var method = action === 'create' ? 'POST' : 'PUT'; // Use POST method for method override

                // Add CSRF token to the form data
                var formData = $('#kontrakForm').serialize();
                formData += '&_method=' + method; // Add method override

                $.ajax({
                    url: url,
                    method: method,
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token in headers
                    },
                    success: function(response) {
                        console.log(response);
                        $('#myModal').modal('hide');
                        location.reload();
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });




        function populateFormWithEditData(id) {
            // Lakukan AJAX request untuk mendapatkan data detail kontrak
            $.ajax({
                url: '/api/kontrak/' + id,
                method: 'GET',
                success: function(response) {
                    // Mengisi nilai input form dengan data kontrak yang diterima
                    $('select[name="nama_pegawai"]').val(response.id_pegawai);
                    $('select[name="jabatan"]').val(response.id_jabatan);
                    $('input[name="start_kontrak"]').val(response.tgl_mulai_kontrak);
                    $('input[name="end_kontrak"]').val(response.tgl_berakhir_kontrak);
                }
            });
        }     
        // Fungsi Delete
            $('.deleteButton').click(function(e) {
                e.preventDefault();
        
                var confirmation = confirm("Apakah Anda yakin ingin menghapus kontrak ini?");
                
                if (confirmation) {
                    $(this).closest('#actionForm').submit();
                }
            });
});



       

</script>
