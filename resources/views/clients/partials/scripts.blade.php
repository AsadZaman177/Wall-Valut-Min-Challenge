<script>
    $(document).ready(function() {
        //  Datatable
        var clients = $('#clients').DataTable({
            "ajax": {
                'url': "{{ route('clients.index') }}",
                'type': 'GET',
            },
            columns: [
                { data: 'DT_RowIndex',name: 'DT_RowIndex', orderable: false,},
                { data: 'first_name', name: 'first_name'},
                { data: 'email', name: 'email'},
                { data: 'ssn', name: 'ssn'},
                { data: 'dob', name: 'dob'},
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
        });

        $('#addClientForm').submit(function(event) {
            event.preventDefault();
            var form = $('#addClientForm')[0];
            var formData = new FormData(form);

            $.ajax({
                url: "{{ route('clients.store') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,

                success: function(data) {
                    $('#addClientModal').modal('hide');
                    onSuccessRemoveErrors();
                    Swal.fire({
                        icon: 'success',
                        text: 'Added Successfully!',
                    })
                    $('#clients').DataTable().ajax.reload();
                },

                error: function(reject) {
                    if (reject.status = 422) {
                        refreshErrors();
                        var errors = $.parseJSON(reject.responseText);
                        $.each(errors.errors, function(key, value) {
                            $('#' + key).addClass('is-invalid');
                            $('#' + key + '_help').text(value[0]);
                        });
                    }
                }
            });
        });

        function onSuccessRemoveErrors() {
            // Reset all form elements with the 'form-control' class
            $('#addClientForm, #editClientForm, .form-control').each(function() {
                var fieldId = $(this).attr('id');
                $('#' + fieldId).removeClass('is-invalid');
                $('#' + fieldId).val('');
                $('#' + fieldId + '_help').text('');
            });
        }

        function refreshErrors() {
            // Reset all form elements with the 'form-control' class
            $('#addClientForm, #editClientForm, .form-control').each(function() {
                var fieldId = $(this).attr('id');
                $('#' + fieldId).removeClass('is-invalid');
                $('#' + fieldId + '_help').text('');
            });
        }

        $('#addClientModal, #editClientModal').on('hidden.bs.modal', function() {
            refreshErrors();
        });

        $(document).on('click', '.editClient', function(e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            $.ajax({
                url: baseUrl + '/clients/edit/' + id,
                type: 'GET',
                data: id,
                contentType: false,
                processData: false,

                success: function(data) {
                    $('#client_id').val(data.id);
                    $('#edit_first_name').val(data.first_name);
                    $('#edit_last_name').val(data.last_name);
                    $('#edit_email').val(data.email);
                    $('#edit_ssn').val(data.ssn);
                    $('#edit_dob').val(data.dob);
                    $('#editClientModal').modal('show');
                },
            });

        });

        // update clients
        $('#editClientForm').submit(function(event) {
            event.preventDefault();
            var form = $('#editClientForm')[0];
            var formData = new FormData(form);

            $.ajax({
                url: "{{ route('clients.update') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,

                success: function(data) {
                    if(data == 'success'){
                        $('#editClientModal').modal('hide');
                        onSuccessRemoveErrors();
                        Swal.fire({
                            icon: 'success',
                            text: 'Updated Successfully!',
                        })
                        $('#clients').DataTable().ajax.reload();
                    }else{
                        Swal.fire({
                            icon: 'error',
                            text: data,
                        })
                    }
                },

                error: function(reject) {
                    if (reject.status = 422) {
                        refreshErrors();
                        var errors = $.parseJSON(reject.responseText);
                        $.each(errors.errors, function(key, value) {
                            $('#' + key).addClass('is-invalid');
                            $('#' + key + '_help').text(value[0]);
                        });
                    }
                }
            });
        });

        //Delete clients
        $(document).on('click', '.deleteClient', function(e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: baseUrl + '/clients/delete/' + id,
                        type: 'GET',
                        data: id,
                        contentType: false,
                        processData: false,

                        success: function(data) {
                            Swal.fire(
                                'Deleted!',
                                'Deleted Succesfully.',
                                'success'
                            );
                            $('#clients').DataTable().ajax.reload();
                        },

                        error: function(data, textStatus, xhr) {
                            Swal.fire({
                                title: 'Error',
                                icon: 'warning',
                                text: 'Unable To Find!',
                            })
                        }
                    });
                }
            });
        });

    });
</script>
