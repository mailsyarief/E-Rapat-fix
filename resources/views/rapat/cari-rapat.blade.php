@extends('layouts.app')

@section('content')

<div class="box-typical box-typical-padding">
    <div>
        <center>
          <h3>Cari Rapat</h3>    
        </center>
    </div>
    @if (session('error'))
        <div class="alert alert-warning">
            {{ session('error') }}
        </div>
    @endif    
	<div>
		<div class="fixed-table-toolbar">
			<form action="{{ url('/cari-rapat') }}" method="POST" enctype="multipart/form-data">
				@csrf
				<fieldset class="form-group">
					<label class="form-label semibold" for="exampleInput">Search</label>
					<input type="text" name="dicari" class="form-control" id="exampleInput" placeholder="Search">
					<small class="text-muted">Search by tag, name, or "isi rapat"</small>
					<input class="btn btn-success btn-rounded float-right" type="submit" value="Go"> 
				</fieldset>
			</form>
		</div>
		@if($flag == 1)
		<div class="fixed-table-container">
	        <table id="example" class="display table table-bordered" cellspacing="0" width="100%">
	            <thead>
	                <tr>
	                    <th>Judul</th>
	                    <th>Tanggal</th>
	                    <th>Tag</th>
	                    <th>Isi</th>
	                </tr>
	            </thead>
	                <tfoot>
	                <tr>
	                    <th>Judul</th>
	                    <th>Tanggal</th>
	                    <th>tag</th>
	                    <th>Isi</th>
	                </tr>
	                </tfoot>
	            <tbody>
	                @foreach($data as $data)
	                <tr>
	                    <td><a href="{{ url('/notulensi/'. $data->id) }}">{{$data->title}}</a></td>                    
	                    <td>{{$data->waktu}}</td>                    
	                    <td>{{$data->tag}}</td>
	                    <td>{{$data->isi}}</td>
	                </tr>
	                @endforeach
	            </tbody>
	        </table>      			
		</div>
		@endif    		
	</div>
</div>  

<script src="js/lib/jquery/jquery-3.2.1.min.js"></script>

@endsection
