@extends('layouts.app', ['activePage' => 'productos', 'titlePage' => __('Productos')])

@section('title', 'Konecta | Productos')
@section('body-class', 'product-page')


@section('content')
		
	<div class="content">
		<div class="container-fluid">
					
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
					
				
			<div class="row">
				<div class="col-md-12">
					<a href="{{ URL::to('products/create') }}"
						class="btn btn-success pull-left">
						Registrar
						<i class="material-icons right">note_add</i>
					</a>
				</div>
			</div>
				
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header card-header-success">
							<h3 class="card-title">PRODUCTOS</h3>
							<p>Listado de productos</p>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table">
									<thead class="text-primary">
										<tr>
											<th>#</th>
											<th>Nombre del producto</th>
											<th>Precio</th>
											<th>Peso</th>
											<th>Stock</th>
											<th class="text-center">Opción</th>
										</tr>
									</thead>
									<tbody>
										@if ( count($list_products) )
											@foreach( $list_products as $keyStudent => $valueProduct )
												<?php 
													$IdProduct = $valueProduct->id; #
													
													$url_detail = URL::to("products/show/$IdProduct");
													$url_delete = URL::to("products/delete/$IdProduct");
													#'config/repository/image/'.$i_url.'/'.$i_name
													#"api/users/$token/transaction/$client_id"
												?>
												<tr>
													<td>{{ $IdProduct }}</td>
													<td>{{ $valueProduct->nombre_producto }}</td>
													<td>{{ $valueProduct->precio }}</td>
													<td>{{ $valueProduct->peso }}</td>
													<td>{{ $valueProduct->stock}}</td>
													<td class="text-center">
														<a href="{{ $url_detail }}"
															class="tooltipped"
															target="_blank" 
															data-toggle="tooltip"
															data-placement="left"
															title="Detalle">
															<i class="material-icons text-info">details</i>
														</a>
														&nbsp; 
														<a href="{{ $url_delete }}"
															class="tooltipped"
															data-id="{{ $IdProduct }}"
															data-toggle="tooltip"
															data-placement="right"
															title="Eliminar"
															onclick="return fn_continue(this);">
															<i class="material-icons text-danger">delete</i>
														</a>
													</td>
												</tr>
											@endforeach
										@else
											<tr>
												<td colspan="6" class="text-center">¡No se encontraron registros!</td>
											</tr>
										@endif
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
			
		
@endsection