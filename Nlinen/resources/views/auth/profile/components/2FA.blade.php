<div class="row justify-content-center mb-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Two-Factor Authentication (2FA)') }}</div>
            <div class="card-body text-center">
                @if (auth()->user()->two_factor_secret)

                    <form method="POST" action="{{ route('two-factor.disable') }}" id="twoFactorFormDisable">
                        @csrf
                        @method('DELETE')

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="disable_two_factor"
                                onchange="document.getElementById('twoFactorFormDisable').submit();" checked>
                            <label class="form-check-label" for="flexSwitchCheckChecked">
                                Two-Factor Authentication Available
                            </label>
                        </div>
                    </form>
                    <hr>
                

                        <h4 class="my-2">QR Code:</h4>
                        <div class="my-2">{!! auth()->user()->twoFactorQrCodeSvg() !!}</div>

                        <h4>Recovery Codes:</h4>
                        <ul class="list-unstyled text-center">
                            @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes, true)) as $code)
                                <li>{{ $code }}</li>
                            @endforeach
                        </ul>
                     
                @else
                    <form method="POST" action="{{ route('two-factor.enable') }}" id="twoFactorFormEnable">
                        @csrf
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="enable_two_factor"
                                onchange="document.getElementById('twoFactorFormEnable').submit();">
                            <label class="form-check-label">
                                Two-Factor Authentication Not Available
                            </label>
                        </div>
                    </form>

                @endif

            </div>
        </div>
    </div>
</div>
