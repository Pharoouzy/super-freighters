<div class="tile">
    <form action="{{ route('settings.update') }}" method="POST" role="form">
        @csrf
        <h3 class="tile-title">Payment Settings</h3>
        <hr>
        <div class="tile-body">
            <div class="form-row">
                <div class="col-lg-6 form-group">
                    <label class="control-label" for="paystack_env">Paystack Environment</label>
                    <select name="paystack_env" id="paystack_env" class="form-control">
                        <option value="test" {{ (config('settings.paystack_env')) == 'test' ? 'selected' : '' }}>Test</option>
                        <option value="live" {{ (config('settings.paystack_env')) == 'live' ? 'selected' : '' }}>Live</option>
                    </select>
                </div>
                <div class="col-lg-6 form-group">
                    <label class="control-label" for="customs_tax">Customs Tax (%)</label>
                    <input
                        class="form-control @error('customs_tax') is-invalid @enderror"
                        name="customs_tax"
                        id="customs_tax"
                         type="number"
                        step="any"
                        required
                        placeholder="Customs Tax"
                        value="{{ config('settings.customs_tax') }}"
                        autocomplete="customs_tax"
                    >
                    @error('customs_tax')
                    <small class="form-text text-danger"><strong>{{ $message }}</strong></small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="tile-footer">
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
