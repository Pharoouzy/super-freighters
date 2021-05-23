@extends('layouts.app')

@section('title', 'Order Summary')

@section('content')
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <!--      Wizard container        -->
            <div class="wizard-container">
                <div class="card wizard-card" data-color="purple" id="wizard">
                    <div class="wizard-header">
                        @include('partials.app._notification')
                        <h3 class="wizard-title">
                            Order Summary
                        </h3>
                        <h5>This information will let us know more about your place.</h5>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-condensed">
                                <thead>
                                <tr>
                                    <td><strong>Item</strong></td>
                                    <td class="text-center"><strong>Country of Origin</strong></td>
                                    <td class="text-center"><strong>Country of Consignment</strong></td>
                                    <td class="text-center"><strong>Mode of Transport</strong></td>
                                    <td class="text-right"><strong>Total</strong></td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $summary->item->item_name }} ({{ $summary->item->weight }}KG)</td>
                                    <td class="text-center">{{ $summary->origin->name }} ({{ $summary->origin->code }})</td>
                                    <td class="text-center">{{ $summary->destination->name }} ({{ $summary->destination->code }})</td>
                                    <td class="text-center">{{ $summary->mode->name }}</td>
                                    <td class="text-right">{{ config('settings.currency_symbol') }}{{ number_format($summary->sub_total) }}</td>
                                </tr>
                                <tr>
                                    <td class="highrow"></td>
                                    <td class="highrow"></td>
                                    <td class="highrow"></td>
                                    <td class="highrow text-center"><strong>Subtotal</strong></td>
                                    <td class="highrow text-right">{{ config('settings.currency_symbol') }}{{ number_format($summary->sub_total) }}</td>
                                </tr>
                                <tr>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-center"><strong>Custom Fee</strong></td>
                                    <td class="emptyrow text-right">{{ config('settings.currency_symbol') }}{{ number_format($summary->customs_fee) }}</td>
                                </tr>
                                <tr>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-center"><strong>Total</strong></td>
                                    <td class="emptyrow text-right">{{ config('settings.currency_symbol') }}{{ number_format($summary->total) }}</td>
                                </tr>
                                <tr>
                                    <td class="emptyrow">
                                        <a href="{{ url()->previous() }}"
                                           class="btn btn-fill btn-default btn-wd btn-block">Back</a>
                                    </td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-center"></td>
                                    <td class="emptyrow text-right">
                                        <button type="submit" form="process" class="btn btn-fill btn-primary btn-wd btn-block">Pay</button>
                                        <form id="process" action="{{ route('order.process') }}" method="POST">
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- wizard container -->
        </div>
    </div> <!-- row -->
@endsection
