@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h3 class="mb-0">{{ __('Data Karyawan Dealer') }}</h3>
                            </div>
                            <div class="col-6 text-right">
                                <a href="{{ route('karyawan.create') }}" class="btn btn-sm btn-primary">{{ __('Tambah Data') }}</a>
                            </div>
                        </div>
                    </div>
                    
                    {{-- SEARCH FORM --}}
                    <div class="col-12" style="margin-bottom:10px;">
                        <form action="{{route('karyawan.index')}}" method="GET" autocomplete="off">
                            <input type="text" minlength="3" name="search" class="form-control" placeholder="Cari nama karyawan.." <?php if(isset($_GET['search'])){ echo 'value="'.$_GET['search'].'"'; }{ echo 'value=""'; }?> >
                        </form>
                    </div>
                    
                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">{{ __('No.') }}</th>
                                        <th scope="col">{{ __('HSO ID') }}</th>
                                        <th scope="col">{{ __('Honda ID') }}</th>
                                        <th scope="col">{{ __('Nama Karyawan') }}</th>
                                        <th scope="col">{{ __('Jabatan') }}</th>
                                        <th scope="col">{{ __('Group') }}</th>
                                        <th scope="col">{{ __('Kode') }}</th>
                                        <th scope="col">{{ __('Dealer') }}</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $user->hso_id }}</td>
                                            <td>{{ $user->honda_id }}</td>
                                            <td>{{ $user->nama }}</td>
                                            <td>{{ $user->jabatan }}</td>
                                            <td>{{ $user->group }}</td>
                                            <td>{{ $user->kode }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <form action="{{ route('dealer.destroy', $user->id) }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            
                                                            <a class="dropdown-item" href="{{ route('dealer.edit', $user->id) }}">{{ __('Edit') }}</a>
                                                            <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
                                                                {{ __('Delete') }}
                                                            </button>
                                                        </form>    
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $users->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>
@endsection