@extends('layouts.admin')

@section('title', 'Manage App Settings')

@section('settings', 'active')

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title mb-0">Manage App Settings</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Manage App Settings</li>
            </ol>
            </div>
        </div>
        </div>
    </div>
    @include('partials.admin._notification')
    <div class="content-body">
        <section>
            <div class="row">
                <div class="col-md-3 mb-2 mb-md-0">
                    <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                        <li class="nav-item">
                            <a class="nav-link d-flex active" id="account-pill-general" data-toggle="pill"
                                href="#general" aria-expanded="true">
                                <i class="feather icon-globe"></i>
                                General
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex" id="account-pill-ntifications" data-toggle="pill"
                                href="#payments" aria-expanded="false">
                                <i class="feather icon-credit-card"></i>
                                Payments
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane active" id="general">
                            <div class="card">
                                <div class="card-body">
                                    @include('pages.admin.settings.includes.general')
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="payments">
                            <div class="card">
                                <div class="card-body">
                                    @include('pages.admin.settings.includes.payments')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
