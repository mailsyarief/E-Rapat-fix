<?php

namespace App;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;

class Rapat_User extends Model
{
    //
	use Notifiable;

    protected $table = 'rapat_user';

    protected $fillable = [
    	'user_id','rapat_id','peserta_aktif'
    ];

    public $timestamps = false;
}
