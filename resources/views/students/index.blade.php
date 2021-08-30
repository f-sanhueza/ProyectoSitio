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
                Lista de estudiantes
            </h3>
            <button class="btn btn-success pull-right create"><i class="glyphicon glyphicon-plus"></i> Crear</button>

            <div class="clearfix"></div>
        </div>
        <div class="table-responsive">
            <table id="students-table" class="table" style="width:100% !important">
                <thead>
                    <td>Nombre</td>
                    <td>Apellido Paterno</td>
                    <td>Apellido Materno</td>
                    <td>Region</td>
                    <td>Ciudad</td>
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
                            <label for="studname">Nombres</label>
                            <input type="text" class="form-control studname" name="studname"  required>
                        </div>
                        <div class="form-group">
                            <label for="surname1">Apellido Paterno</label>
                            <input type="text" class="form-control surname1" name="surname1"  required>
                        </div>
                        <div class="form-group">
                            <label for="surname2">Apellido Materno</label>
                            <input type="text" class="form-control surname2" name="surname2"  required>
                        </div>
                        <div class="form-group">
                            <label for="region">Region</label>
                            <input type="text" class="form-control region" name="region"  required>
                        </div>
                        <div class="form-group">
                            <label for="city">Ciudad</label>
                            <input type="text" class="form-control city" name="city"  required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Guardar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
                  </div>

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
                            <label for="studname">Nombres</label>
                            <input type="text" class="form-control studname" name="studname"  required>
                        </div>
                        <div class="form-group">
                            <label for="surname1">Apellido Paterno</label>
                            <input type="text" class="form-control surname1" name="surname1" required>
                        </div>
                        <div class="form-group">
                            <label for="surname2">Apellido Materno</label>
                            <input type="text" class="form-control surname2" name="surname2"  required>
                        </div>
                        <div class="form-group">
                            <label for="region">Region</label>
                            <input type="text" class="form-control region" name="region" required>
                        </div>
                        <div class="form-group">
                            <label for="city">Ciudad</label>
                            <input type="text" class="form-control city" name="city" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
@section('javascripts')

    <script>
        jQuery(function($) {
            $('#students-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: 'students_data/get_data',
                columns: [{
                    data: 'studname'
                },
                    {
                        data: 'surname1'
                    },
                    {
                        data: 'surname2'
                    },
                    {
                        data: 'region'
                    },
                    {
                        data: 'city'
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            function refresh() {
                var table = $('#students-table').DataTable();
                table.ajax.reload(null, false);
                console.log('refresh success');
            }

            function cleaner() {
                $('.id').val('');
                $('.studname').val('');
                $('.surname1').val('');
                $('.surname2').val('');
                $('.region').val('');
                $('.city').val('');
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
                $('.modal-title').text('Registrar Estudiante');
            });

            //edit
            $(document).on('click', '.edit', function (e) {
                e.preventDefault();
                var id = $(this).attr('student_id');

                token();

                $.ajax({
                    url: 'students/' + id + '/edit',
                    method: 'GET',
                    success: function (result) {

                        if (result.success) {
                            let json = jQuery.parseJSON(result.data);

                            $('.id').val(json.id);
                            $('.studname').val(json.studname);
                            $('.surname1').val(json.surname1);
                            $('.surname2').val(json.surname2);
                            $('.region').val(json.region);
                            $('.city').val(json.city);


                            $('#modalEdit').modal('show');
                            $('.modal-title').text('Actualizar Alumno');
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
                    studname: formData[0].value,
                    surname1: formData[1].value,
                    surname2: formData[2].value,
                    region: formData[3].value,
                    city: formData[4].value
                };

                $.ajax({
                    url: "students",
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
                    studname: formData[1].value,
                    surname1: formData[2].value,
                    surname2: formData[3].value,
                    region: formData[4].value,
                    city: formData[5].value

                };
                $.ajax({
                    url: 'students/' + id,
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
                                'Actualización Exitosa!',
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
                var id = $(this).attr('student_id');

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
                            url: 'students/' + id,
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
