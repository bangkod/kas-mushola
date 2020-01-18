@extends('layouts.base')

@push('styles')

<link rel="stylesheet" href="{{ URL::to('/') }}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

@endpush

@section('content')

<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">Master User</h3>
  </div>
  <div class="box-body">
    <button class="btn btn-primary" data-toggle="modal" data-target="#modal">BUAT USER</button>
    <br><br>
    <table class="table table-striped table-hover table-bordered">
    	<thead>
    		<tr>
          <th>NO</th>
    			<th>USERNAME</th>
    			<th>NAMA</th>
    			<th>STATUS</th>
    			<th>AKSI</th>
    		</tr>
    	</thead>
    	<tbody>
    		@foreach($users as $key => $user)
    			<tr>
                    <td>{{ $key+1 }}</td>
    				<td>{{ $user->username }}</td>
    				<td>{{ $user->name }}</td>
    				<td>@if($user->status == 1) Aktif @else Tidak Aktif @endif</td>
    				<td>
              <button onClick="ubah('{{ $user->id }}')" class="btn btn-xs btn-warning" title="Ubah">
                <i class="fa fa-pencil"></i>
              </button>
              <button onClick="hapus('{{ $user->id }}')" class="btn btn-danger btn-xs" title="Hapus">
                <i class="fa fa-trash"></i>
              </button>
            </td>
    			</tr>
    		@endforeach
    	</tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>

<div class="modal" id="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="" role="form" id="form" method="POST">
        @csrf
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">BUAT USER BARU</h4>
        </div>
        <div class="modal-body">
            <div class="form-group row nik">
              <label for="nik" class="col-sm-2 control-label">NIK</label>
              <div class="col-sm-10">
                <input type="text" name="nik" class="form-control" id="nik" placeholder="NIK">
                <span class="help-block"></span>
              </div>
            </div>
            <div class="form-group row name">
              <label for="nama" class="col-sm-2 control-label">Nama</label>
              <div class="col-sm-10">
                <input type="text" name="name" class="form-control" id="nama" placeholder="Nama User">
                <span class="help-block"></span>
              </div>
            </div>
            <div class="form-group row tugas">
              <label for="tugas" class="col-sm-2 control-label">Tugas</label>
              <div class="col-sm-10">
                <input type="text" name="tugas" class="form-control" id="tugas" placeholder="Tugas Anggota Team">
                <span class="help-block"></span>
              </div>
            </div>
            <div class="form-group row status">
              <label for="Status" class="col-sm-2 control-label">Status</label>
              <div class="col-sm-10">
                <select name="status" id="status" class="form-control" style="width: 100%">
                  <option value="1">AKTIF</option>
                  <option value="2">TIDAK AKTIF</option>
                </select>
                <span class="help-block"></span>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary pull-left submit-button">OK</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal" id="modalEdit">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="" role="form" id="formEdit" method="POST">
        <input type="hidden" name="id" id="ubah-id">
        @csrf
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">UBAH USER</h4>
        </div>
        <div class="modal-body">
            <div class="form-group row username">
              <label for="ubah-username" class="col-sm-2 control-label">Username</label>
              <div class="col-sm-10">
                <input type="text" name="username" class="form-control" id="ubah-username" placeholder="username">
                <span class="help-block"></span>
              </div>
            </div>
            <div class="form-group row name">
              <label for="nama" class="col-sm-2 control-label">Nama</label>
              <div class="col-sm-10">
                <input type="text" name="name" class="form-control" id="ubah-name" placeholder="Nama User">
                <span class="help-block"></span>
              </div>
            </div>
            <div class="form-group row status">
              <label for="Status" class="col-sm-2 control-label">Status</label>
              <div class="col-sm-10">
                <select name="status" id="ubah-status" class="form-control" style="width: 100%">
                  <option value="1">AKTIF</option>
                  <option value="2">TIDAK AKTIF</option>
                </select>
                <span class="help-block"></span>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary pull-left submit-button">OK</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

@endsection

@push('scripts')
<script src="{{ URL::to('/') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ URL::to('/') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script>
    $('.table').DataTable();

    function ubah(id)
    {
      $.ajax({
          url: '{{ URL::to('/user/get') }}/'+id,
          type: 'GET',
          success: function ( response ) {
            $('#modalEdit').modal('show');
            $.each(response.data, (index, item) => {
              $('#ubah-'+index).val(item);
            })
          },
          error : function ( error ) {
          	console.log( error );
          }
      })
    }

    function hapus(id)
    {
      if( confirm('Yakin akan menghapus?') )
      {
        $.ajax({
          url: '{{ URL::to('/user/delete') }}/'+id,
          type: 'DELETE',
          success: function ( response ) {
            if (response.success == 1) {
              setTimeout(function() {
                location.reload();
              }, 1000);
            }
          },
          error : function ( error ) {
          	alert("Gagal menghapus");
          }
        })
      }
    }

    $(document).ready( function () {
      $('#form').submit( function (e) {
        e.preventDefault();
        var data = $(this).serialize();
        $.ajax({
          url: '{{ URL::to  ('/user/create') }}',
          type: 'POST',
          data: data,
          success: function ( response ) {
            if (response.success == 1) {
              $('.help-block').text('');
              makeAlert('Success', 'User Baru Berhasil Dibuat', 'success');
              setTimeout(function() {
                location.reload();
              }, 1000);
            }
          },
          error : function ( error ) {
            if (error.status == 422) {
              makeAlert('Error', error.responseJSON.message, 'error');
              $('.help-block').text('');
              $.each(error.responseJSON.errors, (index, item) => {
                $('.'+index+' .help-block').text(item);
              })
            }
          }
        })
      })

      $('#formEdit').submit( function (e) {
        e.preventDefault();
        var data = $(this).serialize();
        $.ajax({
          url: '{{ URL::to  ('/user/change') }}',
          type: 'POST',
          data: data,
          success: function ( response ) {
            if (response.success == 1) {
              $('.help-block').text('');
              setTimeout(function() {
                location.reload();
              }, 1000);
            }
          },
          error : function ( error ) {
            if (error.status == 422) {
            	alert("Gagal diubah");
              $('.help-block').text('');
              $.each(error.responseJSON.errors, (index, item) => {
                $('.'+index+' .help-block').text(item);
              })
            }
          }
        })
      })
    })
</script>

@endpush