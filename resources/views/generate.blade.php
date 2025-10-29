@extends('layouts.app')

@section('title', 'Generate')

@section('content')
<div class="mt-4">
    <div class="d-flex">
        <h3>Generate Short URL</h3>
    </div>
    <div class="card mt-3">
        <div class="card-body">
            @if(session('short_url'))
            <div class="alert alert-success">
                <p class="mb-0">
                    <strong>Short URL Generated!</strong> Your Short URL has been generated copy it from below.
                </p>
            </div>
            <div class="input-group mb-3">
                <input type="url" value="{{ session('short_url') }}" class="form-control" id="short_url" readonly>
                <button type="button" class="btn btn-secondary" id="copy">Copy</button>
            </div>
            @endif
            <form action="{{ route('generate') }}" method="POST">
                <div class="form-floating mb-3">
                    <input type="url" name="url" id="url" class="form-control @error('url') is-invalid @enderror" placeholder="Long URL" value="{{ old('url') }}" required>
                    <label for="url">Long URL</label>
                    @error('url')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
                @csrf
                <div>
                    <button type="submit" class="btn btn-outline-primary">
                        Generate
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@if(session('short_url'))
<script>
    document.addEventListener('DOMContentLoaded', e => {
        let shortUrlInput = document.getElementById('short_url');
        document.getElementById('copy').addEventListener('click', e => {
            e.preventDefault();
            try {
                navigator.clipboard.writeText(shortUrlInput.value);
                window.alert('Copied!');
            } catch (err) {
                window.alert('Error!');
            }
        });
    });
</script>
@endif
@endpush
