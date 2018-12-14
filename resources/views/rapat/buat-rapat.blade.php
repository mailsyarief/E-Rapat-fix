@extends('layouts.app')

@section('content')
<a class="btn btn-sm mb-2" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fa fa-angle-down mr-1"></i> Template Rapat</a>
    <article class="panel">
        <div class="panel-heading" role="tab" id="headingOne">
        </div>
        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
        <div class="box-typical box-typical-padding">
        <div class="panel-collapse-in">
        <div class="row">
            <div class="col-9">
            <select id="templateRapat" class="select2" name="rapat_id">
                @foreach($rapat_saya as $rapat)
                    <option value="{{$rapat->id}}">{{$rapat->title}}</option>
                @endforeach
            </select>                            
            </div>
            <div class="col-3">
                <button id="gunakanTemplate" class="btn btn-warning"><i class="fa fa-clone mr-1"></i> Gunakan</button>
            </div>
        </div>
        </div>
        </div>
        <button id="bn-success" type="button" class="btn btn-success fade hidden">Success</button>
    </article>
<div class="box-typical box-typical-padding">
    <div>
        <center>
          <h3>Rapat Baru</h3>  
        </center>
    </div>
    
    @if (session('error'))
        <div class="alert alert-warning">
            {{ session('error') }}
        </div>
    @endif
    
    <form action="{{ url('/new-rapat') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
    	<div class="col-md-6 col-lg-6">
    		<div class="form-group">
    			<label class="mb-2">Judul Rapat</label>
    			<input id="title" class="form-control" type="text" name="title" value="" required="">
    		</div>
    		<div class="form-group">
    			<label class="mb-2">Waktu Rapat</label>
                <input id="flatpickr" class="form-control" data-enable-time="true" data-time_24hr="true" name="waktu" value="" required="">
    		</div>
    		<div class="form-group">
    			<label class="mb-2">Tempat Rapat</label>
    			<input id="tempat" class="form-control" type="text" name="tempat" value="" required="">    			
    		</div>
            <div class="form-group">
                <label class="mb-2">Tags</label>
                <textarea id="tags-editor-textarea" rows="1" class="form-control" name="tags"></textarea>
            </div>           
    	</div>
    	<div class="col-md-6 col-lg-6">
            <div class="form-group">
                <label class="mb-2">Level Rapat</label>
                <select id="level" class="select2-arrow manual select2-no-search-arrow" name="level" required="">
                    <option></option>
                    <option value="Fakultas" {{ old('level') == "Fakultas" ? 'selected' : ''}}>Fakultas</option>
                    <option value="Departemen" {{old('level') == "Departemen" ? 'selected' : ''}}>Departemen</option>
                    <option value="Prodi" {{old('level') == "Prodi" ? 'selected' : ''}}>Prodi</option>
                    <option value="RMK" {{old('level') == "RMK" ? 'selected' : ''}}>RMK</option>
                </select>
            </div>  
            <div id="form-group-peserta" class="form-group">
                <label class="mb-2">Peserta</label>
    			<select id="peserta" class="select2 form-control" multiple="multiple" name="peserta[]" required="">
                    @foreach($user as $peserta)
                        <option data-icon="font-icon-home" value="{{$peserta->id}}">{{$peserta->name}}</option>
                    @endforeach
    			</select>
            </div>
            <div id="form-group-notulen" class="form-group">
                <label class="mb-2">Notulen</label>
                <select id="notulen" class="select2 form-control" multiple="multiple" name="notulen[]" required="">
                    @foreach($user as $notul)
                        <option data-icon="font-icon-home" value="{{$notul->id}}">{{$notul->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group"><br>
                <label class="mb-2">Attachment</label>
                <input type="file" class="form-control" name="filename[]" multiple="">
            </div>
            <div class="checkbox-toggle">
                <input type="checkbox" id="check-toggle-1"/>
                <label for="check-toggle-1">Private</label>
                <input type="hidden" name="isprivate" id="isPrivate" value="0">
            </div>
    	</div>
        <hr>

    </div>      
</div>
</div>
    @if(Auth::user()->isdisable == 0 OR Auth::user()->isdisable == NULL)
        <button class="btn btn-success float-right" type="submit"><i class="fa fa-plus mr-1"></i> Buat Rapat</button>
    @else
        <button class="btn btn-warning float-right" type="button"><i class="fa fa-ban mr-1"></i> Akun anda tidak aktif</button>
    @endif
    </form>

    <script src="js/lib/jquery/jquery-3.2.1.min.js"></script>

    <script type="text/javascript">

    $("#check-toggle-1").click(function() {
        if($("#check-toggle-1").is(':checked'))
            $('#isPrivate').val(1);
        else
            $('#isPrivate').val(0);
    });        
    </script>

    <script>
        $(function() {
            $('#tags-editor-textarea').tagEditor();

            $('#gunakanTemplate').click(function(){
                getTemplate();
            });
        });
    </script>

    <script type="text/javascript">
    function getTemplate(){
        // var data = $('#edit').val();
        var id = $('#templateRapat').val();
        $.ajax({
            type:'GET',
            url: "{!! URL::to('get-template') !!}" + "/" + id,
            dataType: 'JSON',
            success: function(return_value){
                $('#tempat').val(return_value['rapat']['tempat']);
                $('#title').val(return_value['rapat']['title']);
                $('#level').val(return_value['rapat']['level']).change();
                $.each(return_value['peserta'], function(i){
                    console.log(return_value['peserta'][i].id);
                    if(return_value['peserta'][i].peserta_aktif === 0){
                        // $("#peserta #poid"+return_value['peserta'][i].id).attr("selected","selected");
                        // var hehe = $("#peserta #poid"+return_value['peserta'][i].id).val();
                        // alert(hehe);
                        // $("#peserta option[value="+ return_value['peserta'][i].id + "]").attr("selected","selected");
                        var idnya = return_value['peserta'][i].id;
                        $("#peserta option[value="+ idnya +"]").attr("selected","selected");
                        $("#form-group-peserta span span span ul").append('<li class="select2-selection__choice" title="'+return_value['peserta'][i].name+'"><span class="select2-selection__choice__remove" role="presentation">×</span>'+ return_value['peserta'][i].name +'</li>')
                    }
                    else{
                        // $("#notulen option #noid"+return_value['peserta'][i].id).attr("selected","selected");
                        $("#notulen option[value=" + return_value['peserta'][i].id + "]").attr("selected","selected");
                        $("#form-group-notulen span span span ul").append('<li class="select2-selection__choice" title="'+return_value['peserta'][i].name+'"><span class="select2-selection__choice__remove" role="presentation">×</span>'+ return_value['peserta'][i].name +'</li>')
                    }
                });
            }
        });
    }        
    </script>


@endsection
