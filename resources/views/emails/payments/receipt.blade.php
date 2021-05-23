@component('mail::message')
# Introduction

@if(!$isAdmin)

# Hi {{ $transaction->order->user->first_name }},

Your payment of <strong>NGN{{ number_format($transaction->amount) }}</strong> for order <strong>{{ $transaction->order->order_number }}</strong> was successful, and here is the summary of the transaction:

@else

# Hi Admin,

A new payment was made on order <strong>{{ $transaction->order->order_number }}</strong>, and here is the summary of the transaction:

@endif

# Transaction Summary:
| | |
|-|-|
| **Reference:** | {{ $transaction->order->transaction->reference }} |
| **Sub total:** | NGN{{ number_format($transaction->order->sub_total) }} |
| **Customs Fee:** | NGN{{ number_format($transaction->order->customs_fee) }} |
| **Total Amount Paid:** | NGN{{ number_format($transaction->amount) }} |
| **Status:** | {{ ucwords($transaction->status_name) }} |
| **Date:** | {{ $transaction->order->date_ordered }} |
<br>

@component('mail::button', ['url' => route('home')])
Go to Dashboard
@endcomponent

Thanks,<br>
{{ config('app.name') }}
___
###### If you received this email but didn't register for {{ config('app.name') }} Account, something's gone haywire. Click [here]({{ url('/') }}) to de-activate and close this account
@endcomponent
