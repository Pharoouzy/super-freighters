@extends('layouts.admin')

@section('title', 'Order Details')

@section('orders', 'active')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title mb-0">Order Details</h3>
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Order Details</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@include('partials.admin._notification')
<div class="content-body">
    <section class="users-view">
        <!-- users view media object start -->
        <div class="row">
            <div class="col-lg-12">
                <h3>Customer Details</h3>
                <hr>
            </div>
            <div class="col-12 col-sm-7">
                <div class="media mb-2">
                    <div class="media-body pt-25">
                        <h4 class="media-heading"><span class="users-view-name">{{ $order->user->full_name }} </span></h4>
                        <h4 class="media-heading"><span class="users-view-name">{{ $order->user->email }} </span></h4>
                        <h4 class="media-heading"><span class="users-view-name">{{ $order->user->phone_number }} </span></h4>
                        <span>Order status:</span>
                        @if($order->status == 2)
                            <span class="badge badge-small badge-success"><small>{{ ucwords($order->status_name) }}</small></span>
                        @elseif($order->status == 3)
                            <span class="badge badge-small badge-danger"><small>{{ ucwords($order->status_name) }}</small></span>
                        @elseif($order->status == 1)
                            <span class="badge badge-small badge-warning"><small>{{ ucwords($order->status_name) }}</small></span>
                        @else
                            <span class="badge badge-small badge-secondary"><small>{{ ucwords($order->status_name) }}</small></span>
                        @endif
                    </div>
                </div>
            </div>
            {{-- update --}}
            <div class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-center px-1 mb-2">
                <a href="javascript:;" data-toggle="modal" data-target="#edit-status" class="btn btn-md btn-primary">Update order status</a>
                <div class="modal fade text-left" id="edit-status" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
                    <form action="{{ route('orders.update', $order->id) }}" method="POST" autocomplete="off">
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
                                            <option {{ ($order->status  == $status) ? 'selected' : ''}} value="{{ $id }}">{{ ucfirst($status) }}</option>
                                            @endforeach
                                        </select>
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
                                        <td>Order Number:</td>
                                        <td class="users-view-role">{{ ($order->order_number) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Transaction Reference:</td>
                                        <td class="users-view-role">{{ ($order->transaction->reference) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Item Name:</td>
                                        <td class="users-view-role">{{ $order->item_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Item Weight:</td>
                                        <td class="users-view-role">{{ $order->weight }}KG</td>
                                    </tr>
                                    <tr>
                                        <td>Sub Total:</td>
                                        <td class="users-view-verified">{{ config('settings.currency_symbol') }} {{ number_format($order->sub_total) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Customs Fee:</td>
                                        <td class="users-view-verified">{{ config('settings.currency_symbol') }} {{ number_format($order->customs_fee) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Total Amount Paid:</td>
                                        <td class="users-view-verified">{{ config('settings.currency_symbol') }} {{ number_format($order->total) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Payment Status:</td>
                                        <td>
                                            @if ($order->transaction->status == 1)
                                            <span class="badge badge-success">{{ ucfirst($order->transaction->status_name) }}</span>
                                            @elseif($order->transaction->status == 0)
                                            <span class="badge badge-warning">{{ ucfirst($order->transaction->status_name) }}</span>
                                            @else
                                            <span class="badge badge-danger">{{ ucfirst($order->transaction->status_name) }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Date Ordered:</td>
                                        <td>{{ $order->date_ordered }}</td>
                                    </tr>
                                    <tr>
                                        <td>Expected Arrival Date:</td>
                                        <td>{{ $order->expected_arrival_date }}</td>
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
                    <div class="col-12">
                        <h5 class="mb-1"><i class="feather icon-info"></i> Order Info</h5>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Country of Origin:</td>
                                    <td class="users-view-username">{{ $order->countryOfOrigin->name }} ({{ $order->countryOfOrigin->code }})</td>
                                </tr>
                                <tr>
                                    <td>Country of Consignment:</td>
                                    <td class="users-view-username">{{ $order->countryOfDestination->name }} ({{ $order->countryOfDestination->code }})</td>
                                </tr>
                                <tr>
                                    <td>Mode of Transport:</td>
                                    <td>{{ $order->modeOfTransport->name }}</td>
                                </tr>

                            </tbody>
                        </table>
                        <hr>
                        <h5 class="mb-1"><i class="feather icon-info"></i> Additional Information</h5>
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td>Customer Note:</td>
                                    <td>
                                        {!! $order->note ?? 'N/A' !!}
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
