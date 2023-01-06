<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use DB;

/**
 * 
 */
class Categorias extends Model
{
	
	protected $table = 'categorias';
	#
	#
	#
	protected $primaryKey = 'id_categoria';
	#
	protected $status_category = 'estado_categoria';
		//
	#
	
	public function scopeListActiveCategories($builder)
	{
		$builder->where($this->table.'.'.$this->status_category, '=', 1);
		$builder->orderBy('nombre_categoria', 'asc');
		//
		return $builder->get();
	}
	
}


?>