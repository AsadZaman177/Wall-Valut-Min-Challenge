@extends('layouts.app')

@section('title', 'Service Logs')

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
    </style>
@endsection

@section('content')
    @php
        $pageTitle = 'Service Logs';
        $breadcrumbs = [['text' => 'Home', 'url' => route('dashboard')], ['text' => 'Service Logs']];
        $showLink = true;
    @endphp

    <x-page-layout :pageTitle="$pageTitle" :breadcrumbs="$breadcrumbs">

        <div class="row">
            <div class="col-md-12">
                <x-card-primary-outline title="All Service Logs" :showLink="$showLink" datatoggle="modal" datatarget="#addLogModal" linkText="Add New">

                    <table id="logs" class="table table-bordered table-striped table-sm table-valign-middle">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Client</th>
                                <th>Notes</th>
                                <th>File</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">

                        </tbody>
                    </table>

                </x-card-primary-outline>
            </div>
        </div>
    </x-page-layout>
    @include('service_logs.partials.logModals')
@endsection

@section('javascript')

    @include('service_logs.partials.scripts')

@endsection
