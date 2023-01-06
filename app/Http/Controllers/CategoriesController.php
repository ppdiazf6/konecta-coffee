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
class CategoriesController extends Controller
{
	
	function __construct()
	{
		#...
		#$this->middleware('auth');
	}
		#
	public function index()
	{

		$list_categories = CategoriasModel::ListActiveCategories();
			
			
		return view('categories', compact('list_categories'));
	}
		
	
		
	public function store(Request $request)
	{
		//	Validación
		$validator = Validator::make($request->all(), ['nombre_categoria' => 'required|min:3|max:100']);
			
			
		try
		{
			if ( $validator->fails() )
			{
				throw new \Exception($validator->errors()->first());
			}
			
			
			//  Registra nueva categoría 
			$category_row = new CategoriasModel();
				$category_row->nombre_categoria = $request->nombre_categoria;
				$category_row->estado_categoria = 1;
					
			if ( ! $category_row->save() )
			{
				throw new \Exception('Error al registrar categoría');
			}
			
						
			return redirect('categories')->with('Guardado correctamente');
		}
		catch (\Exception $e)
		{
			return redirect('categories')
					->with('mensaje', 'Error al registrar la categoría');
		}
	}
			
			
		
	public function delete($id_category)
	{
		$product_row = CategoriasModel::find($id_category);
		$product_row->delete();
		return redirect('categories')->with('mensaje', 'Categoría eliminada correctamente');
	}
}

?>