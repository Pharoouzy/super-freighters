<div class="tile">
    <h3 class="tile-title">General Settings</h3>
    <hr>
    <form method="POST" action="{{ route('settings.update') }}" role="form" autocomplete="off">
        @csrf
        <div class="tile-body">
            <div class="form-row">
                <div class="col-lg-6 form-group">
                    <label class="control-label" for="app_name">App Name</label>
                    <input
                        class="form-control @error('app_name') is-invalid @enderror"
                        type="text"
                        placeholder="Enter site name"
                        name="app_name"
                        id="app_name"
                        required autofocus
                        value="{{ config('settings.app_name') }}"
                        autocomplete="app_name"
                    >
                    @error('app_name')
                    <small class="form-text text-danger"><strong>{{ $message }}</strong></small>
                    @enderror
                </div>
                <div class="col-lg-6 form-group">
                    <label class="control-label" for="app_title">App Title</label>
                    <input
                        class="form-control @error('app_title') is-invalid @enderror"
                        name="app_title"
                        id="app_title"
                        type="text"
                        required
                        placeholder="Enter site title"
                        value="{{ config('settings.app_title') }}"
                        autocomplete="app_title"
                    >
                    @error('app_title')
                    <small class="form-text text-danger"><strong>{{ $message }}</strong></small>
                    @enderror
                </div>
                <div class="col-lg-6 form-group">
                    <label class="control-label" for="default_email_address">Default Email Address</label>
                    <input
                        class="form-control @error('default_email_address') is-invalid @enderror"
                        type="email"
                        name="default_email_address"
                        id="default_email_address"
                        placeholder="Enter default email address"
                        required
                        value="{{ config('settings.default_email_address') }}"
                        autocomplete="default_email_address"
                    >
                    @error('default_email_address')
                    <small class="form-text text-danger"><strong>{{ $message }}</strong></small>
                    @enderror
                </div>
                <div class="col-lg-6 form-group">
                    <label class="control-label" for="default_phone_number">Default Phone Number</label>
                    <input
                        class="form-control @error('default_phone_number') is-invalid @enderror"
                        type="text"
                        placeholder="Enter site name"
                        name="default_phone_number"
                        id="default_phone_number"
                        required autofocus
                        value="{{ config('settings.default_phone_number') }}"
                        autocomplete="default_phone_number"
                    >
                    @error('default_phone_number')
                    <small class="form-text text-danger"><strong>{{ $message }}</strong></small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="tile-footer text-right">
            <div class="row d-print-none mt-2">
                <div class="col-12 text-right">
                    <button class="btn btn-success" type="submit">
                        <i class="fa fa-fw fa-lg fa-check-circle"></i>
                        Update Settings
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
