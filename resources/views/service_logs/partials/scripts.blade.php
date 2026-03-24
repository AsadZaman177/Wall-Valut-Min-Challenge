<script>
    $(document).ready(function() {
        //  Datatable
        var logs = $('#logs').DataTable({
            "ajax": {
                'url': "{{ route('service-logs.index') }}",
                'type': 'GET',
            },
            columns: [
                { data: 'DT_RowIndex',name: 'DT_RowIndex', orderable: false,},
                { data: 'client_id', name: 'client_id'},
                { data: 'notes', name: 'notes'},
                { data: 'file_path', name: 'file_path'},
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
        });

        $('#addLogForm').submit(function(event) {
            event.preventDefault();
            var form = $('#addLogForm')[0];
            var formData = new FormData(form);

            $.ajax({
                url: "{{ route('service-logs.store') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,

                success: function(data) {
                    $('#addLogModal').modal('hide');
                    onSuccessRemoveErrors();
                    Swal.fire({
                        icon: 'success',
                        text: 'Added Successfully!',
                    })
                    $('#logs').DataTable().ajax.reload();
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
            $('#addLogForm, #editLogForm, .form-control').each(function() {
                var fieldId = $(this).attr('id');
                $('#' + fieldId).removeClass('is-invalid');
                $('#' + fieldId).val('');
                $('#' + fieldId + '_help').text('');
            });
        }

        function refreshErrors() {
            // Reset all form elements with the 'form-control' class
            $('#addLogForm, #editLogForm, .form-control').each(function() {
                var fieldId = $(this).attr('id');
                $('#' + fieldId).removeClass('is-invalid');
                $('#' + fieldId + '_help').text('');
            });
        }

        $('#addLogModal, #editLogModal').on('hidden.bs.modal', function() {
            refreshErrors();
        });

        $(document).on('click', '.editLog', function(e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            $.ajax({
                url: baseUrl + '/service-logs/edit/' + id,
                type: 'GET',
                data: id,
                contentType: false,
                processData: false,

                success: function(data) {
                    $('#log_id').val(data.id);
                    $('#edit_client').val(data.client_id).trigger('change');
                    $('#edit_notes').val(data.notes);
                    $('#editLogModal').modal('show');
                },
            });

        });

        // update logs
        $('#editLogForm').submit(function(event) {
            event.preventDefault();
            var form = $('#editLogForm')[0];
            var formData = new FormData(form);

            $.ajax({
                url: "{{ route('service-logs.update') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,

                success: function(data) {
                    if(data == 'success'){
                        $('#editLogModal').modal('hide');
                        onSuccessRemoveErrors();
                        Swal.fire({
                            icon: 'success',
                            text: 'Updated Successfully!',
                        })
                        $('#logs').DataTable().ajax.reload();
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

        //Delete logs
        $(document).on('click', '.deleteLog', function(e) {
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
                        url: baseUrl + '/service-logs/delete/' + id,
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
                            $('#logs').DataTable().ajax.reload();
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
