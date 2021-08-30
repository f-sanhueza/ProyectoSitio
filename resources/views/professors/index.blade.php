@extends('layouts.app')

@section('title')
    Datatable
@endsection

@section('links')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@endsection


@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title pull-left">
                Lista de Profesores
            </h3>
            <button class="btn btn-success pull-right create"><i class="glyphicon glyphicon-plus"></i> Crear</button>

            <div class="clearfix"></div>
        </div>
        <div class="table-responsive">
            <table id="professors-table" class="table" style="width:100% !important">
                <thead>
                <td>Nombres</td>
                <td>Apellidos</td>
                <td>Departamento</td>
                <td>Especialidad</td>
                <td>Acciones</td>
                </thead>
            </table>
        </div>

    </div>

    {{-- modal for add --}}
    <div id="modalAdd" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modal Header</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="store">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="names">Nombres</label>
                            <input type="text" class="form-control names" name="names" placeholder="Enter names" required>
                        </div>
                        <div class="form-group">
                            <label for="surnames">Apellidos</label>
                            <input type="text" class="form-control surnames" name="surnames" value="Enter surnames" >
                        </div>
                        <div class="form-group">
                            <label for="department">Departmentos</label>
                            <input type="text" class="form-control department" name="department" value="Enter department" >
                        </div>
                        <div class="form-group">
                            <label for="specialty">Especialidad</label>
                            <input type="text" class="form-control specialty" name="specialty" value="Enter specialty" >
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Guardar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>

            </div>
            </form>
        </div>

    </div>
    </div>

    <div id="modalEdit" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modal Header</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="update">
                    <div class="modal-body">
                        <input type="hidden" name="id" class="id">
                        <div class="form-group">
                            <label for="names">Nombres</label>
                            <input type="text" class="form-control names" name="names" placeholder="Enter names" required>
                        </div>
                        <div class="form-group">
                            <label for="surnames">Apellidos</label>
                            <input type="text" class="form-control surnames" name="surnames" value="Enter surnames" required>
                        </div>
                        <div class="form-group">
                            <label for="department">Departamento</label>
                            <input type="text" class="form-control department" name="department" value="Enter department" >
                        </div>
                        <div class="form-group">
                            <label for="specialty">Especialidad</label>
                            <input type="text" class="form-control specialty" name="specialty" value="Enter specialty" >
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')

    <script>
        jQuery(function($) {
            $('#professors-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: 'professors_data/get_data',
                columns: [{
                    data: 'names'
                },
                    {
                        data: 'surnames'
                    },
                    {
                        data: 'department'
                    },
                    {
                        data: 'specialty'
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            function refresh() {
                var table = $('#professors-table').DataTable();
                table.ajax.reload(null, false);
                console.log('refresh success');
            }

            function cleaner() {
                $('.id').val('');
                $('.names').val('');
                $('.surnames').val('');
                $('.department').val('');
                $('.specialty').val('');
                console.log('cleaner success');
            }

            function token() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            }

            //create
            $(document).on('click', '.create', function (e) {
                e.preventDefault();

                cleaner();
                $('#modalAdd').modal('show');
                $('.modal-title').text('Registrar Profesor');
            });

            //edit
            $(document).on('click', '.edit', function (e) {
                e.preventDefault();
                var id = $(this).attr('professor_id');

                token();

                $.ajax({
                    url: 'professors/' + id + '/edit',
                    method: 'GET',
                    success: function (result) {

                        if (result.success) {
                            let json = jQuery.parseJSON(result.data);

                            $('.id').val(json.id);
                            $('.names').val(json.names);
                            $('.surnames').val(json.surnames);
                            $('.department').val(json.department);
                            $('.specialty').val(json.specialty);

                            $('#modalEdit').modal('show');
                            $('.modal-title').text('Actualizar Profesor');
                        }

                    }
                });


            });

            //store
            $(document).on('submit', '#modalAdd', function (e) {
                e.preventDefault();

                var formData = $("form#store").serializeArray();

                token();

                var data = {
                    names: formData[0].value,
                    surnames: formData[1].value,
                    department: formData[2].value,
                    specialty: formData[3].value

                };

                $.ajax({
                    url: "professors",
                    method: 'POST',
                    data: data,
                    success: function (result) {
                        if (result.success) {
                            refresh();
                            $('#modalAdd').modal('hide');
                            swal(
                                'Buen trabajo!',
                                'Guardado con exito!',
                                'success'
                            );
                        }
                    }
                });
            });

            //update
            $(document).on('submit', '#modalEdit', function (e) {
                e.preventDefault();

                var formData = $("form#update").serializeArray();

                token();

                var id = formData[0].value
                var data = {
                    names: formData[1].value,
                    surnames: formData[2].value,
                    department: formData[3].value,
                    specialty: formData[4].value
                };
                $.ajax({
                    url: 'professors/' + id,
                    method: 'PUT',
                    data: data,
                    success: function (result) {
                        if (result.success) {
                            refresh();
                            cleaner();
                            console.log('ajax call made');
                            $('#modalEdit').modal('hide');
                            swal(
                                'Actualizado!',
                                'Actualizacion Exitosa !',
                                'success'
                            );
                            console.log('success update');
                        }
                        else{
                            console.log('failed');
                        }
                    }
                });
            });

            //delete data
            $(document).on('click', '.delete', function (e) {
                e.preventDefault();
                var id = $(this).attr('professor_id');

                swal({
                    title: 'Estas Seguro?',
                    text: "quieres eliminar este registro?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Borralo!'
                }).then((result) => {
                    if (result.value) {
                        token();

                        $.ajax({
                            url: 'professors/' + id,
                            method: 'DELETE',
                            success: function (result) {
                                if (result.success) {
                                    refresh();
                                    cleaner();
                                    swal(
                                        'Eliminado!',
                                        'Eliminado Exitosamente!',
                                        'success'
                                    );
                                }
                            }
                        });
                    }
                });

            });
        });
    </script>
@endsection
