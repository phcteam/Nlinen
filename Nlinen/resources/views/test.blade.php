 
<div class="container">
    <div class="row justify-content-center">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    test
                </div>
            </div>
        </div>
    </div>
</div>
 
