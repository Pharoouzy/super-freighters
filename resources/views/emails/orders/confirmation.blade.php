@component('mail::message')
# Introduction

@if(!$isAdmin)

# Dear {{ $transaction->order->user->first_name }},

Thank you for choosing {{ config('settings.app_name') }}! Your order <strong>{{ $transaction->order->order_number }}</strong> has been successfully confirmed.

It will be packaged and shipped as soon as possible. You will be receiving notifications regarding this order.

@else

# Hi Admin,

A new order <strong>{{ $transaction->order->order_number }}</strong> has been successfully placed, and here is the order information:

# Customer Information:
| | |
|-|-|
| **Name:** | {{ $transaction->order->user->full_name }} |
| **Email:** | {{ $transaction->order->user->email }} |
| **Phone Number:** | {{ $transaction->order->user->phone_number }} |
<br>

@endif

# Transaction Information:
| | |
|-|-|
| **Reference:** | {{ $transaction->order->transaction->reference }} |
| **Sub total:** | NGN{{ number_format($transaction->order->sub_total) }} |
| **Customs Fee:** | NGN{{ number_format($transaction->order->customs_fee) }} |
| **Total Amount Paid:** | NGN{{ number_format($transaction->amount) }} |
| **Status:** | {{ ucwords($transaction->status_name) }} |
| **Date:** | {{ $transaction->order->date_ordered }} |
<br>

# Order Information:
| | |
|-|-|
| **Order Number:** | {{ $transaction->order->order_number }} |
| **Item Name:** | {{ $transaction->order->item_name }} |
| **Item Weight:** | {{ $transaction->order->weight }}KG |
| **Country of Origin:** | {{ $transaction->order->countryOfOrigin->name }} ({{ $transaction->order->countryOfOrigin->code }}) |
| **Country of Consignment:** | {{ $transaction->order->countryOfDestination->name }} ({{ $transaction->order->countryOfDestination->code }}) |
| **Mode of Transport:** | {{ $transaction->order->modeOfTransport->name }} |
| **Notes:** | {{ $transaction->order->note ?? 'N/A' }} |
| **Order Date:** | {{ $transaction->order->date_ordered }} |
| **Expected Arrival Date:** | {{ $transaction->order->expected_arrival_date }} |
| **Status:** | {{ ucwords($transaction->order->status_name) }} |
<br>


@component('mail::button', ['url' => route('home')])
Go to Dashboard
@endcomponent

Thanks,<br>
{{ config('app.name') }}
___
###### If you received this email but didn't register for {{ config('app.name') }} Account, something's gone haywire. Click [here]({{ url('/') }}) to de-activate and close this account
@endcomponent
