@extends('layouts.app', ['activePage' => 'productos', 'titlePage' => __('Productos')])

@section('body-class', 'product-page')

@section('title')
	Detalle
@endsection


@section('content')
		
	<div class="content">
		<div class="main main-raised">
			
			<div class="container">
				<div class="section">
					<h2 class="title text-center">Editar Producto</h2>
					
					@if ( session('success') )
		                <div class="alert alert-success">
		                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                        <i class="material-icons">close</i>
		                    </button>
		                    <span>
		                        <b>{{ session('success') }}</b>
		                    </span>
		                </div>
		            @endif
					@if ( $errors->any() )
	                    <div class="alert alert-danger">
	                        <ul>
	                            @foreach ($errors->all() as $error)
	                                <li>{{ $error }}</li>
	                            @endforeach
	                        </ul>
	                    </div>
	                @endif
						
					<form method="POST" action="{{ URL::to('products/edit') }}">
						@csrf
						<div class="row">
							<div class="col-sm-12">
								<div class="row">
									<div class="col-sm-4">
										<label class="label-control">Categoría</label>
										<select class="form-control" name="categoria" required>
											<option value="" disabled>[Elija Categoría]</option>
											@if( count($list_categories) )
												@foreach( $list_categories as $keyCategory => $valueCategory )
													<?php 
														$IdCategory = $valueCategory->id_categoria;
														$selected = ($IdCategory == $product_row->id_categoria ? 'selected' : '');
													?>
													<option value="{{ $IdCategory }}" {{ $selected }}>{{ $valueCategory->nombre_categoria }}</option>
												@endforeach
											@endif
										</select>
									</div>
									<div class="col-sm-5">
										<label class="label-control">Producto</label>
										<input class="form-control" type="text" name="nombre_producto" 
												value="{{ $product_row->nombre_producto }}" required>
									</div>
									<div class="col-sm-3">
										<label class="label-control">Referencia</label>
										<input class="form-control" type="text" name="referencia" 
												value="{{ $product_row->referencia }}" required>
									</div>
								</div>
									<br>
								<div class="row">
									<div class="col-sm-2">
										<label class="label-control">Precio ($)</label>
										<input class="form-control" type="text" name="precio" 
												value="{{ $product_row->precio }}" required>
									</div>
									<div class="col-sm-2">
										<label class="label-control">Peso (lb)</label>
										<input class="form-control" type="text" name="peso" 
												value="{{ $product_row->peso }}" required>
									</div>
									<div class="col-sm-2">
										<label class="label-control">Stock</label>
										<input class="form-control" type="text" name="stock" 
												value="{{ $product_row->stock }}" required>
									</div>
									<div class="col-sm-2">
										<label class="label-control">Fecha de creación</label><br><br>
										<p align="justify">{{ $product_row->created_at }}</p>
									</div>
									<div class="col-sm-2">
										<input class="form-control" type="hidden" name="id_producto" 
												value="{{ $product_row->id }}">
									</div>
								</div>
									<br><br><br>
								<div class="row">
									<div class="col-sm-12 text-right">
										<a href="{{ url('products') }}" class="btn btn-default">Cancelar</a>
										<button type="submit" class="btn btn-success">
											Actualizar
											<i class="material-icons text-right">save</i>
										</button>
									</div>
								</div>
							</div>
						</div>
					</form>
							
				</div>
			</div>
			
		</div>
	</div>
			
@endsection