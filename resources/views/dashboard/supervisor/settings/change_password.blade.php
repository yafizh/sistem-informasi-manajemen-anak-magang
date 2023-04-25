@extends('dashboard.supervisor.layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold text-center">Ganti Password</h4>

        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <form action="/change-password" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card mb-4">
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success text-capitalize" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="mb-3">
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger text-capitalize" role="alert">
                                            {{ $error }}
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="new_password" class="form-label">Password Baru</label>
                                <input type="password" class="form-control" id="new_password" name="new_password"
                                    placeholder="Password Baru" required />
                            </div>
                            <div class="mb-3">
                                <label for="confirm_new_password" class="form-label">Konfirmasi Password Baru</label>
                                <input type="password" class="form-control" id="confirm_new_password"
                                    name="confirm_new_password" placeholder="Konfirmasi Password Baru" required />
                            </div>
                            <div class="mb-3 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Ganti Password</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
