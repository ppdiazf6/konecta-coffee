<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use App\Models\Ventas as VentasModel;
use App\Models\Productos as ProductosModel;
use App\Models\Categorias as CategoriasModel;


use Validator;

/**
 * 
 */
class SalesController extends Controller
{
	
	function __construct()
	{
		#...
		#$this->middleware('auth');
	}
		#
	public function index()
	{

		$list_sales = VentasModel::ListSales();
		$list_products = ProductosModel::ListActiveProducts();
			
		//	Producto con mayor stock
		$product_stock_name = null;
		$product_stock_count = null;
			
		//	Producto con más ventas
		$selling_product = VentasModel::MayorVentas();
		$selling_product_name = ProductosModel::find($selling_product->id_producto);
		$selling_product_count = null;
		#
		return view('sales', compact(
										'list_sales', 
										'list_products', 
										'product_stock_name', 'product_stock_count', 
										'selling_product', 'selling_product_name', 'selling_product_count'));
	}
		#...
	public function create()
	{
		$list_categories = CategoriasModel::ListActiveCategories();
				
		return view('product-create', compact('list_categories'));
	}
		#...
	public function process(Request $request)
	{		
		//	Validación
		$validator = Validator::make($request->all(), [
				
				'producto' => 'required',
				'cantidad' => 'required'
				
			]);
			
			
			
		try
		{
			#
			
			if ( $validator->fails() )
			{
				
				throw new \Exception($validator->errors()->first());
			}
			
			
			//	Datos
			$IdProducto = $request->producto;
			$Cantidad = $request->cantidad;
			
			
			$product_row = ProductosModel::find($IdProducto);
					
				//	Verifica el stock del producto 
				if ( $product_row->stock <= 0 )
				{
					return back()->with('success', 'No es posible realizar la venta, ya que no hay stock disponible.');
				}
			
			//  Registra nueva venta 
				$sales_row = new VentasModel();
					
					$sales_row->id_producto = $IdProducto;
					$sales_row->cantidad = $Cantidad;
					
					
			if ( ! $sales_row->save() )
			{
				throw new \Exception('Error al registrar venta');
			}
			
			//	Actualiza stock del producto
				$new_stock = $product_row->stock - $Cantidad;
					
			$product_row->stock = $new_stock;
				
			if ( ! $product_row-> save() ) {
				throw new \Exception('No se pudo actualizar el stock del producto');
				
			}
			
			return redirect('sales')->with('success', 'Venta exitosa');
			
			#$
		}
		catch (\Exception $e)
		{
			return back()->with('success', 'Error al registrar la venta');
		}
			
		
	}
			
		#
	
	
}

 ?>