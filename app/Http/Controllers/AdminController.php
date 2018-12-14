<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
Use \DB;
use App\Rapat;
use App\User;
use App\Rapat_User;
use App\Attachment;
use \Auth;
use \Session;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role');
        $this->middleware('notification');
    }

    public function kelola_akun(){
    	$data = [
    		'user' => User::all()
    	];
    	return view('admin.kelola-akun')->with('data', $data);
    }

    public function switch_back(Request $request){
        $session = session('admin_session');
        Session::forget('admin_session');
        Auth::loginUsingId($session);
        return redirect('/kelola-akun');
    }

    public function login_as_akun(Request $request){
        Session::put('admin_session', $request->admin_id);
        Auth::loginUsingId($request->user_id);
        return redirect('/');
    }

    public function enable_akun(Request $request){
        $user = User::find($request->user_id);
        $user->isdisable = $request->isdisable;
        $user->save();

        return redirect()->back();
    }

    public function disable_akun(Request $request){
        $user = User::find($request->user_id);
        $user->isdisable = $request->isdisable;
        $user->save();

        return redirect()->back();
    }

    public function update_akun(Request $request){
        // dd($request);
        
        DB::beginTransaction();
        try {

            $id = $request->id;
            $user = User::find($id);
            $user->name = $request->username;
            $user->nik = $request->nik; 
            $user->email = $request->email; 
            $user->nik = $request->nik;
            $user->jabatan = $request->jabatan;
            $user->role = $request->role;
            
            if($request->password){
                $pass = Hash::make($request->password);
                $user->password = $pass;
            } 

            $user->save();

            DB::commit(); 
            
        } catch (Exception $e) {
            DB::rollback();
        }


        return redirect()->back();
    }    

    
}
