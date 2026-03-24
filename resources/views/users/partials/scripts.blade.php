<script>
    $(document).ready(function() {
        //  Datatable
        var users = $('#users').DataTable({
            "ajax": {
                'url': "{{ route('users.index') }}",
                'type': 'GET',
            },
            columns: [
                { data: 'DT_RowIndex',name: 'DT_RowIndex', orderable: false,},
                { data: 'name', name: 'name'},
                { data: 'email', name: 'email'},
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
        });

        $('#addUsersForm').submit(function(event) {
            event.preventDefault();
            var form = $('#addUsersForm')[0];
            var formData = new FormData(form);

            $.ajax({
                url: "{{ route('users.store') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,

                success: function(data) {
                    $('#addUsersModal').modal('hide');
                    onSuccessRemoveErrors();
                    Swal.fire({
                        icon: 'success',
                        text: 'User Added Successfully!',
                    })
                    $('#users').DataTable().ajax.reload();
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
            $('#addUsersForm, #editUsersForm, .form-control').each(function() {
                var fieldId = $(this).attr('id');
                $('#' + fieldId).removeClass('is-invalid');
                $('#' + fieldId).val('');
                $('#' + fieldId + '_help').text('');
            });
        }

        function refreshErrors() {
            // Reset all form elements with the 'form-control' class
            $('#addUsersForm, #editUsersForm, .form-control').each(function() {
                var fieldId = $(this).attr('id');
                $('#' + fieldId).removeClass('is-invalid');
                $('#' + fieldId + '_help').text('');
            });
        }

        $('#addUsersModal, #editUsersModal').on('hidden.bs.modal', function() {
            refreshErrors();
        });

        $(document).on('click', '.editUser', function(e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            $.ajax({
                url: baseUrl + '/users/edit/' + id,
                type: 'GET',
                data: id,
                contentType: false,
                processData: false,

                success: function(data) {
                    $('#user_id').val(data.id);
                    $('#edit_name').val(data.name);
                    $('#edit_email').val(data.email);
                    $('#edit_password').val('');
                    $('#editUsersModal').modal('show');
                },
            });

        });

        // update users
        $('#editUsersForm').submit(function(event) {
            event.preventDefault();
            var form = $('#editUsersForm')[0];
            var formData = new FormData(form);

            $.ajax({
                url: "{{ route('users.update') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,

                success: function(data) {
                    if(data == 'success'){
                        $('#editUsersModal').modal('hide');
                        onSuccessRemoveErrors();
                        Swal.fire({
                            icon: 'success',
                            text: 'User Updated Successfully!',
                        })
                        $('#users').DataTable().ajax.reload();
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

        //Delete users
        $(document).on('click', '.deleteUser', function(e) {
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
                        url: baseUrl + '/users/delete/' + id,
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
                            $('#users').DataTable().ajax.reload();
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
