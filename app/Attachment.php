<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Rapat;

class Attachment extends Model
{
    //
	protected $table = 'attachments';

    protected $fillable = [
        'rapats_id','at_title','at_path',
    ];

    public function Rapat(){
    	return $this->belongsTo('App\Rapat', 'rapats_id');
    }
}
