@extends('layouts.app')
@section('content')

    
    <a class="btn btn-sm mb-2" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fa fa-angle-down mr-1"></i> Informasi Rapat</a>
    @if(Auth::user()->id == $data['rapat']->creator_id)
        <a class="btn btn-sm btn-secondary mb-2" href="{{ url('edit-rapat/'.$data['rapat']->id) }}"><i class="fa fa-edit mr-1"></i> Edit Rapat</a>
    @endif
    <a class="btn btn-sm btn-warning mb-2" target="_blank" href="{{ url('cetak-rapat/'.$data['rapat']->id) }}"><i class="fa fa-print mr-1"></i> Cetak Rapat</a>
 	<article class="panel">
 		<div class="panel-heading" role="tab" id="headingOne">
		</div>
		<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
        <div class="box-typical box-typical-padding">
		<div class="panel-collapse-in">
        <div class="row">
    	<div class="col-md-6">
    		<div class="form-group">
    			<label class="mb-2">Judul Rapat</label>
    			<input class="form-control" type="text" name="title" value="{{$data['rapat']->title}}" required="" readonly="">
    		</div>
    		<div class="form-group">
    			<label class="mb-2">Level Rapat</label>
				<input class="form-control" type="text" name="level" value="{{$data['rapat']->level}}" required="" readonly="">
    		</div>
    		<div class="form-group">
    			<label class="mb-2">Waktu Rapat</label>
                <input class="form-control" type="text" name="waktu" value="{{$data['rapat']->waktu}}" required="" readonly="">
    		</div>
    		<div class="form-group">
    			<label class="mb-2">Tempat Rapat</label>
    			<input class="form-control" type="text" name="tempat" value="{{$data['rapat']->tempat}}" required="" readonly="">    			
    		</div>
    	</div>
    	<div class="col-md-6">
            <div class="form-group">
                <label class="mb-2">Peserta</label>
    			<select class="select2 form-control disabled" multiple="multiple" name="peserta[]" required="">
                    @foreach($data['peserta'] as $peserta)
                    	@if($peserta->peserta_aktif == 0)
                        	<option data-icon="font-icon-home" selected="" value="{{$peserta->id}}">{{$peserta->name}}</option>
                        @endif
                    @endforeach
    			</select>
            </div>
            <div class="form-group">
                <label class="mb-2">Notulen</label>
    			<select class="select2 form-control disabled" multiple="multiple" name="notulen[]" required="">
                    @foreach($data['peserta'] as $peserta)
                    	@if($peserta->peserta_aktif == 1)
                        	<option data-icon="font-icon-home" selected="" value="{{$peserta->id}}">{{$peserta->name}}</option>
                        @endif
                    @endforeach
    			</select>
            </div>      
            <div class="form-group">
                <label class="mb-2">Tags</label>
                <textarea id="tags-editor-textarea" rows="1" class="form-control" name="tags" readonly="">{{$data['rapat']->tag}}</textarea>
            </div>
            <div class="form-group">
                <br>
                <button id="btnGroupDrop1" type="button" class="btn btn-default-outline dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Attachment</button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    @foreach($data['rapat']->att as $att)
                        <a class="dropdown-item" href="{{ url('att-download/'.$att->id) }}">{{ $att->at_title }}</a>
                    @endforeach
                </div>                
            </div>            
    	</div>
    </div>
    </div>
	</div>
    <button id="bn-success" type="button" class="btn btn-success fade hidden">Success</button>
    </article>
</div>
<div class="box-typical box-typical-padding">
    <form action="/manualsave-notulensi" method="POST">
    @csrf
    <input type="hidden" name="rapat_id" value="{{ $data['rapat']->id }}">
	<div class="summernote-theme-1">
        @if( $data['rapat']->lock == 1 )
            <small class="text-muted mb-3">Rapat Selesai</small>
        @endif        
		<textarea class="summernote" rows="10" name="isi">{{$data['rapat']->isi}}</textarea>
        {{-- <textarea id="edit" name="isi">{{$data['rapat']->isi}}</textarea> --}}
        
	</div>
