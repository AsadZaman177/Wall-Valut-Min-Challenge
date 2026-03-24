{{-- Add Log --}}
<div class="modal" id="addLogModal">
    <div class="modal-dialog modal-md">
        <form id="addLogForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Service Log</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Client:</label>
                                @foreach($clients as $client)
                                    <select class="form-control select2" name="client" id="client">
                                        <option value="">Select Client</option>
                                        <option value="{{ $client->id}}">{{ $client->first_name }} {{ $client->last_name  }}</option>
                                    </select>
                                    <span class="invalid-feedback"><strong id="client_help"></strong></span>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Notes:</label>
                                <textarea class="form-control" name="notes" id="notes"></textarea>
                                <span class="invalid-feedback"><strong id="notes_help"></strong></span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>File Upload:</label>
                                <input type="file" class="form-control" name="file" id="file">
                                <span class="invalid-feedback"><strong id="file_help"></strong></span>
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

{{-- Edit Log --}}
<div class="modal" id="editLogModal">
    <div class="modal-dialog modal-md">
        <form id="editLogForm">
            <input type="hidden" id="log_id" name="log_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Service Log</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Client:</label>
                                @foreach($clients as $client)
                                    <select class="form-control select2" name="edit_client" id="edit_client">
                                        <option value="">Select Client</option>
                                        <option value="{{ $client->id}}">{{ $client->first_name }} {{ $client->last_name  }}</option>
                                    </select>
                                    <span class="invalid-feedback"><strong id="edit_client_help"></strong></span>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Notes:</label>
                                <textarea class="form-control" name="edit_notes" id="edit_notes"></textarea>
                                <span class="invalid-feedback"><strong id="edit_notes_help"></strong></span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>File Upload:</label>
                                <input type="file" class="form-control" name="edit_file" id="edit_file">
                                <span class="invalid-feedback"><strong id="edit_file_help"></strong></span>
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
