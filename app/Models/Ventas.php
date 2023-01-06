<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use DB;

/**
 * 
 */
class Ventas extends Model
{
	
	protected $table = 'Ventas';
	#
	#
	#
	protected $primaryKey = 'id_venta';
	#
	protected $status_sale = 'estado_venta';
		//
	#
	
	public function scopeListSales($builder)
	{
		$builder->orderBy('id_venta', 'desc');
		// code...
		
		return $builder->get();
	}
		#
	public function scopeMayorVentas($builder)
	{
		$builder->select(DB::raw( 'ventas.id_producto, SUM(ventas.cantidad) AS TotalVentas' ));
		$builder->groupBy('ventas.id_venta');
		$builder->orderBy('TotalVentas', 'desc');
		return $builder->first();
		#SELECT ventas.id_producto, SUM(ventas.cantidad) AS TotalVentas
		#FROM ventas
		#GROUP BY ventas.id_venta
		#ORDER BY SUM(ventas.cantidad) DESC
		#LIMIT 0 , 30;
	}
	
	//	Relations
	public function productos()
	{
		return $this->belongsTo('App\Models\Productos', 'id_producto', 'id');
		# code...
	}
}


?>