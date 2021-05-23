@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <!-- Wizard container -->
            <div class="wizard-container">
                <div class="card wizard-card" data-color="purple" id="wizard">
                    <form action="{{ route('summary.post') }}" method="POST">
                        @csrf
                        <div class="wizard-header">
                            @include('partials.app._notification')
                            <h3 class="wizard-title">
                                Place your order
                            </h3>
                            <h5>This information will let us know more about your place.</h5>
                        </div>
                        <div class="wizard-navigation">
                            <ul>
                                <li><a href="#personal-info" data-toggle="tab">Personal Info</a></li>
                                <li><a href="#item-info" data-toggle="tab">Item Info</a></li>
                                <li><a href="#origin" data-toggle="tab">Location</a></li>
                            </ul>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane" id="personal-info">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4 class="info-text"> Let's start with the basic details</h4>
                                    </div>
                                    <div class="col-sm-5 col-sm-offset-1">
                                        <div class="form-group label-floating @error('first_name') has-error @enderror">
                                            <label class="control-label">First Name</label>
                                            <input type="text" name="first_name" class="form-control @error('first_name') error @enderror" value="{{ old('first_name', 'Umar-Farouq') }}" required autocomplete="first_name">
                                            @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <small class="text-danger">{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group label-floating @error('last_name') has-error @enderror">
                                            <label class="control-label">Last Name</label>
                                            <input type="text" name="last_name" class="form-control @error('last_name') error @enderror" value="{{ old('last_name', 'Yusuf') }}" required autocomplete="last_name">
                                            @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <small class="text-danger">{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-5 col-sm-offset-1">
                                        <div class="form-group label-floating @error('email') has-error @enderror">
                                            <label class="control-label">Email Address</label>
                                            <input type="email" name="email" class="form-control @error('email') error @enderror" value="{{ old('email', 'yusufumarfarouq@gmail.com') }}" required autocomplete="email">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <small class="text-danger">{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group label-floating @error('phone_number') has-error @enderror">
                                            <label class="control-label">Phone Number</label>
                                            <input type="text" name="phone_number" class="form-control @error('phone_number') error @enderror" value="{{ old('phone_number', '08078780858') }}" required autocomplete="phone_number">
                                            @error('phone_number')
                                            <span class="invalid-feedback" role="alert">
                                                <small class="text-danger">{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="item-info">
                                <h4 class="info-text">What type of location do you have? </h4>
                                <div class="row">
                                    <div class="col-sm-5 col-sm-offset-1">
                                        <div class="form-group label-floating @error('item_name') has-error @enderror">
                                            <label class="control-label">Item Name</label>
                                            <input type="text" name="item_name" class="form-control @error('item_name') error @enderror" value="{{ old('item_name', 'Cars') }}" required autocomplete="item_name">
                                            @error('item_name')
                                            <span class="invalid-feedback" role="alert">
                                                <small class="text-danger">{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group label-floating @error('weight') has-error @enderror">
                                            <label class="control-label">Weight (KG)</label>
                                            <input  type="number" step="any" name="weight" class="form-control @error('weight') error @enderror" value="{{ old('weight', '25') }}" required autocomplete="weight">
                                            @error('weight')
                                            <span class="invalid-feedback" role="alert">
                                                <small class="text-danger">{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="origin">
                                <h4 class="info-text">Tell us more about facilities. </h4>
                                <div class="row">
                                    <div class="col-sm-5 col-sm-offset-1">
                                        <div class="form-group label-floating @error('origin') has-error @enderror">
                                            <label class="control-label">Country of Origin</label>
                                            <select class="form-control @error('origin') error @enderror" required name="origin">
                                                <option disabled="" selected></option>
                                                @forelse($countries as $country)
                                                <option @if(old('origin') == $country->id) selected @endif value="{{ $country->id }}">{{ $country->name }} ({{ $country->code }})</option>
                                                @empty
                                                @endforelse
                                            </select>
                                            @error('origin')
                                            <span class="invalid-feedback" role="alert">
                                                <small class="text-danger">{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group label-floating @error('destination') has-error @enderror">
                                            <label class="control-label">Country of Consignment</label>
                                            <select class="form-control @error('destination') error @enderror" required name="destination">
                                                <option disabled="" selected></option>
                                                @forelse($countries as $destination)
                                                    <option @if(old('destination') == $destination->id) selected @endif value="{{ $destination->id }}">{{ $destination->name }} ({{ $destination->code }})</option>
                                                @empty
                                                @endforelse
                                            </select>
                                            @error('destination')
                                            <span class="invalid-feedback" role="alert">
                                                <small class="text-danger">{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <div class="form-group label-floating @error('mode') has-error @enderror">
                                            <label class="control-label">Mode of Transport</label>
                                            <select class="form-control @error('mode') error @enderror" name="mode" required>
                                                <option disabled="" selected></option>
                                                @forelse($modes as $mode)
                                                    <option @if(old('mode') == $mode->id) selected @endif value="{{ $mode->id }}">{{ $mode->name }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                            @error('mode')
                                            <span class="invalid-feedback" role="alert">
                                                <small class="text-danger">{{ $message }}</small>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wizard-footer">
                            <div class="pull-right">
                                <input type='button' class='btn btn-next btn-fill btn-primary btn-wd'
                                       name='next' value='Next' />
                                <button type='submit' class='btn btn-finish btn-fill btn-primary btn-wd'>Get
                                    Estimate</button>
                            </div>
                            <div class="pull-left">
                                <input type='button' class='btn btn-previous btn-fill btn-default btn-wd'
                                       name='previous' value='Previous' />
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div> <!-- wizard container -->
        </div>
    </div> <!-- row -->
@endsection
