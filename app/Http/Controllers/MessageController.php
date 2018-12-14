<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Rapat_User;
use App\Rapat;
use App\User;
use App\Notifications\Message;


class MessageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('notification');
    }

	public function notify()
	{
	    $user = User::find(1);
	    $user->notify(new Message($user));
	    // $user = Rapat_User::find($user_id);
	    // $user->notify(new Message($user));
	}

	public function readNotification($email)//($title)////
	{
		$user = User::where('email', $email)->first();
		//$user = Rapat::where('title', $title)->first();
		$user->unreadNotifications()->update(['read_at' => now()]);
		return redirect('/');
	}
}
