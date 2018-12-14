<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Rapat extends Model
{
    //
    use Notifiable;
    
    protected $fillable = [
      'title','tempat','waktu','level','tag',
      'lock','isi','creator_id','isprivate'
    ];

    public function Att(){
    	return $this->hasMany('App\Attachment', 'rapats_id', 'id');
    }

    public function User(){
    	return $this->belongsToMany('App\User')->withPivot('peserta_aktif');
    }

}
