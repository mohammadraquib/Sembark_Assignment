@extends('layouts.app')

@section('title', 'Short URLs')

@section('content')
<div class="mt-4">
    <div class="d-flex justify-content-between">
        <h3>Generated Short URLs</h3>
        <div class="d-flex flex-row gap-3">
            {{-- todo --}}
        </div>
    </div>
    <div class="table-responsive mt-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Short URL</th>
                    <th scope="col">Long URL</th>
                    <th scope="col">Hits</th>
                    <th scope="col">Created By</th>
                    <th scope="col">Created On</th>
                </tr>
            </thead>
            <tbody>
                @foreach($short_urls as $short_url)
                <tr>
                    <td>{{ route('shorturl', ['shorturl' => $short_url]) }}</td>
                    <td>{{ $short_url->url }}</td>
                    <td>{{ $short_url->hits }}</td>
                    <td>{{ $short_url->user->name }}</td>
                    <td>{{ $short_url->created_at->format('j M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $short_urls->links() }}
</div>
@endsection
