@extends('layouts.app')

@section('content')

@isset($rapat_saya)
    <a href="{{ url('/') }}" class="btn btn-sm btn-info m-2"><i class="fa fa-book mr-2"></i>Seluruh Rapat</a>
@else
    <a href="{{ url('/rapat-saya') }}" class="btn btn-sm btn-info m-2"><i class="fa fa-book mr-2"></i>Rapat Saya</a>
@endif

<div class="box-typical box-typical-padding">
    <div>
        <center>
            @isset($rapat_saya)
                <h3>Rapat Saya</h3>  
            @else
                <h3>Daftar Rapat</h3>  
            @endif
        </center>
    </div>
    @if (session('error'))
        <div class="alert alert-warning">
            {{ session('error') }}
        </div>
    @endif 
    <div>
        <table id="example" class="display table table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Waktu</th>
                    <th>Tempat</th>
                    <th>Level</th>
                    <th>Action</th>
                </tr>
            </thead>
                <tfoot>
                <tr>
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th>Tempat</th>
                    <th>Level</th>
                    <th>Action</th>
                </tr>
                </tfoot>
            <tbody>
                @foreach($rapats as $rapat)
                <tr>
                    <td><a href="{{ url('/notulensi/'. $rapat->id) }}">{{$rapat->title}}</a></td>
                    <td>{{$rapat->waktu}}</td>                    
                    <td>{{$rapat->tempat}}</td>
                    <td>{{$rapat->level}}</td>
                    <th>
                        @if($rapat->creator_id == Auth::id())
                            <form action="{{ url('/delete') }}" method="POST">
                                @csrf
                                <input type="hidden" name="user_id" value="{{Auth::id()}}">
                                <input type="hidden" name="rapat_id" value="{{$rapat->id}}">
                                <input type="submit" class="btn btn-sm btn-warning" value="Delete">
                            </form>
                        @endif
                    </th>
                </tr>
                @endforeach
            </tbody>
        </table>        
    </div>  
</div>

<script src="js/lib/jquery/jquery-3.2.1.min.js"></script>

<script>
    $(function() {
        $('#example').DataTable({
            responsive: true
        });
    });

            $('.swal-btn-cancel').click(function(e){
                e.preventDefault();
                swal({
                            title: "Hapus Rapat?",
                            text: "Rapat akan terhapus secara permanen!",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "Ya, Saya yakin!",
                            cancelButtonText: "Tidak Jadi!",
                            closeOnConfirm: false,
                            closeOnCancel: false
                        },
                        function(isConfirm) {
                            if (isConfirm) {
                                swal({
                                    title: "Deleted!",
                                    text: "Rapat berhasil dihapus.",
                                    type: "success",
                                    confirmButtonClass: "btn-success"
                                }
                                );
                            } else {
                                swal({
                                    title: "Cancelled",
                                    text: "Gak Jadiii :)",
                                    type: "error",
                                    confirmButtonClass: "btn-danger"
                                });
                            }
                        });
            });    
</script>



@endsection
