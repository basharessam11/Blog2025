@extends('admin.customer.app')

@section('contant1')
    <!-- Change Password -->
    <div class="card mb-4">
        <h5 class="card-header">{!! __('admin.Change Password') !!}</h5>
        <div class="card-body">
            <form method="POST" action="{{ route('customer.updatepass') }}">
                @method('post')
                @csrf
                <div class="alert alert-warning" role="alert">
                    {!! __('admin.Ensure that') !!}
                </div>

                {{-- ######################################################  Alert ######################################################################## --}}



                @if (session('success'))
                    <div id="success-message" class="alert alert-success alert-dismissible fade show text-center"
                        role="alert">
                        {{ session('success') }}
                    </div>
                @endif



                @error('newPassword')
                    <br>
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                {{-- ###################################################### End  Alert ######################################################################## --}}


                <div class="row">
                    <div class="mb-3 col-12 col-sm-6 form-password-toggle">
                        <label class="form-label" for="newPassword">{!! __('admin.New Password') !!}</label>
                        <div class="input-group input-group-merge">
                            <input class="form-control" type="password" id="newPassword" value="{{ old('newPassword') }}"
                                name="newPassword"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                    </div>

                    <div class="mb-3 col-12 col-sm-6 form-password-toggle">
                        <label class="form-label" for="confirmPassword">{!! __('admin.Confirm New Password') !!}</label>
                        <div class="input-group input-group-merge">
                            <input class="form-control" type="password" name="newPassword_confirmation"
                                value="{{ old('newPassword_confirmation') }}" id="confirmPassword"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                    </div>
                    <div>
                        <input type="hidden" name="id" value="{{ $customer->id }}">
                        <button type="submit" class="btn btn-primary me-2">{!! __('admin.Change Password') !!}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--/ Change Password -->







    </div>
    <!-- / Content -->
@endsection
