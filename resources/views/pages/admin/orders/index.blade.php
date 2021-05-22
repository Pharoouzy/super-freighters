@extends('layouts.admin')

@section('title', 'Orders')

@section('orders', 'active')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title mb-0">Orders</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Orders</a></li>
                    <li class="breadcrumb-item active">Manage Orders</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <section id="horizontal">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ 'Orders' }}</h4>
                        <a class="heading-elements-toggle">
                            <i class="fa fa-ellipsis-v font-medium-3"></i>
                        </a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li>
                                    <a data-action="collapse"><i class="feather icon-minus"></i></a>
                                </li>
                                <li>
                                    <a data-action="reload"><i class="feather icon-rotate-cw"></i></a>
                                </li>
                                <li>
                                    <a data-action="expand"><i class="feather icon-maximize"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <p class="card-text">

                            </p>
                            <table class="table table-striped table-bordered zero-configuration display no-wrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Booking Number</th>
                                        <th>Customer Name</th>
                                        <th>No.of Clients</th>
                                        <th>Amount ({{ config('settings.currency_symbol') }})</th>
                                        <th>Platform Fee ({{ config('settings.customs_tax') }}%)</th>
                                        <th>Status</th>
                                        <th>Date Booked</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($orders as $serial => $order)
                                    <tr>
                                        <td>{{ ++$serial }}</td>
                                        <td>{{ $order->booking_number }}</td>
                                        <td>{{ $order->user->full_name }}</td>
                                        <td>{{ number_format($order->client_count) }}</td>
                                        @if($role !== 'Admin')
                                        <td>{{ number_format($order->grand_total - $order->transaction->platform_fee) }}</td>
                                        @else
                                        <td>{{ number_format($order->grand_total) }}</td>
                                        @endif
                                        @if($role !== 'Admin')
                                        <td>{{ number_format($order->transaction->platform_fee) }}</td>
                                        @endif
                                        <td class="sm text-sm">
                                            @if($order->status == 'completed')
                                            <span class="badge badge-small badge-success"><small>{{ ucwords($order->status) }}</small></span>
                                            @elseif($order->status == 'declined')
                                            <span class="badge badge-small badge-danger"><small>{{ ucwords($order->status) }}</small></span>
                                            @elseif($order->status == 'processing')
                                            <span class="badge badge-small badge-warning"><small>{{ ucwords($order->status) }}</small></span>
                                            @elseif($order->status == 'pending')
                                            <span class="badge badge-small badge-secondary"><small>{{ ucwords($order->status) }}</small></span>
                                            @else
                                            <span class="badge badge-small badge-secondary"><small>{{ ucwords($order->status) }}</small></span>
                                            @endif
                                        </td>
                                        <td>{{ $order->date_ordered }}</td>
                                        <td class="text-center">
                                            <a href="javascript:;" data-toggle="modal" data-target="#edit{{ $order->id }}"><i class="fa fa-pencil fa-sm text-success"></i></a>
                                            <div class="modal fade text-left" id="edit{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
                                                <form action="{{ route('admin.bookings.update', encrypt($order->id)) }}" method="POST" autocomplete="off">
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
                                                                        <option {{ ($order->status  == $status) ? 'selected' : ''}} value="{{ $status }}">{{ ucfirst($status) }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    {{--<label for="status{{ $id }}" class="mr-5"><input type="radio" class="form-control mr-5" name="status" {{ ($order->status  == $status) ? 'checked' : ''}} value="{{ $status }}" id="status{{ $id }}">{{ ucfirst($status) }}</label>--}}
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
                                            &nbsp;
                                            <a href="{{ route('admin.bookings.show', $order->booking_number) }}"><i class="fa fa-eye fa-sm text-primary"></i></a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-danger">
                                            <h5>No orders found</h5>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('js')
<script src="{{ asset('assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/scripts/tables/datatables/datatable-basic.min.js') }}"></script>
@endsection
