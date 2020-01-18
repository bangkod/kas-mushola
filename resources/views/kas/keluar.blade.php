@extends('layouts.base')

@section('content')
<div class="box box-success">
    <div class="box-header with-border text-center">
        <span class="box-title">KAS KELUAR</span>
    </div>
    <div class="box-body">
      @if(Auth::check())
    	<button data-toggle="modal" data-target="#modal-success" type="button" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah</button>
    	<br><br>
      @endif
        <table class="table table-striped table-bordered">
        	<thead>
        		<tr>
        			<th>No.</th>
        			<th>Kode</th>
        			<th>Tanggal</th>
        			<th>Ketarangan</th>
        			<th>Jumlah</th>
              @if(Auth::check())
        			<th>Aksi</th>
              @endif
        		</tr>
        	</thead>
        	<tbody>
        		@foreach($kas as $key => $data)
        		<tr>
        			<td>{{ $key + 1 }}</td>
        			<td>{{ $data['kode'] }}</td>
        			<td>{{ date('d F Y', strtotime($data['tgl'])) }}</td>
        			<td>{{ $data['keterangan'] }}</td>
        			<td>@currency($data['keluar'])</td>
              @if(Auth::check())
        			<td>
        				<button type="button" class="btn btn-sm btn-danger" title="Hapus" onClick="hapus('{{ $data->kode }}')"><i class="fa fa-trash"></i></button>
        			</td>
              @endif
        		</tr>
        		@endforeach
        	</tbody>
        	<tfoot>
        		<tr>
        			<th colspan="4">Total Kas Keluar</th>
        			<th>@currency($jumlah)</th>
              @if(Auth::check())
        			<th></th>
              @endif
        		</tr>
        	</tfoot>
        </table>
        <br>
        <i>TTD. Bendahara DKM Al-Kautsar ( Joko Setyawan, Muhammad Machbub Marzuqi )</i>
    </div>
</div>

<div class="modal fade" id="modal-success">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Buat Data Keluar Baru</h4>
      </div>
      <form role="form" id="form-create">
	      <div class="modal-body">
	      	<input type="hidden" name="jenis" value="keluar">
        	<div class="form-group">
              <label for="kode">Kode</label>
              <input type="text" class="form-control" name="kode" id="kode" placeholder="Kode Transaksi">
            </div>
            <div class="form-group">
              <label for="keterangan">Keterangan</label>
              <textarea class="form-control" name="keterangan" id="keterangan"></textarea>
            </div>
            <div class="form-group">
              <label for="tanggal">Tanggal</label>
              <input type="date" class="form-control" name="tanggal" id="tanggal">
            </div>
            <div class="form-group">
              <label for="jumlah">Jumlah</label>
              <input type="number" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah Transaksi">
            </div>
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-success btn-sm pull-left" >Simpan</button>
	        <button type="button" class="btn btn-sm" data-dismiss="modal">Close</button>
	      </div>
	  </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

@endsection

@push('scripts')

<script type="text/javascript">
	$('#form-create').submit( function (e) {
		e.preventDefault();
		$.ajax({
			url: "{{ URL::to('/') }}/kas/store",
			type: "POST",
			dataType: "JSON",
			data: $(this).serialize(),
			success: function ( response )
			{
				if(response.success == 1)
				{
					location.reload();
				}
			},
			error: function ( error )
			{
				console.log( error );
			}
		});
	});
	function hapus(kode)
	{
		var tanya = confirm("Yakin hapus transaksi ini?");
		if (tanya) {
			$.ajax({
				url: "{{ URL::to('/') }}/kas/delete",
				type: "POST",
				dataType: "JSON",
				data: {
					kode: kode
				},
				success: function ( response )
				{
					if(response.success == 1)
					{
						location.reload();
					}
				},
				error: function ( error )
				{
					console.log( error );
				}
			});
		}
	}
</script>

@endpush
