@extends('layouts.app', ['activePage' => 'categorias', 'titlePage' => __('Categorías')])


@section('title', 'Konecta | Categorías')
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
					<a href="{{ URL::to('categories/create') }}"
						class="btn btn-success pull-left hide" >
						Registrar
					</a>
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalRegister">
						Registrar
						<i class="material-icons right">note_add</i>
					</button>
				</div>
			</div>
				
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header card-header-success">
							<h3 class="card-title">CATEGORÍAS</h3>
							<p>Listado de categorías</p>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table">
									<thead class="text-primary">
										<tr>
											<th>#</th>
											<th>Nombre de Categoría</th>
											<th>Estado</th>
											<th class="text-center">Opción</th>
										</tr>
									</thead>
									<tbody>
										@if ( count($list_categories) )
											@foreach( $list_categories as $keyCategory => $valueCategory )
													
												@php 
													$IdCategory = $valueCategory->id_categoria;
													
													$url_detail = URL::to("categories/show/$IdCategory");
													$url_delete = URL::to("categories/delete/$IdCategory");
														
													$StatusCategory = ($valueCategory->estado_categoria == 1 ? 'Activo' : 'Inactivo');
												@endphp
													
												<tr>
													<td>{{ $IdCategory }}</td>
													<td>{{ $valueCategory->nombre_categoria }}</td>
													<td>{{ $StatusCategory }}</td>
													<td class="text-center">
														<a href="{{ $url_detail }}"
															class="tooltipped hide"
															target="_blank" 
															data-toggle="tooltip"
															data-placement="left"
															title="Detalle">
															<i class="material-icons">details</i>
														</a>
														<a href="{{ $url_delete }}"
															class="text-red"
															data-toggle="tooltip"
															data-placement="right"
															title="Eliminar">
															<i class="material-icons text-danger">delete</i>
														</a>
													</td>
												</tr>
											@endforeach
										@else
											<tr>
												<td colspan="4" class="text-center">¡No se encontraron registros!</td>
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

	<!-- Modal -->
	<div class="modal fade" id="ModalRegister" tabindex="-1" role="dialog" aria-labelledby="ModalRegisterLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
					
				<form method="POST" action="{{ URL::to('categories/create') }}">
					@csrf
					<div class="modal-header">
						<h5 class="modal-title text-center" id="ModalRegisterLabel">Registrar Categoría</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-10">
								<label class="label-control">Nombre de la Categoría</label>
								<input class="form-control" type="text" name="nombre_categoria" id="txt_categoria" 
										placeholder="Ejm. Utensilios" 
										value="{{ old('nombre_categoria') }}" required>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-success">Guardar</button>
					</div>
				</form>
						
			</div>
		</div>
	</div>
		
@endsection