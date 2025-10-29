@extends('layouts.app')

@section('title', 'Invite')

@section('content')
<div class="mt-4">
    <div class="d-flex">
        <h3>Invite Team Member</h3>
    </div>
    <div class="card mt-3">
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success mb-3">
                <p class="mb-0">{{ session('success') }}</p>
            </div>
            @endif
            <form action="{{ route('invite')}}" method="POST">
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <div class="form-floating mb-3">
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{ old('name') }}" required>
                            <label for="name">Name</label>
                            @error('name')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="form-floating mb-3">
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required>
                            <label for="email">Email</label>
                            @error('email')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    @if(auth()->user()->isAdmin())
                    <div class="col-sm-12 col-md-4">
                        <div class="form-floating mb-3">
                            <select name="role" id="role" class="form-control @error('role') is-invalid @enderror" placeholder="Role" required>
                                <option value="member" selected>Member</option>
                                <option value="admin">Admin</option>
                            </select>
                            <label for="role">Role</label>
                            @error('role')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    @endif
                </div>
                @csrf
                <div class="d-flex">
                    <button type="submit" class="btn btn-outline-primary">Send Invitation</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
