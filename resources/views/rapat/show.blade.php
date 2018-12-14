@extends('layouts.app')

@section('content')
{{-- @if(Rapat::where('id', Input::get('id'))->exists()) --}}
<?php 
    //$id= $_GET['id'];
    //$rapat = DB::table('rapats')->where('id','=',$rapat->id)->exists();
    $rapat = DB::table('rapats')->where('id','=',$id)->first();
?>
@if($rapat)
<a href="{{ url('/notulensi/'.$rapat->id) }}" class="btn btn-sm btn-info m-2"><i class="fa fa-book mr-2"></i>Lihat Rapat</a>
<div class="box-typical box-typical-padding">
    @if (session('error'))
        <div class="alert alert-warning">
            {{ session('error') }}
        </div>
    @endif 
    <div>
    	<p>
    		<pre>Dengan Hormat,
    		<pre>Sehubungan dengan diadakannya rapat {{ $rapat->title}} dengan tingkat {{ $rapat->level}}. Kami mengundang Saudara untuk dapat menghadiri rapat tersebut yang akan diadakan pada :
    		<pre>Tanggal : {{ $rapat->waktu }} 
    		<pre>Tempat	: {{ $rapat->tempat }} 
    		<pre>Demikianlah undangan ini kami buat, diharapkan Saudara dapat hadir dalam acara tersebut. Atas perhatian dan partisipasinya kami mengucapkan terimakasih.
    	</p>       
    </div>  
</div>
@else
<h2 style="text-align: center">Pemberitahuan</h2>
<p>Undangan rapat telah dihapus oleh administrator atau pembuat rapat. Silahkan menghubungi administrator sistem. Terimakasih.</p>
@endif
@endsection
