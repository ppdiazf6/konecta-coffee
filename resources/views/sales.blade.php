@extends('layouts.app', ['activePage' => 'ventas', 'titlePage' => __('Ventas')])

@section('title', 'Konecta | Ventas')
@section('body-class', 'product-page')


@section('content')
		
	<div class="content">
		<div class="main main-raised">
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
			
			<div class="card card-nav-tabs card-plain">
				<div class="card-header card-header-success">
					<div class="nav-tabs-navigation">
						<div class="nav-tabs-wrapper">
							<ul class="nav nav-tabs" data-tabs="tabs">
								<li class="nav-item">
									<a class="nav-link active" href="#tab_vender" data-toggle="tab">Vender</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#tab_lista" data-toggle="tab">Listado de Ventas</a>
								</li>
							</ul>
						</div>
					</div>
				</div>		
							
				<div class="card-body">
					<div class="tab-content text-center">
						<div class="tab-pane active" id="tab_vender">
							<div class="row">
								<div class="col-md-10 col-md-offset-1">
									<div class="card">
										<h1 class="title text-center">Realizar Venta</h1>
											
										<p class="text-center hide">Elija el producto para vender</p>
											
										<form method="POST" action="{{ URL::to('sales/process') }}">
											@csrf
											<div class="row">
												<div class="col-md-5 col-md-offset-1">
													<label class="label-control" for="slc_categoria">Producto</label>
													<select class="form-control" 
															name="producto" id="slc_categoria" 
															required>
														<option value="" selected disabled>[Elija Producto]</option>
														@if( count($list_products) )
															@foreach( $list_products as $keyProduct => $valueProduct )
																<option value="{{ $valueProduct->id }}">{{ $valueProduct->nombre_producto }}</option>
															@endforeach
														@endif
													</select>
												</div>
												<div class="col-md-2">
													<label class="label-control" class="green-text">Cantidad</label>
													<input class="form-control" type="number" 
															name="cantidad" id="txt_cantidad" 
															placeholder="5" required>
												</div>
												<div class="col-sm-2">
													<?php $url_sale = URL::to("sales/process"); ?>
													<a href="javascript:;"
														type="submit" 
														class="btn btn-info btn-lg hide"
														data-id=""
														data-toggle="tooltip"
														data-placement="top"
														title="Vender"
														onclick="return fn_continue(this);">
														Procesar 
														&nbsp; 
														<i class="material-icons">monetization_on</i>
													</a>
													<button type="submit" class="btn btn-info">
														Procesar
														<i class="material-icons ">monetization_on</i>
													</button>
												</div>
											</div>
										</form>
										<br>
									</div>
								</div>
							</div>
							<br><br>
										
							<div class="row">
								<div class="col-md-4 col-md-offset-1">
									<div class="card">
										<div class="card-header card-header-info">
											<h2 class="card-title">Producto con más stock</h2>
										</div>
										<div class="card-body">
											<p>
												<i>{{ $product_stock_name }}</i><br>
												<span>{{ $product_stock_count }}</span>
											</p>
										</div>
									</div>
								</div>
								<div class="col-md-4 col-md-offset-2">
									<div class="card">
										<div class="card-header card-header-info">
											<h2 class="card-title">Producto más vendido</h2>
										</div>
										<div class="card-body">
											<p>
												<i>{{ $selling_product->productos->nombre_producto }}</i><br>
												<span>Total: {{ $selling_product->TotalVentas }}</span>
											</p>
											<br>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="tab-pane" id="tab_lista">
							<div class="row">
								<div class="col-sm-12">
									<h1 class="title text-center">Ventas Realizadas</h1>

									<div class="table-responsive">
										<table class="table">
											<thead class="text-primary">
												<tr>
													<th>#</th>
													<th>Producto</th>
													<th>Cantidad vendida</th>
												</tr>
											</thead>
											<tbody>
												@if( count($list_sales) )
													@foreach( $list_sales as $keySale => $valueSale )
														<tr>
															<td>{{ $valueSale->id_venta }}</td>
															<td>{{ $valueSale->productos->nombre_producto }}</td>
															<td>{{ $valueSale->cantidad }}</td>
														</tr>
													@endforeach
												@else
													<tr>
														<td colspan="4" class="text-center">
															<p>¡No se registran ventas!</p>
														</td>
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
		</div>	
		
	</div>
			
@endsection