@extends('layouts.app')
@section('estilos')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}"> 
<style>
    .select2-selection{
        height: 37px !important;
    }
</style>
@endsection
@section('contenido')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Gestión de automoviles</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Listado de automoviles</h3> <button type="button" class="btn btn-danger font-weight-bold" onclick="eliminarmasivo()" style="float:right;"><i class="flaticon-delete"></i>Eliminar</button> <button type="button" class="btn btn-primary font-weight-bold mr-2" id="btnnuevo" style="float:right;">Nuevo Auto</button>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example2" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th><input type="checkbox" class="form-check-input" id="checktodo" style="margin-left: 19px; margin-top: -17px;" onclick="marcar();"></th>
              <th>Nombre</th>
              <th>Marca</th>
              <th>Modelo</th>
              <th>Departamento</th>
              <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
    <div class="modal fade" id="modal-crear"  role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Automovil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <form class="formcrear" id="formcrear" action="{{ route('automoviles.store') }}">
                @csrf
                <div class="modal-body">

                    <div class="card card-custom p-2">
                        <div class="row">
                            <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre ...">
                            </div>
                            </div>
                            <div class="col-sm-6">
                            <div class="form-group">
                                <label>Modelo</label>
                                <input type="text" class="form-control" name="modelo" id="modelo" placeholder="Modelo ...">
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Marca</label>
                                <input type="text" class="form-control" name="marca" id="marca" placeholder="Marca ...">
                            </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Departamento</label>
                                    <select class="form-control form-control-solid" name="departamento" id="departamento">
                                        <!-- <option>option 1</option>
                                        <option>option 2</option>
                                        <option>option 3</option>
                                        <option>option 4</option>
                                        <option>option 5</option> -->
                                    </select>
                                
                            </div>
                        </div>              
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary font-weight-bold">Guardar</button>
                </form>     
                    <button type="button" class="btn btn-secundary font-weight-bold" data-dismiss="modal">Cerrar</button>
                </div>
                    
            </div>
        </div>
    </div>
      <!-- /.modal -->
      <div class="modal fade" id="modal-editar"  role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Actualizar Automovil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <form class="formeditar" id="formeditar" action="{{ route('automoviles.update','') }}">
                @csrf
                {{method_field('PUT')}}
                <input type="hidden" id="idauto" />
                <div class="modal-body">

                    <div class="card card-custom p-2">
                        <div class="row">
                            <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="nombre_edit" placeholder="Nombre ...">
                            </div>
                            </div>
                            <div class="col-sm-6">
                            <div class="form-group">
                                <label>Modelo</label>
                                <input type="text" class="form-control" name="modelo" id="modelo_edit" placeholder="Modelo ...">
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Marca</label>
                                <input type="text" class="form-control" name="marca" id="marca_edit" placeholder="Marca ...">
                            </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Departamento</label>
                                    <select class="form-control form-control-solid" name="departamento" id="departamento_edit">
                                        <!-- <option>option 1</option>
                                        <option>option 2</option>
                                        <option>option 3</option>
                                        <option>option 4</option>
                                        <option>option 5</option> -->
                                    </select>
                                
                            </div>
                        </div>              
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary font-weight-bold">Guardar</button>
                </form>     
                    <button type="button" class="btn btn-secundary font-weight-bold" data-dismiss="modal">Cerrar</button>
                </div>
                    
            </div>
        </div>
    </div>
      <!-- /.modal -->
@endsection

@section('scripts')
<!-- DataTables -->
<script src="{{asset('adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
@endsection