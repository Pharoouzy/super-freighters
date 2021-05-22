@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <!--      Wizard container        -->
            <div class="wizard-container">
                <div class="card wizard-card" data-color="purple" id="wizard">
                    <form action="{{ route('summary') }}" method="">
                        <div class="wizard-header">
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
                                        <div class="form-group label-floating">
                                            <label class="control-label">First Name</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1">
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Last Name</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1">
                                        </div>
                                    </div>
                                    <div class="col-sm-5 col-sm-offset-1">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Email Address</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1">
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Phone Number</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="item-info">
                                <h4 class="info-text">What type of location do you have? </h4>
                                <div class="row">
                                    <div class="col-sm-5 col-sm-offset-1">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Item Name</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1">
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Weight (KG)</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="origin">
                                <h4 class="info-text">Tell us more about facilities. </h4>
                                <div class="row">
                                    <div class="col-sm-5 col-sm-offset-1">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Country of Origin</label>
                                            <select class="form-control">
                                                <option disabled="" selected=""></option>
                                                <option>United States</option>
                                                <option>United Kingdom</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Country of Consignment</label>
                                            <select class="form-control">
                                                <option disabled="" selected=""></option>
                                                <option>United States</option>
                                                <option>United Kingdom</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Mode of Transport</label>
                                            <select class="form-control">
                                                <option disabled="" selected=""></option>
                                                <option>Air</option>
                                                <option>Sea </option>
                                            </select>
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
