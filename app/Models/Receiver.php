<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receiver extends Model
{
    use HasFactory;
	protected $fillable = ['nik', 'nama', 'alamat', 'rt', 'rw'];
	
	public function scopeSearch($query){
		if (request('search')){
			return $query->where('nama', 'like', '%' . request ('search') . '%')
				->orWhere('nik', 'like', '%' . request ('search') . '%');
		}
	}

	public function criterias(){
		return $this->belongsToMany(Criteria::class, 'scores', 'receiver_id', 'criteria_id')->withPivot('nilai');
	}
	
}
