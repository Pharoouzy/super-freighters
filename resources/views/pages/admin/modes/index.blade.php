@extends('layouts.admin')

@section('title', 'Modes')

@section('modes', 'active')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title mb-0">Manage Modes</h3>
    <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Manage Modes</a></li>
            <li class="breadcrumb-item active">Modes</li>
        </ol>
        </div>
    </div>
    </div>
</div>
@include('partials.admin._notification')
<div class="content-body">
    <section id="horizontal">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Manage Mode of Transport</h4>
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
                                <button type="button" data-toggle="modal" data-target="#add" class="btn btn-primary float-right mb-3">Create New Mode</button>
                            </p>
                            <table class="table table-striped table-bordered zero-configuration display no-wrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Base Rate {{ config('settings.currency_symbol') }}</th>
                                        <th>Fare Per KG {{ config('settings.currency_symbol') }}</th>
                                        <th>Expected Arrival Day</th>
                                        <th>Date Added</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($modes as $serial => $mode)
                                    <tr>
                                        <td>{{ ++$serial }}</td>
                                        <td>{{ $mode->name }}</td>
                                        <td>{{ number_format($mode->base_fare, 2) }}</td>
                                        <td>{{ number_format($mode->fare_per_kg, 2) }}</td>
                                        <td>{{ $mode->expected_arrival_day }}days</td>
                                        <td>{{ $mode->created_at }}</td>
                                        <td class="text-center">
                                            <a href="javascript:;" data-toggle="modal" data-target="#edit{{ $mode->id }}"><i class="fa fa-pencil fa-sm text-success"></i></a>
                                            <div class="modal fade text-left" id="edit{{ $mode->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
                                                <form action="{{ route('modes.update', $mode->id) }}" method="POST" autocomplete="off">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h3 class="modal-title" id="myModalLabel35"> Update Mode</h3>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <fieldset class="form-group floating-label-form-group">
                                                                    <label for="name{{ $mode->id }}">Mode Name</label>
                                                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name{{ $mode->id }}" placeholder="Enter Mode Name" autofocus required value="{{ $mode->name }}" autocomplete="name">
                                                                    @error('name')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </fieldset>
                                                                <br>
                                                                <fieldset class="form-group floating-label-form-group">
                                                                    <label for="base_fare{{ $mode->id }}">Mode Code</label>
                                                                    <input  type="number" step="any" name="base_fare" class="form-control @error('base_fare') is-invalid @enderror" id="base_fare{{ $mode->id }}" placeholder="Enter Base Fare" required value="{{ $mode->base_fare }}" autocomplete="base_fare">
                                                                    @error('base_fare')
                                                                    <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </fieldset>
                                                                <br>
                                                                <fieldset class="form-group floating-label-form-group">
                                                                    <label for="fare_per_kg{{ $mode->id }}">Fare Per KG</label>
                                                                    <input  type="number" step="any" name="fare_per_kg" class="form-control @error('fare_per_kg') is-invalid @enderror" id="fare_per_kg{{ $mode->id }}" placeholder="Enter Fare Per KG" required value="{{ $mode->fare_per_kg }}" autocomplete="fare_per_kg">
                                                                    @error('fare_per_kg')
                                                                    <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </fieldset>
                                                                <br>
                                                                <fieldset class="form-group floating-label-form-group">
                                                                    <label for="expected_arrival_day{{ $mode->id }}">Expected Arrival Day</label>
                                                                    <input  type="number" step="any" name="expected_arrival_day" class="form-control @error('expected_arrival_day') is-invalid @enderror" id="expected_arrival_day{{ $mode->id }}" placeholder="Enter Expected Arrival Day" required value="{{ $mode->expected_arrival_day }}" autocomplete="expected_arrival_day">
                                                                    @error('expected_arrival_day')
                                                                    <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </fieldset>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="reset" class="btn btn-outline-secondary btn-md" data-dismiss="modal" value="Cancel">
                                                                <button type="submit" class="btn btn-outline-primary btn-md">Update Mode</button>
                                                          </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            &nbsp;
                                            <a href="javascript:;" data-toggle="modal" data-target="#delete-Mode-{{ $mode->id }}"><i class="fa fa-trash fa-sm text-danger"></i></a>
                                            <div class="modal fade text-left" id="delete-Mode-{{ $mode->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title" id="myModalLabel35"> Confirm Action</h3>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h4 class="text-center">Are you sure you want to delete this Mode?</h4>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="reset" class="btn btn-outline-secondary btn-md" data-dismiss="modal" value="Cancel">
                                                            <button type="submit" form="delete-form{{ $mode->id }}" class="btn btn-outline-primary btn-md">Yes, Continue</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <form id="delete-form{{ $mode->id }}" action="{{ route('modes.destroy', $mode->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-danger"><h5>No Modes found</h5></td>
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
<div class="modal fade text-left" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="myModalLabel35"> Add New Mode</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('modes.store') }}" method="POST" autocomplete="off">
            @csrf
            <div class="modal-body">
                <fieldset class="form-group floating-label-form-group">
                    <label for="name">Mode Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter Mode Name" autofocus required value="{{ old('name') }}" autocomplete="name">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </fieldset>
                <br>
                <fieldset class="form-group floating-label-form-group">
                    <label for="base_fare">Mode Base Fare</label>
                    <input  type="number" step="any" name="base_fare" class="form-control @error('base_fare') is-invalid @enderror" id="base_fare" placeholder="Enter Base Fare" required value="{{ old('base_fare') }}" autocomplete="base_fare">
                    @error('base_fare')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </fieldset>
                <br>
                <fieldset class="form-group floating-label-form-group">
                    <label for="fare_per_kg">Fare Per KG</label>
                    <input  type="number" step="any" name="fare_per_kg" class="form-control @error('fare_per_kg') is-invalid @enderror" id="fare_per_kg" placeholder="Enter Fare Per KG" required value="{{ old('fare_per_kg') }}" autocomplete="fare_per_kg">
                    @error('fare_per_kg')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </fieldset>
                <br>
                <fieldset class="form-group floating-label-form-group">
                    <label for="expected_arrival_day">Expected Arrival Day</label>
                    <input  type="number" step="any" name="expected_arrival_day" class="form-control @error('expected_arrival_day') is-invalid @enderror" id="expected_arrival_day" placeholder="Enter Expected Arrival Day" required value="{{ old('expected_arrival_day') }}" autocomplete="expected_arrival_day">
                    @error('expected_arrival_day')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </fieldset>
            </div>
            <div class="modal-footer">
                <input type="reset" class="btn btn-outline-secondary btn-md" data-dismiss="modal" value="Cancel">
                <button type="submit" class="btn btn-outline-primary btn-md">Add Mode</button>
          </div>
        </form>
      </div>
    </div>
</div>
@endsection
