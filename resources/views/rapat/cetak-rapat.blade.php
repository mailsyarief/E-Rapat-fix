
@include('layouts.css')

<style type="text/css">
	tbody, td, tr{
		border: 1px solid #333333;
	}
</style>
{{-- <textarea id="edit">{{$rapat->isi}}</textarea> --}}
@php
function indonesian_date ($timestamp = '', $date_format = 'l, j F Y | H:i', $suffix = 'WIB') {
    if (trim ($timestamp) == '')
    {
            $timestamp = time ();
    }
    elseif (!ctype_digit ($timestamp))
    {
        $timestamp = strtotime ($timestamp);
    }
    # remove S (st,nd,rd,th) there are no such things in indonesia :p
    $date_format = preg_replace ("/S/", "", $date_format);
    $pattern = array (
        '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
        '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
        '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
        '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
        '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
        '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
        '/April/','/June/','/July/','/August/','/September/','/October/',
        '/November/','/December/',
    );
    $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
        'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
        'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
        'Januari','Februari','Maret','April','Juni','Juli','Agustus','Sepember',
        'Oktober','November','Desember',
    );
    $date = date ($date_format, $timestamp);
    $date = preg_replace ($pattern, $replace, $date);
    $date = "{$date} {$suffix}";
    return $date;
} 
@endphp
<div class="container">
<center>
	<br>
	<table class="table table-bordered">
	  <tr>
	    <th width="25%">Judul</th>
	    <th>Tempat</th>
	    <th>Waktu</th>
	    <th>Level</th>
	  </tr>
	  <tr>
	    <td>{{$data['rapat']->title}}</td>
	    <td>{{$data['rapat']->tempat}}</td>
	    <td><?php
		    $timestamp = $data['rapat']->waktu;
			echo indonesian_date ($timestamp, 'j M  Y - H:i', 'WIB');
	    ?></td>
	    <td>{{$data['rapat']->level}}</td>
	  </tr>
	</table>
	<table class="table table-bordered">
	  <tr>
	    <th width="10%">Peserta</th>
	    <td>
	    	<ol class="list-inline ml-3">
	    	@foreach($data['peserta'] as $peserta)
			  <li class="list-inline-item">{{$peserta->name}},</li>
	    	@endforeach
	    	</ol>
	    </td>
	    <th width="10%">Notulen</th>
	    <td>
	    	<ol class="list-inline ml-3">
	    	@foreach($data['peserta'] as $peserta)
	    		@if($peserta->peserta_aktif == 1)
			  		<li class="list-inline-item">{{$peserta->name}}</li>
			  	@endif
	    	@endforeach
	    	</ol>	    
	    </td>
	  </tr>		
	</table>
</center>
<hr>
@php
	echo $data['rapat']->isi;
@endphp
</div>


<script src="{{ asset('js/lib/jquery/jquery-3.2.1.min.js') }}"></script>


<script>
        $(function(){
        	window.print();
        });    
</script>