</div>
    @if(Auth::user()->role == 1)
        <input type="submit" class="btn btn-success float-right" name="" value="simpan">        
    @endif
    @foreach($data['notulen'] as $notulen)
        @if($notulen->peserta_aktif == 1 && $data['rapat']->lock == 0 && Auth::user()->role == 0)
            <button type="submit" class="btn btn-success float-right"><i class="fa fa-save"></i> Simpan</button>
            {{-- <input type="submit" class="btn btn-success float-right" name="" value="simpan"> --}}
        @endif
    @endforeach    
    </form>
@foreach($data['notulen'] as $notulen)
    <input id="isnotulen" type="hidden" class="" value="{{ $notulen->peserta_aktif }}">
@endforeach

<script src="{{ asset('js/lib/jquery/jquery-3.2.1.min.js') }}"></script>


<script>

        $(function(){
          $('#edit').froalaEditor({
            toolbarStickyOffset: 100,
            height: 500
          }).on('froalaEditor.image.beforeUpload', function (e, editor, files) {
            if (files.length) {
              // Create a File Reader.
              var reader = new FileReader();
         
              // Set the reader to insert images when they are loaded.
              reader.onload = function (e) {
                var result = e.target.result;
                editor.image.insert(result, null, null, editor.image.get());
              };
              
              // Read image as base64.
              reader.readAsDataURL(files[0]);
            }

            editor.popups.hideAll();

            // Stop default upload chain.
            return false;
          });
          $('#getPDF-1').hide();
          $('#insertFile-1').hide();
          $('#insertVideo-1').hide();
          $('#print-1').hide();
        });

        // $('#edit').froalaEditor()
          

        var inactivityTime = function () {
        var isnotulen = $('#isnotulen').val();
        var t;
        window.onload = resetTimer;
        // DOM Events
        // document.onmousemove = resetTimer;
        document.onkeypress = resetTimer;

        function logout() {
            if(isnotulen == 1 && {!! $data['rapat']->lock !!} == 0){
                autosave();
                $('#bn-success').click();                
            }else {
                console.log('1');
            }
        }

        function resetTimer() {
            clearTimeout(t);
            t = setTimeout(logout, 5000)
            // 1000 milisec = 1 sec
        }
        };

	function autosave(){
        // var data = $('#edit').val();
        var data = $('.summernote').val();
		var token = $("[name='_token']").val();
		// var data = $('.summernote').val();
		$.ajax({
			type:'POST',
			url: "{!! URL::to('autosave-notulensi') !!}",
			dataType: 'JSON',
			data: {
                "_method": 'POST',
                "_token": token,
                "rapat_id" : {!! $data['rapat']->id !!},
                "isi" : data
			},
			success: function(return_value){
				if(return_value === "success"){
					console.log('1');
				}else if(return_value === "error"){
					console.log('0');
				}
			}
		});
	}

    $(document).ready(function() {
        var isnotulen = $('#isnotulen').val();
        inactivityTime();
        if(isnotulen == 1 && {!! $data['rapat']->lock !!} == 0 || {!! Auth::user()->role !!} == 1){
            $('.summernote').summernote({
                height : "500px",
                maxHeight : null,
                focus: true,
                placeholder: 'write here...',
                maximumImageFileSize: 324288,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'hr']],
                    ['view', ['fullscreen', 'codeview','print']],
                    ['help', ['help']]
                  ],
                popover: {
                  image: [
                    ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                    ['float', ['floatLeft', 'floatRight', 'floatNone']],
                    ['remove', ['removeMedia']]
                  ],
                  link: [
                    ['link', ['linkDialogShow', 'unlink']]
                  ],
                  air: [
                    ['color', ['color']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['para', ['ul', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']]
                  ]
                },
                print:{
                    'stylesheetUrl': 'url_of_stylesheet_for_printing'
                }
            });            
        }else{
            $('.summernote').summernote('disable');  
        }        
    });

    $('#bn-success').on('click', function() {
        $.notify({
            icon: 'font-icon font-icon-check-circle',
            title: '<strong> Notul Tersimpan!</strong>',
            message: ''
        },{
            type: 'success'
        });
    });
    
    </script>
@endsection