@extends('layouts.app', ['title' => __('Pemilik Management')])

@section('content')
    @include('users.partials.header', ['title' => __('Tambah Karyawan')])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Tambah Karyawan') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('karyawan.index') }}" class="btn btn-sm btn-primary">{{ __('Kembali') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('karyawan.store') }}" autocomplete="off">
                            @csrf
                            @method('post')
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group{{ $errors->has('hso_id') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-name">{{ __('HSO ID') }}</label>
                                            <input type="text" name="hso_id" id="input-name" class="form-control form-control-alternative{{ $errors->has('hso_id') ? ' is-invalid' : '' }}" placeholder="{{ __('HSO ID') }}" value="{{ old('hso_id') }}" required autofocus>

                                            @if ($errors->has('hso_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('hso_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group{{ $errors->has('honda_id') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-name">{{ __('Honda ID') }}</label>
                                            <input type="text" name="honda_id" id="input-name" class="form-control form-control-alternative{{ $errors->has('honda_id') ? ' is-invalid' : '' }}" placeholder="{{ __('Honda ID') }}" value="{{ old('honda_id') }}" required autofocus>

                                            @if ($errors->has('honda_id'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('honda_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>   
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label">{{ __('Dealer ') }}</label>
                                            <select name="dealer_id" class="custom-select" required="required">
                                                <option disabled selected value="">- Pilih</option>
                                                @foreach($dealers as $dealer)
                                                <option value="{{ $dealer->id }}"> {{ $dealer->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('nama') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-name">{{ __('Nama Lengkap') }}</label>
                                            <input type="text" name="nama" id="input-name" class="form-control form-control-alternative{{ $errors->has('nama') ? ' is-invalid' : '' }}" placeholder="{{ __('Nama Karyawan') }}" value="{{ old('nama') }}" required autofocus>

                                            @if ($errors->has('nama'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('nama') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('tgl_lahir') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-name">{{ __('Tanggal Lahir') }}</label>
                                            <input type="date" name="tgl_lahir" id="input-name" class="form-control form-control-alternative{{ $errors->has('tgl_lahir') ? ' is-invalid' : '' }}" placeholder="{{ __('Tanggal Lahir Karyawan') }}" value="{{ old('tgl_lahir') }}" required autofocus>

                                            @if ($errors->has('tgl_lahir'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('tgl_lahir') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('alamat') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Alamat Karyawan') }}</label>
                                    <input type="text" name="alamat" id="input-name" class="form-control form-control-alternative{{ $errors->has('alamat') ? ' is-invalid' : '' }}" placeholder="{{ __('Alamat Karyawan') }}" value="{{ old('alamat') }}" required autofocus>

                                    @if ($errors->has('alamat'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('alamat') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('jabatan') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Jabatan Karyawan') }}</label>
                                    <input type="text" name="jabatan" id="input-name" class="form-control form-control-alternative{{ $errors->has('jabatan') ? ' is-invalid' : '' }}" placeholder="{{ __('Jabatan Karyawan') }}" value="{{ old('jabatan') }}" required autofocus>

                                    @if ($errors->has('jabatan'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('jabatan') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('no_telp') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('No. Telp Karyawan') }}</label>
                                    <input type="number" name="no_telp" id="input-name" class="form-control form-control-alternative{{ $errors->has('no_telp') ? ' is-invalid' : '' }}" placeholder="{{ __('No. Telp Karyawan') }}" value="{{ old('no_telp') }}" required autofocus>

                                    @if ($errors->has('no_telp'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('no_telp') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Tambah Data') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection