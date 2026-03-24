@extends('layouts.app')

@section('title', 'Clients')

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
        $pageTitle = 'Clients';
        $breadcrumbs = [['text' => 'Home', 'url' => route('dashboard')], ['text' => 'Clients']];
        $showLink = true;
    @endphp

    <x-page-layout :pageTitle="$pageTitle" :breadcrumbs="$breadcrumbs">

        <div class="row">
            <div class="col-md-12">
                <x-card-primary-outline title="All Clients" :showLink="$showLink" datatoggle="modal" datatarget="#addClientModal" linkText="Add New">

                    <table id="clients" class="table table-bordered table-striped table-sm table-valign-middle">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>SSN</th>
                                <th>DOB</th>
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
    @include('clients.partials.clientModals')
@endsection

@section('javascript')

    @include('clients.partials.scripts')

@endsection
