@extends('layouts.admin')

@section('title', 'Countries')

@section('countries', 'active')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
    <h3 class="content-header-title mb-0">Manage Countries</h3>
    <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Manage Countries</a></li>
            <li class="breadcrumb-item active">Countries</li>
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
                        <h4 class="card-title">Manage Countries</h4>
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
                                <button type="button" data-toggle="modal" data-target="#add" class="btn btn-primary float-right mb-3">Create New Country</button>
                            </p>
                            <table class="table table-striped table-bordered zero-configuration display no-wrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>Flat Rate {{ config('settings.currency_symbol') }}</th>
                                        <th>Date Added</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($countries as $serial => $country)
                                    <tr>
                                        <td>{{ ++$serial }}</td>
                                        <td>{{ $country->name }}</td>
                                        <td>{{ $country->code }}</td>
                                        <td>{{ number_format($country->flat_rate, 2) }}</td>
                                        <td>{{ $country->created_at }}</td>
                                        <td class="text-center">
                                            <a href="javascript:;" data-toggle="modal" data-target="#edit{{ $country->id }}"><i class="fa fa-pencil fa-sm text-success"></i></a>
                                            <div class="modal fade text-left" id="edit{{ $country->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
                                                <form action="{{ route('countries.update', $country->id) }}" method="POST" autocomplete="off">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h3 class="modal-title" id="myModalLabel35"> Update Country</h3>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <fieldset class="form-group floating-label-form-group">
                                                                    <label for="name{{ $country->id }}">Country Name</label>
                                                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name{{ $country->id }}" placeholder="Enter Country Name" autofocus required value="{{ $country->name }}" autocomplete="name">
                                                                    @error('name')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </fieldset>
                                                                <br>
                                                                <fieldset class="form-group floating-label-form-group">
                                                                    <label for="code{{ $country->id }}">Country Code</label>
                                                                    <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" id="code{{ $country->id }}" placeholder="Enter Country Code" required value="{{ $country->code }}" autocomplete="code">
                                                                    @error('code')
                                                                    <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </fieldset>
                                                                <br>
                                                                <fieldset class="form-group floating-label-form-group">
                                                                    <label for="flat_rate{{ $country->id }}">Flat Rate</label>
                                                                    <input  type="number" step="any" name="flat_rate" class="form-control @error('flat_rate') is-invalid @enderror" id="flat_rate{{ $country->id }}" placeholder="Enter Flat Rate" required value="{{ $country->flat_rate }}" autocomplete="flat_rate">
                                                                    @error('flat_rate')
                                                                    <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </fieldset>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="reset" class="btn btn-outline-secondary btn-md" data-dismiss="modal" value="Cancel">
                                                                <button type="submit" class="btn btn-outline-primary btn-md">Update Country</button>
                                                          </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            &nbsp;
                                            <a href="javascript:;" data-toggle="modal" data-target="#delete-country-{{ $country->id }}"><i class="fa fa-trash fa-sm text-danger"></i></a>
                                            <div class="modal fade text-left" id="delete-country-{{ $country->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title" id="myModalLabel35"> Confirm Action</h3>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h4 class="text-center">Are you sure you want to delete this Country?</h4>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="reset" class="btn btn-outline-secondary btn-md" data-dismiss="modal" value="Cancel">
                                                            <button type="submit" form="delete-form{{ $country->id }}" class="btn btn-outline-primary btn-md">Yes, Continue</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <form id="delete-form{{ $country->id }}" action="{{ route('countries.destroy', $country->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-danger"><h5>No Countries found</h5></td>
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
          <h3 class="modal-title" id="myModalLabel35"> Add New Country</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('countries.store') }}" method="POST" autocomplete="off">
            @csrf
            <div class="modal-body">
                <fieldset class="form-group floating-label-form-group">
                    <label for="name">Country Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter Country Name" autofocus required value="{{ old('name') }}" autocomplete="name">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </fieldset>
                <br>
                <fieldset class="form-group floating-label-form-group">
                    <label for="code">Country Code</label>
                    <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" id="code" placeholder="Enter Country Code" required value="{{ old('code') }}" autocomplete="code">
                    @error('code')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </fieldset>
                <br>
                <fieldset class="form-group floating-label-form-group">
                    <label for="flat_rate">Flat Rate</label>
                    <input  type="number" step="any" name="flat_rate" class="form-control @error('flat_rate') is-invalid @enderror" id="flat_rate" placeholder="Enter Flat Rate" required value="{{ old('flat_rate') }}" autocomplete="flat_rate">
                    @error('flat_rate')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </fieldset>
            </div>
            <div class="modal-footer">
                <input type="reset" class="btn btn-outline-secondary btn-md" data-dismiss="modal" value="Cancel">
                <button type="submit" class="btn btn-outline-primary btn-md">Add Country</button>
          </div>
        </form>
      </div>
    </div>
</div>
@endsection
