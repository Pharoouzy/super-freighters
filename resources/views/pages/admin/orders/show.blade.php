@extends('layouts.admin')

@section('title', $pageTitle)

@section('bookings', 'active')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/tables/datatable/datatables.min.css') }}">
@endsection

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title mb-0">{{ $pageTitle }}</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.bookings.index') }}">{{ $pageTitle }}</a></li>
                    <li class="breadcrumb-item active">{{ $subTitle }}</li>
                </ol>
            </div>
        </div>
    </div>
    @include('partials.admin._menu')
</div>
@include('partials.admin._notification')
<div class="content-body">
    <section class="users-view">
        <!-- users view media object start -->
        <div class="row">
            <div class="col-12 col-sm-7">
                <div class="media mb-2">
                    <a class="mr-1" href="#">
                        <img src="{{ asset($client->avatar_url) }}" alt="users view avatar" class="users-avatar-shadow rounded-circle" height="64" width="64">
                    </a>
                    <div class="media-body pt-25">
                        <h4 class="media-heading"><span class="users-view-name">{{ $client->full_name }} </span><span class="text-muted font-medium-1"> @</span><span class="users-view-username text-muted font-medium-1 ">{{ strtolower($client->username) }}</span></h4>
                        <h4 class="media-heading"><span class="users-view-name">{{ $client->email }} </span></h4>
                        <h4 class="media-heading"><span class="users-view-name">{{ $client->phone_number }} </span></h4>
                        <span>Booking status:</span>
                        @if($booking->status == 'completed')
                        <span class="badge badge-small badge-success"><small>{{ ucwords($booking->status) }}</small></span>
                        @elseif($booking->status == 'declined')
                        <span class="badge badge-small badge-danger"><small>{{ ucwords($booking->status) }}</small></span>
                        @elseif($booking->status == 'processing')
                        <span class="badge badge-small badge-warning"><small>{{ ucwords($booking->status) }}</small></span>
                        @elseif($booking->status == 'pending')
                        <span class="badge badge-small badge-secondary"><small>{{ ucwords($booking->status) }}</small></span>
                        @else
                        <span class="badge badge-small badge-secondary"><small>{{ ucwords($booking->status) }}</small></span>
                        @endif
                    </div>
                </div>
            </div>
            {{-- update --}}
            <div class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-center px-1 mb-2">
                <a href="javascript:;" data-toggle="modal" data-target="#edit-status" class="btn btn-sm btn-primary">Update booking status</a>
                <div class="modal fade text-left" id="edit-status" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
                    <form action="{{ route('admin.bookings.update', encrypt($booking->id)) }}" method="POST" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="uploadLabel">Update Info</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="status"></label>
                                        <select class="form-control" name="status" id="status">
                                            @foreach ($statuses as $id => $status)
                                            <option {{ ($booking->status  == $status) ? 'selected' : ''}} value="{{ $status }}">{{ ucfirst($status) }}</option>
                                            @endforeach
                                        </select>
                                        {{--<label for="status{{ $id }}" class="mr-5"><input type="radio" class="form-control mr-5" name="status" {{ ($booking->status  == $status) ? 'checked' : ''}} value="{{ $status }}" id="status{{ $id }}">{{ ucfirst($status) }}</label>--}}
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update Status</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- users view media object ends -->
        <!-- users view card data start -->
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>Booking Number:</td>
                                        <td class="users-view-role">{{ ($booking->booking_number) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Transaction Reference:</td>
                                        <td class="users-view-role">{{ ($transaction->reference) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Service Name:</td>
                                        <td class="users-view-role">{{ ($ser->name) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Service Category:</td>
                                        <td class="users-view-role">{{ ($ser->category->name) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Number of Client:</td>
                                        <td class="users-view-role">{{ number_format($booking->client_count) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Amount Paid:</td>
                                        <td class="users-view-verified">{{ config('settings.currency_symbol') }} {{ number_format($booking->grand_total) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Amount Recieved:</td>
                                        <td class="users-view-verified">{{ config('settings.currency_symbol') }} {{ number_format($booking->grand_total - $transaction->platform_fee) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Payment Status:</td>
                                        <td>
                                            @if ($transaction->payment_status == 'successful')
                                            <span class="badge badge-success">{{ ucfirst($transaction->payment_status) }}</span>
                                            @elseif($transaction->payment_status == 'pending')
                                            <span class="badge badge-warning">{{ ucfirst($transaction->payment_status) }}</span>
                                            @else
                                            <span class="badge badge-danger">{{ ucfirst($transaction->payment_status) }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Date Scheduled:</td>
                                        <td>{{ date('jS M, Y h:i A', strtotime($booking->start_date)) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Date Booked:</td>
                                        <td>{{ date('jS M, Y h:i A', strtotime($booking->created_at)) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- users view card data ends -->
        <!-- users view card details start -->
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    {{-- <div class="row bg-primary bg-lighten-5 rounded mb-2 mx-25 text-center text-lg-left">
                        <div class="col-12 col-sm-4 p-2">
                            <h6 class="text-primary mb-0">Comments: <span class="font-large-1 align-middle">0</span></h6>
                        </div>
                        <div class="col-12 col-sm-4 p-2">
                            <h6 class="text-primary mb-0">Bookings: <span class="font-large-1 align-middle">0</span></h6>
                        </div>
                        <div class="col-12 col-sm-4 p-2">
                            <h6 class="text-primary mb-0">Reviews: <span class="font-large-1 align-middle">0</span></h6>
                        </div>
                    </div> --}}
                    <div class="col-12">
                        <h5 class="mb-1"><i class="feather icon-info"></i> Address Info</h5>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Address:</td>
                                    <td class="users-view-username">{{ $address->address }}</td>
                                </tr>
                                <tr>
                                    <td>Landmark/Additional Information:</td>
                                    <td class="users-view-name">{{ $address->additional_info ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td>Name:</td>
                                    <td class="users-view-email">{{ $address->name }}</td>
                                </tr>
                                <tr>
                                    <td>Phone Number:</td>
                                    <td>{{ $address->mobile_phone_number ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td>Alt. Phone Number:</td>
                                    <td>{{ $address->additional_phone_number ?? 'N/A' }}</td>
                                </tr>

                            </tbody>
                        </table>
                        <hr>
                        <h5 class="mb-1"><i class="feather icon-info"></i> Additional Information</h5>
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td>Client Note:</td>
                                    <td>
                                        {!! $booking->note ?? 'N/A' !!}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- users view card details ends -->

    </section>
</div>
@endsection

@section('js')
<script src="{{ asset('assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/scripts/tables/datatables/datatable-basic.min.js') }}"></script>
@endsection