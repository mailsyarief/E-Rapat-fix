<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rapat;
use Illuminate\Support\Facades\Hash;
use App\User;
use View;
use Auth;
Use \DB;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('notification');
    }

    public function index(){
    	$data['user'] = Auth::user();
        $data['rapats'] = $data['user']->rapat;
        //$data['notifications'] = auth()->user()->notifications()->orderBy('created_at','desc')->get();
    	return view('home', $data);
    }

    public function rapat_saya(){
        $data['rapats'] = Rapat::where('creator_id', Auth::id())->get();
        $data['rapat_saya'] = 1;
        //$data['notifications'] = auth()->user()->notifications()->orderBy('created_at','desc')->get();
        // $data = Auth::user();
        // $rapat_saya = $data->rapat->where('creator_id',Auth::id());
        return view('home')->with($data);
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
