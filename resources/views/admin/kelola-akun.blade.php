@extends('layouts.app')

@section('content')

<a href="{{ url('/register') }}" class="btn btn-sm btn-info m-2"><i class="fa fa-plus mr-2"></i>Tambah Akun</a>
<div class="box-typical box-typical-padding">
    <div>
        <center>
          <h3>Daftar Akun</h3>  
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
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Jabatan</th>
                    <th>Admin</th>
                    <th>Action</th>
                </tr>
            </thead>
                <tfoot>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Jabatan</th>
                    <th>Admin</th>
                    <th>Action</th>
                </tr>
                </tfoot>
            <tbody>
                @foreach($data['user'] as $data)
                <tr>
                    <td>{{$data->name}}</td>
                    <td>{{$data->email}}</td>                    
                    <td>{{$data->jabatan}}</td>
                    <td>{{$data->role}}</td>
                    <td>
                        <div class="form-inline">
                            @if($data->id != Auth::id())
                                <button class="btn btn-sm btn-warning mr-3" data-toggle="modal" data-target="#myModal{{$data->id}}"><i class="fa fa-edit mr-2"></i>Edit</button>
                                @if($data->isdisable == 0 OR $data->isdisable == NULL)
                                    <form action="{{ url('/disable-akun') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="isdisable" value="1">
                                        <input type="hidden" name="user_id" value="{{$data->id}}">
                                        <button type="submit" class="btn btn-sm btn-danger">Disable</button>
                                    </form>
                                @else
                                    <form action="{{ url('/enable-akun') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="isdisable" value="0">
                                        <input type="hidden" name="user_id" value="{{$data->id}}">
                                        <button type="submit" class="btn btn-sm btn-info">Enable</button>
                                    </form>                            
                                @endif
                                <form action="{{ url('/login-as-akun') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="admin_id" value="{{Auth::id()}}">
                                    <input type="hidden" name="user_id" value="{{$data->id}}">
                                    <button type="submit" class="btn btn-sm btn-secondary ml-3">Login As</button>
                                </form>
                            @endif
                        </div>
                        <div id="myModal{{$data->id}}" class="modal fade" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4>Edit Akun</h4>
                              </div>
                              <form action="{{ url('/update-akun') }}" method="POST">
                                @csrf
                              <div class="modal-body">
                                <input class="form-control" type="hidden" name="id" value="{{$data->id}}">
                                <div class="form-group">
                                    <label class="m-2">Nama</label>
                                    <input class="form-control" type="text" name="username" value="{{$data->name}}">
                                </div>
                                <div class="form-group">
                                    <label class="m-2">NIK</label>
                                    <input class="form-control" type="text" name="nik" value="{{$data->nik}}">
                                </div>
                                <div class="form-group">
                                    <label class="m-2">Email</label>
                                    <input class="form-control" type="text" name="email" value="{{$data->email}}">
                                </div>
                                <div class="form-group">
                                    <label class="m-2">Jabatan</label>
                                    <select id="status" class="form-control" name="jabatan">
                                        <option value="Tenaga Pengajar" {{$data->jabatan == "Tenaga Pengajar" ? 'selected' : '' }}>Tenaga Pengajar</option>
                                        <option value="Dosen" {{$data->jabatan == "Dosen" ? 'selected' : '' }}>Dosen</option>
                                    </select>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label class="m-2">Reset Password</label>
                                    <input class="form-control" type="password" name="password" value="" minlength="6">
                                </div>                                
                                <div class="form-group">
                                    <label class="m-2">isAdmin</label>
                                    <select id="status" class="form-control" name="role">
                                        <option value="1" {{$data->role == "1" ? 'selected' : '' }}>Admin</option>
                                        <option value="0" {{$data->jabatan == "0" ? 'selected' : '' }}>User</option>
                                    </select>
                                </div>
                              </div>
                              
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Save</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>                        
                    </td>
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
</script>

@endsection
