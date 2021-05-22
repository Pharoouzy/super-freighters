@extends('layouts.app')

@section('title', 'Verify Payment')

@section('content')
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <!--      Wizard container        -->
            <div class="wizard-container">
                <div class="card wizard-card" data-color="purple" id="wizard">
                    <div class="wizard-header">
                        <h3 class="wizard-title">
                            Payment Successful
                        </h3>
                        <h5>You will receive email notification regarding this order.</h5>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="choice p-2">
                                    <img src="{{ asset('app/images/transaction-completed.svg') }}" width="15%">
                                    <br>
                                    <br>
                                    <br>
                                    <a href="{{ route('home') }}"
                                       class="btn btn-fill btn-primary btn-wd text-center">Continue</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- wizard container -->
        </div>
    </div> <!-- row -->
@endsection
