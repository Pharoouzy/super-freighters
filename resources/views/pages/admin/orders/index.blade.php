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
                            <table class="table table-striped table-bordered zero-configuration display no-wrap table-responsive">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Order Number</th>
                                        <th>Customer Name</th>
                                        <th>Item Name</th>
                                        <th>Total Amount ({{ config('settings.currency_symbol') }})</th>
                                        <th>Arrival Date</th>
                                        <th>Date Ordered</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($orders as $serial => $order)
                                    <tr>
                                        <td>{{ ++$serial }}</td>
                                        <td>
                                            {{ $order->order_number }}
                                            <br>
                                            @if($order->status == 2)
                                                <span class="badge badge-small badge-success"><small>{{ ucwords($order->status_name) }}</small></span>
                                            @elseif($order->status == 3)
                                                <span class="badge badge-small badge-danger"><small>{{ ucwords($order->status_name) }}</small></span>
                                            @elseif($order->status == 1)
                                                <span class="badge badge-small badge-warning"><small>{{ ucwords($order->status_name) }}</small></span>
                                            @else
                                                <span class="badge badge-small badge-secondary"><small>{{ ucwords($order->status_name) }}</small></span>
                                            @endif
                                        </td>
                                        <td>{{ $order->user->full_name }}</td>
                                        <td>{{ $order->item_name }}</td>
                                        <td>{{ number_format($order->total, 2) }}</td>
                                        <td>{{ $order->expected_arrival_date }}</td>
                                        <td>{{ $order->date_ordered }}</td>
                                        <td class="text-center">
                                            {{--<a href="javascript:;" data-toggle="modal"
                                                data-target="#edit{{ $order->id }}"><i
                                                class="fa fa-pencil fa-sm text-success"></i></a>
                                            <div class="modal fade text-left" id="edit{{ $order->id }}" tabindex="-1"
                                                 role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
                                                <form action="{{ route('orders.update', $order->id) }}" method="POST"
                                                      autocomplete="off">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-dialog modal-dialog-centered modal-md"
                                                         role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="uploadLabel">Update
                                                                    Info</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="status"></label>
                                                                    <select class="form-control" name="status"
                                                                            id="status">
                                                                        @foreach ($statuses as $id => $status)
                                                                        <option {{ ($order->status  == $status) ? 'selected' : ''}} value="{{ $status }}">{{ ucfirst($status) }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                 </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close
                                                                </button>
                                                                <button type="submit" class="btn btn-primary">Update
                                                                    Status
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>--}}
                                            &nbsp;
                                            <a href="{{ route('orders.show', $order->id) }}"><i class="fa fa-eye fa-sm text-primary"></i></a>
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
