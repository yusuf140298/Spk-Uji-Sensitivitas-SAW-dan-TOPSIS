<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;
	protected $fillable = ['receiver_id', 'criteria_id', 'subcriteria_id', 'nlai'];

	public function scopeSearch($query){
		if (request('search')){
			return $query->where('nama', 'like', '%' . request ('search') . '%')
				->orWhere('kriteria', 'like', '%' . request ('search') . '%');
		}
	}
}
