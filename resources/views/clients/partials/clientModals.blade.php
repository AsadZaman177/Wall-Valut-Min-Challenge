{{-- Add Client --}}
<div class="modal" id="addClientModal">
    <div class="modal-dialog modal-lg">
        <form id="addClientForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Client</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>First Name:</label>
                                <input type="text" class="form-control" name="first_name" id="first_name">
                                <span class="invalid-feedback"><strong id="first_name_help"></strong></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Last Name:</label>
                                <input type="text" class="form-control" name="last_name" id="last_name">
                                <span class="invalid-feedback"><strong id="last_name_help"></strong></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email:</label>
                                <input type="email" class="form-control" name="email" id="email">
                                <span class="invalid-feedback"><strong id="email_help"></strong></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>SSN:</label>
                                <input type="text" class="form-control" name="ssn" id="ssn">
                                <span class="invalid-feedback"><strong id="ssn_help"></strong></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date of Birth:</label>
                                <input type="date" class="form-control" name="dob" id="dob">
                                <span class="invalid-feedback"><strong id="dob_help"></strong></span>
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

{{-- Edit Client --}}
<div class="modal" id="editClientModal">
    <div class="modal-dialog modal-lg">
        <form id="editClientForm">
            <input type="hidden" id="client_id" name="client_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Client</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>First Name:</label>
                                <input type="text" class="form-control" name="edit_first_name" id="edit_first_name">
                                <span class="invalid-feedback"><strong id="edit_first_name_help"></strong></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Last Name:</label>
                                <input type="text" class="form-control" name="edit_last_name" id="edit_last_name">
                                <span class="invalid-feedback"><strong id="edit_last_name_help"></strong></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email:</label>
                                <input type="email" class="form-control" name="edit_email" id="edit_email">
                                <span class="invalid-feedback"><strong id="edit_email_help"></strong></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>SSN:</label>
                                <input type="text" class="form-control" name="edit_ssn" id="edit_ssn">
                                <span class="invalid-feedback"><strong id="edit_ssn_help"></strong></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date of Birth:</label>
                                <input type="date" class="form-control" name="edit_dob" id="edit_dob">
                                <span class="invalid-feedback"><strong id="edit_dob_help"></strong></span>
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
