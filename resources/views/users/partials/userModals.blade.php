{{-- Add Users --}}
<div class="modal" id="addUsersModal">
    <div class="modal-dialog modal-lg">
        <form id="addUsersForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                                <span class="invalid-feedback" role="alert">
                                    <strong id="name_help"></strong>
                                </span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                                <span class="invalid-feedback" role="alert">
                                    <strong id="email_help"></strong>
                                </span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                <span class="invalid-feedback" role="alert">
                                    <strong id="password_help"></strong>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-space-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Edit Users --}}
<div class="modal" id="editUsersModal">
    <div class="modal-dialog modal-lg">
        <form id="editUsersForm">
            <input type="hidden" id="user_id" name="user_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_name">Name:</label>
                                <input type="text" class="form-control" name="edit_name" id="edit_name" placeholder="Name">
                                <span class="invalid-feedback" role="alert">
                                    <strong id="edit_name_help"></strong>
                                </span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_email">Email:</label>
                                <input type="email" class="form-control" name="edit_email" id="edit_email" placeholder="Email">
                                <span class="invalid-feedback" role="alert">
                                    <strong id="edit_email_help"></strong>
                                </span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_password">Update Password:</label>
                                <input type="password" class="form-control" name="edit_password" id="edit_password" placeholder="Password">
                                <span class="invalid-feedback" role="alert">
                                    <strong id="edit_password_help"></strong>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-space-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
