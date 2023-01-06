@extends('layouts.app', ['activePage' => 'productos', 'titlePage' => __('Productos')])

@section('body-class', 'product-page')

@section('content')
		
	<div class="content">
		<div class="main main-raised">
				
			<div class="container">
					
				<div class="section">
					<h2 class="title text-center">Registrar Producto</h2>
						
					@if ( $errors->any() )
	                    <div class="alert alert-danger">
	                        <ul>
	                            @foreach ($errors->all() as $error)
	                                <li>{{ $error }}</li>
	                            @endforeach
	                        </ul>
	                    </div>
	                @endif
					
					<form method="POST" action="{{ URL::to('products/create') }}" enctype="multipart/form-data">
								
						@csrf
						
						<div class="row">
							<div class="col-sm-4">
								<label for="slc_categoria" class="label-control">Categoría</label>
								<select class="form-control" name="categoria" id="slc_categoria" required>
									<option value="" selected disabled>[Elija Categoría]</option>
									@if( count($list_categories) )
										@foreach( $list_categories as $keyCategory => $valueCategory )
											<option value="{{ $valueCategory->id_categoria }}">{{ $valueCategory->nombre_categoria }}</option>
										@endforeach
									@endif
								</select>
							</div>
							<div class="col-sm-6">
								<label class="label-control">Nombre del Producto</label>
								<input class="form-control" type="text" name="nombre_producto" id="txt_nombre" placeholder="Ejm. Café" 
										value="{{ old('nombre_producto') }}" required>
							</div>
							<div class="col-sm-2">
								<label for="txt_referencia" class="label-control">Referencia</label>
								<input class="form-control" type="text" name="referencia" id="txt_referencia" 
										placeholder="Ejm. 047" value="{{ old('referencia') }}" required>
							</div>
						</div>
							<br><br>
						<div class="row">
							<div class="col-sm-2">
								<label for="txt_precio" class="label-control">Precio ($)</label>
								<input class="form-control" type="text" name="precio" id="txt_precio" placeholder="Ejm. 28" required
										value="{{ old('precio') }}">
							</div>
							<div class="col-sm-2">
								<label for="txt_peso" class="label-control">Peso (lb)</label>
								<input class="form-control" type="text" name="peso" id="txt_peso" placeholder="Ejm. 20" required
										value="{{ old('peso') }}">
							</div>
							<div class="col-sm-2">
								<label for="stock" class="label-control">Stock</label>
								<input class="form-control" type="text" name="stock" id="stock" placeholder="Ejm. 12" required
										value="{{ old('stock') }}">
							</div>
						</div>
							<br><br><br>
						<div class="row">
							<div class="col-sm-12 text-center">
								<a href="{{ url('products') }}" class="btn btn-default">Cancelar</a>
								<button type="submit" class="btn btn-success">
									Guardar
									<i class="material-icons text-right">save</i>
								</button>
							</div>
						</div>
							
					</form>
				</div>
			</div>
		
		</div>
	</div>
			
		
@endsection