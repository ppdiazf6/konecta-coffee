<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use DB;

/**
 * 
 */
class Productos extends Model
{
	
	protected $table = 'Productos';
	#
	#
	#
	protected $primaryKey = 'id';
	#
	protected $status_product = 'estado_producto';
		//
	#
	public function scopeListActiveProducts($builder)
	{
		$builder->where($this->table.'.'.$this->status_product, '=', 1);
		// code...
		return $builder->get();
	}
	public function scopeGetDataCourse($builder, $code)
	{
		$builder->where('codigo', 'LIKE', $code.'%');
		$builder->where('id_estado', '=', 1);
		$builder->orderBy('id_curso', 'desc');
		
		return $builder->first();
	}
	//	Relations
	public function ventas()
    {
    	return $this->belongsTo('App\Models\Ventas', 'id_venta', 'id_venta');
    }
}


?>