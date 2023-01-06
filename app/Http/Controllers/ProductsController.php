<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use App\Models\Productos as ProductosModel;
use App\Models\Categorias as CategoriasModel;


use Validator;

/**
 * 
 */
class ProductsController extends Controller
{
	
	function __construct()
	{
		#...
		#$this->middleware('auth');
	}
		#
	public function index()
	{

		$list_products = ProductosModel::ListActiveProducts();
			
		#
			
		return view('products', compact('list_products'));
	}
		#...
	public function create()
	{
		$list_categories = CategoriasModel::ListActiveCategories();
				
		return view('product-create', compact('list_categories'));
	}
		#...
	public function store(Request $request)
	{
		
		#dd($request->all());
				
		//	Validación
		$validator = Validator::make($request->all(), [
				
				'categoria' => 'required',
				'nombre_producto' => 'required|min:3|max:100',
				'referencia' => 'required|min:3|max:100',
				'precio' => 'required|int',
				'peso' => 'required|int',
				'stock' => 'required'
				
			]);
			#
			
			#dd($request->hasFile($file_input));
		try
		{
			#
			
			if ( $validator->fails() )
			{
				
				throw new \Exception($validator->errors()->first());
			}
			
			
			
			
			//	Busca si el alumno se encuentra registrado 
			$nombre_curso = $request->nombre_curso;
			#$
			
			
			//  Registra nuevo producto 
			
				# code...
				$product_row = new ProductosModel();
					
					$product_row->nombre_producto = $request->nombre_producto;
					$product_row->referencia = $request->referencia;
					$product_row->precio = $request->precio;
					$product_row->peso = $request->peso;
					$product_row->id_categoria = $request->categoria;
					$product_row->stock = $request->stock;
					$product_row->estado_producto = 1;
					//...
					
			if ( ! $product_row->save() )
			{
				throw new \Exception('Error al registrar producto');
			}
			
					
			
			return redirect('products')->with('success', 'Producto guardado correctamente');
			
			#$
		}
		catch (\Exception $e)
		{
			#dd('Erroooor');
			return abort(404, $e->getMessage());#back()->with('mensaje', 'Error al registrar el producto');
		}
			
		#return redirect();
	}
		#
	public function show($id_product)
	{
		$product_row = ProductosModel::find($id_product);
		
		$list_categories = CategoriasModel::ListActiveCategories();
		
		#
		
		return view('product-edit', compact(
												'list_categories', 
												'product_row'
											)
					);
	}
		#...
	public function update(Request $request)
	{
		try
		{
			$IdProducto = $request->id_producto;
				
			$product_row = ProductosModel::find($IdProducto);
			
				$product_row->id_categoria = $request->categoria;
				$product_row->nombre_producto = $request->nombre_producto;
				$product_row->referencia = $request->referencia;
				$product_row->precio = $request->precio;
				$product_row->peso = $request->peso;
				$product_row->stock = $request->stock;
			
			if ( ! $product_row->save() ) {
				throw new \Exception('Error al actualizar el registro');
			}
				
			return back()->with('success', 'Producto actualizado correctamente');
		}
		catch (\Exception $e)
		{
			return abort(404, $e->getMessage());
		}
			
	}
			
		#...
	public function delete($id_product)
	{
		try
		{
			$product_row = ProductosModel::find($id_product);
			$product_row->delete();
			
			return back()->with('success', 'Pedido eliminado correctamente');
		}
		catch (\Exception $e)
		{
			return abort(404, $e->getMessage());
		}
			
		return redirect('products');
	}
}

 ?>