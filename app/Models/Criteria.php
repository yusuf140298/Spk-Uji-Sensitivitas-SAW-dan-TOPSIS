<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;
	protected $fillable = ['kriteria', 'bobot', 'jenis'];

	public function scopeSearch($query){
		if (request('search')){
			return $query->where('kriteria', 'like', '%' . request ('search') . '%')
				->orWhere('bobot', 'like', '%' . request ('search') . '%')
				->orWhere('jenis', 'like', '%' . request ('search') . '%');
		}
	}
	
	public function receivers(){
		return $this->belongsToMany(Receiver::class, 'scores', 'criteria_id', 'receiver_id' );
	}
	
}
