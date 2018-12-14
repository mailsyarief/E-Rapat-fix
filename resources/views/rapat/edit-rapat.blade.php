@extends('layouts.app')

@section('content')
<a class="btn btn-sm btn-info m-2" href="{{ url('/notulensi/'.$data['rapat']->id)}}"><< Back</a>
<div class="box-typical box-typical-padding">
    <div>
        <center>
          <h3>Edit Rapat : {{$data['rapat']->title}}</h3>  
        </center>
    </div>
    
    @if (session('error'))
        <div class="alert alert-warning">
            {{ session('error') }}
        </div>
    @endif
    
    <form action="{{ url('/edit-rapat') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input class="form-control" type="hidden" name="id_rapat" value="{{ $data['rapat']->id }}" required="">
        <div class="row">
        <div class="col-md-6 col-lg-6">
            <div class="form-group">
                <label class="mb-2">Judul Rapat</label>
                <input id="title" class="form-control" type="text" name="title" value="{{ $data['rapat']->title }}" required="">
            </div>
            <div class="form-group">
                <label class="mb-2">Waktu Rapat</label>
                <input id="flatpickr" class="form-control" data-enable-time="true" name="waktu" value="{{ $data['rapat']->waktu }}" required="">
            </div>
            <div class="form-group">
                <label class="mb-2">Tempat Rapat</label>
                <input id="tempat" class="form-control" type="text" name="tempat" value="{{ $data['rapat']->tempat }}" required="">             
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="form-group">
                <label class="mb-2">Level Rapat</label>
                <select id="level" class="select2 select2-arrow manual select2-no-search-arrow" name="level" required="">
                    <option></option>
                    <option value="Fakultas" {{ $data['rapat']->level == "Fakultas" ? 'selected' : ''}}>Fakultas</option>
                    <option value="Departemen" {{$data['rapat']->level == "Departemen" ? 'selected' : ''}}>Departemen</option>
                    <option value="Prodi" {{$data['rapat']->level == "Prodi" ? 'selected' : ''}}>Prodi</option>
                    <option value="RMK" {{$data['rapat']->level == "RMK" ? 'selected' : ''}}>RMK</option>
                </select>
            </div>
            <div class="form-group">
                <label class="mb-2">Tags</label>
                <textarea id="tags-editor-textarea" rows="1" class="form-control" name="tags">{{ $data['rapat']->tag }}</textarea>
            </div>           
            <div class="checkbox-toggle">
                <input type="checkbox" id="check-toggle-1" {{ $data['rapat']->isprivate == 1 ? 'checked="" ' : '' }}/>
                <label for="check-toggle-1">Private</label>
                <input type="hidden" name="isprivate" id="isPrivate" value="{{ $data['rapat']->isprivate }}">
            </div>
        </div>
        <hr>

    </div>      
    <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-edit mr-1"></i> Update Rapat</button>
    </form>
</div>
<div class="row">
    <div class="col-md-6">
<div class="box-typical box-typical-padding">
    <div>
        <center>
          <h3>Peserta Rapat</h3>  
        </center>
    </div>
    <button type="button" class="btn btn-info btn-sm m-2" data-toggle="modal" data-target="#addPesertaModalCenter"><i class="fa fa-plus mr-1"></i> Peserta</button>
    <table id="example" class="display table table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['peserta'] as $peserta)
            <tr>
                <td>{{ $peserta->name }}</td>
                <td>{{ $peserta->jabatan }}</td>
                <td>@if($peserta->peserta_aktif == 1) Notulen @else Peserta @endif</td>
                <td>
                    <form action="{{ url('/delete_peserta') }}" method="POST">
                    @csrf
                        <input type="hidden" name="user_id" value="{{$peserta->user_id}}">
                        <input type="hidden" name="rapat_id" value="{{$peserta->id}}">
                        {{-- @if($peserta->user_id != $data['rapat']->creator_id) --}}
                            <input type="submit" class="btn btn-sm btn-warning" value="Delete">
                        {{-- @endif --}}
                    </form>
                </td>
            </tr>                
            @endforeach
        </tbody>
    </table>
</div>        
</div>
    <div class="col-md-6">
        <div class="box-typical box-typical-padding">
        <div>
            <center>
              <h3>Berkas Rapat</h3>  
            </center>
        </div>            
        <button type="button" class="btn btn-info btn-sm mb-3" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-plus mr-1"></i> Attachment</button>
        <table id="example2" class="display table table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Attachment</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['att'] as $att)
                <tr>
                    <td>{{$att->at_title}}</td>
                    <td>
                        <form action="{{ url('/delete_att') }}" method="POST">
                            @csrf
                            <input type="hidden" name="att_id" value="{{$att->id}}">
                            <input type="hidden" name="rapat_id" value="{{$att->rapats_id}}">
                            <input type="submit" class="btn btn-sm btn-warning" value="Delete">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>        
        </div>        
    </div>
</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Attachment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ url('add_att') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="rapats_id" value="{{ $data['rapat']->id }}">
            <div class="form-group"><br>
                <label class="mb-2">Attachment</label>
                <input type="file" class="form-control" name="filename[]" multiple="">
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addPesertaModalCenter" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Peserta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ url('add_peserta') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="rapats_id" value="{{ $data['rapat']->id }}">
            <div class="form-group"><br>
                <label>Nama Peserta</label>
                <select class="select2-arrow" name="peserta">
                    @foreach($data['user'] as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group"><br>
                <label>Role</label>
                <select class="select2-arrow" name="peserta_aktif">
                    <option value="0">Peserta</option>
                    <option value="1">Notulen</option>
                </select>
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>


    <script src="{{ asset('js/lib/jquery/jquery-3.2.1.min.js') }}"></script>

    <script type="text/javascript">

    $(function() {
        $('#example').DataTable({
            responsive: true
        });

        $('#example2').DataTable({
            responsive: true
        });        
    });


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
                        $("#peserta option[value='" + return_value['peserta'][i].id + "']").prop("selected", true);
                        $("#form-group-peserta span span span ul").append('<li class="select2-selection__choice" title="'+return_value['peserta'][i].name+'"><span class="select2-selection__choice__remove" role="presentation">×</span>'+ return_value['peserta'][i].name +'</li>')
                    }
                    else{
                        $("#notulen option[value='" + return_value['peserta'][i].id + "']").prop("selected", true);
                        $("#form-group-notulen span span span ul").append('<li class="select2-selection__choice" title="'+return_value['peserta'][i].name+'"><span class="select2-selection__choice__remove" role="presentation">×</span>'+ return_value['peserta'][i].name +'</li>')
                    }
                });
            }
        });
    }        
    </script>


@endsection
