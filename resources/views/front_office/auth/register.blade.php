@extends('layouts.home')

@section('title')
    {{ __('login') }}
@endsection
@section('content')
    <section>
        <div class="container" style="display: flex; justify-content:center;align-items:center">
            <div style="width: 400px;margin-bottom:80px;margin-top:60px">
                <h1 style="text-align: center;margin:30px">{{ __('auth.register') }}</h1>
                {{-- <livewire:register /> --}}
                <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="" class="m-2">{{ __('auth.first_name') }}</label>
                        <input class="form-control" name="first_name" type="text" placeholder="{{ __('auth.first_name') }}" value="{{ old('first_name') }}">
                        @error('first_name') <span class="error text-danger">{{ $message }}</span> @enderror
            
                    </div>
                    <div class="form-group">
                        <label for="" class="m-2">{{ __('auth.last_name') }}</label>
                        <input class="form-control" name="last_name" type="text" placeholder="{{ __('auth.last_name') }}" value="{{ old('last_name') }}">
                        @error('last_name') <span class="error text-danger">{{ $message }}</span> @enderror
            
                    </div>
                    <div class="form-group">
                        <label for="" class="m-2">{{ __('auth.phone') }}</label>
                        <input class="form-control" name="phone" type="text" placeholder="{{ __('auth.phone') }}" value="{{ old('phone') }}">
                        @error('phone') <span class="error text-danger">{{ $message }}</span> @enderror
            
                    </div>
                    <div class="form-group">
                        <label for="" class="m-2">{{ __('auth.email') }}</label>
                        <input class="form-control" name="email" type="text" placeholder="{{ __('auth.email') }}" value="{{ old('email') }}">
                        @error('email') <span class="error text-danger">{{ $message }}</span> @enderror
            
                    </div>
                    <div class="form-group">
                        <label for="" class="m-2">{{ __('auth.password') }}</label>
                        <input class="form-control" name="password" type="password" placeholder="{{ __('auth.password') }}" value="{{ old('password') }}">
                        @error('password') <span class="error text-danger">{{ $message }}</span> @enderror
            
                    </div>
                    <div class="form-group">
                        <label for="" class="m-2">{{ __('auth.password') }}</label>
                        <input class="form-control" id="password_confirmation" name="password_confirmation"  type="password" placeholder="{{ __('auth.password') }}" >
                        @error('password') <span class="error text-danger">{{ $message }}</span> @enderror
            
                    </div>
                    <div class="form-group">
                        <label for="" class="m-2">{{ __('general.image') }}</label>
                        <input class="form-control" name="image" type="file" placeholder="{{ __('general.image') }}" value="{{ old('image') }}">
                        @error('image') <span class="error text-danger">{{ $message }}</span> @enderror
            
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg w-100 btn-primary mt-2 mb-2">{{ __('auth.register') }}</button>
                       
                        {{-- <a href="" class="m-5">{{ __('auth.Forget_Password') }}</a> --}}
                        <p class="m-2 d-inline">
                            <a href="{{ route('login-page') }}">{{ __('auth.Do_You_Have_Account') }}</a>
                        </p>
                        
                    </div>
                </form>
            </div>

        </div>

    </section>
@endsection
