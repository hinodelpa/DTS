@extends('layouts.app', ['title' => __('Dealer Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Ubah Dealer')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Ubah Dealer') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('dealer.index') }}" class="btn btn-sm btn-primary">{{ __('Kembali') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('dealer.update', $user->id) }}" autocomplete="off">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('Nama Dealer') }}</label>
                                        <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', $user->name) }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('no_telp') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">{{ __('Nomor Telepon') }}</label>
                                        <input class="form-control form-control-alternative{{ $errors->has('no_telp') ? ' is-invalid' : '' }}" placeholder="{{ __('Nomor Telepon') }}" type="number" name="no_telp" value="{{ old('no_telp', $user->no_telp) }}" required autofocus>
                                        
                                        @if ($errors->has('no_telp'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('no_telp') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('kode') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('Kode') }}</label>
                                        <input type="text" name="kode" id="input-name" class="form-control form-control-alternative{{ $errors->has('kode') ? ' is-invalid' : '' }}" placeholder="{{ __('Kode') }}" value="{{ old('kode', $user->kode) }}" required autofocus>

                                        @if ($errors->has('kode'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('kode') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('group') ? ' has-danger' : '' }}">
                                        <label class="form-control-label">{{ __('Group') }}</label>
                                        <input class="form-control form-control-alternative{{ $errors->has('group') ? ' is-invalid' : '' }}" placeholder="{{ __('Group') }}" type="text" name="group" value="{{ old('group', $user->group) }}" required autofocus>
                                        
                                        @if ($errors->has('group'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('group') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('alamat') ? ' has-danger' : '' }}">
                                <label class="form-control-label">{{ __('Alamat') }}</label>
                                <input class="form-control form-control-alternative{{ $errors->has('alamat') ? ' is-invalid' : '' }}" placeholder="{{ __('Alamat') }}" type="text" name="alamat" value="{{ old('alamat', $user->alamat) }}" required autofocus>
                                
                                @if ($errors->has('alamat'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('alamat') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email', $user->email) }}">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-current-password">{{ __('Password') }}</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        <a onclick="intipOldPassword()">
                                            <i class="ni ni-lock-circle-open"></i>
                                        </a>
                                        </span>
                                    </div>
                                    <input type="password" name="password" id="input-current-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" value="">
                                </div>
                                @if ($errors->has('password'))
                                    <span role="alert" style="font-size:80%; width:100%; color:#fb6340">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-password">{{ __('Confirm Password') }}</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <a onclick="intipNewPassword()">
                                            <i class="ni ni-lock-circle-open"></i>
                                        </a>
                                        </span>
                                    </div>
                                <input type="password" name="password_confirmation" id="input-password" class="form-control form-control-alternative" placeholder="{{ __('Confirm Password') }}" value="">
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">{{ __('Ubah Data') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>

<script>
  function intipOldPassword() {
    var x = document.getElementById("input-current-password");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }
  function intipNewPassword() {
    var x = document.getElementById("input-password");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }
</script>

@endsection