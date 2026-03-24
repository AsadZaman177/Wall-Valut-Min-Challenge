@extends('layouts.app')

@section('title', 'Audti Logs')

@section('css')
    <style>
        .invalid-feedback {
            display: block !important;
            width: 100%;
            margin-top: .25rem;
            font-size: 80%;
            color: #dc3545;
        }

        .holder {
            height: 100px;
            width: 100px;
            /* border: 2px solid gray; */
        }

        img {
            max-width: 100px;
            max-height: 100px;
        }
        pre {
            text-align: left;
            white-space: pre-wrap;
            word-wrap: break-word;
            max-width: 300px;
            margin: 0 auto;
        }
    </style>
@endsection

@section('content')
    @php
        $pageTitle = 'Audit Logs';
        $breadcrumbs = [['text' => 'Home', 'url' => route('dashboard')], ['text' => 'Audit Logs']];
        $showLink = false;
    @endphp

    <x-page-layout :pageTitle="$pageTitle" :breadcrumbs="$breadcrumbs">

        <div class="row">
            <div class="col-md-12">
                <x-card-primary-outline title="All Audit Logs" :showLink="$showLink" datatoggle="modal" datatarget="#addLogModal" linkText="Add New">

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <select id="filterClient" class="form-control">
                                <option value="">All Clients</option>
                                @foreach($clients as $client)
                                    <option value="{{ $client->first_name.' '.$client->last_name }}">{{ $client->first_name.' '.$client->last_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select id="filterAction" class="form-control">
                                <option value="">All Actions</option>
                                <option value="created">Created</option>
                                <option value="updated">Updated</option>
                                <option value="deleted">Deleted</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <table id="logs" class="table table-bordered table-striped table-sm table-valign-middle">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Client</th>
                                    <th>Model Type</th>
                                    <th>Action</th>
                                    <th>Old Values</th>
                                    <th>New Values</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">

                            </tbody>
                        </table>
                    </div>

                </x-card-primary-outline>
            </div>
        </div>
    </x-page-layout>
@endsection

@section('javascript')

    <script>
        $(document).ready(function() {
            function loadTable(client = '', action = '') {
                $('#logs').DataTable({
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    ajax: {
                        url: "{{ route('audit-logs.index') }}",
                        data: { client_id: client, action: action }
                    },
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false },
                        { data: 'client', name: 'client' },
                        { data: 'model_type', name: 'model_type' },
                        { data: 'action', name: 'action' },
                        { data: 'old_values', name: 'old_values' },
                        { data: 'new_values', name: 'new_values' },
                    ],
                });
            }

            loadTable();

            $('#filterClient, #filterAction').on('change', function() {
                var client = $('#filterClient').val();
                var action = $('#filterAction').val();
                loadTable(client, action);
            });
        });
    </script>

@endsection
