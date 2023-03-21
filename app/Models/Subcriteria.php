<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcriteria extends Model
{
    use HasFactory;
	protected $fillable = ['criteria_id', 'keterangan', 'bobotsub'];
	
	public function scopeSearch($query){
		if (request('search')){
			return $query->where('keterangan', 'like', '%' . request ('search') . '%')
				->orWhere('bobotsub', 'like', '%' . request ('search') . '%');
		}
	}

	public function subcriterias(){
		return $this->belongsTo(Criteria::class, 'criterias', 'criteria_id');
	}
}
