@props([
    'short_urls',
    'total_short_urls'
])

<div class="mt-4">
    <div class="d-flex justify-content-between">
        <div class="d-flex flex-row gap-3">
            <h3 class="d-inline my-auto">Generated Short URLs</h3>
            @can('create-short-url')
            <a href="{{ route('generate') }}" class="btn btn-outline-primary">Generate</a>
            @endcan
        </div>
        <div class="d-flex flex-row gap-3">
            <select id="range" class="form-control">
                <option value="this_month">This Month</option>
                <option value="last_month" {{ request()->input('range') === 'last_month' ? 'selected' : ''}}>Last Month</option>
                <option value="last_week" {{ request()->input('range') === 'last_week' ? 'selected' : ''}}>Last Week</option>
                <option value="today" {{ request()->input('range') === 'today' ? 'selected' : ''}}>Today</option>
            </select>
            <div>
                <button id="download" class="btn btn-outline-primary">Download</button>
            </div>
        </div>
    </div>
    <div class="table-responsive mt-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Short URL</th>
                    <th scope="col">Long URL</th>
                    <th scope="col">Hits</th>
                    @if(auth()->user()->isSuperAdmin() || auth()->user()->isAdmin())
                    <th scope="col">Created By</th>
                    @endif
                    <th scope="col">Created On</th>
                </tr>
            </thead>
            <tbody>
                @foreach($short_urls as $short_url)
                <tr>
                    <td>{{ route('shorturl', ['shorturl' => $short_url]) }}</td>
                    <td>{{ $short_url->url }}</td>
                    <td>{{ $short_url->hits }}</td>
                    @if(auth()->user()->isSuperAdmin() || auth()->user()->isAdmin())
                    <td>{{ $short_url->user->name }}</th>
                    @endif
                    <td>{{ $short_url->created_at->format('j M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex gap-3">
        <span class="my-auto">
            Showing {{ $short_urls->count() }} of total {{ $total_short_urls }}
        </span>
        <a href="{{ route('shorturl.index') }}" class="btn btn-outline-primary">View All</a>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', e => {
        document.getElementById('range').addEventListener('change', e => {
            let url = new URL(window.location.href);
            url.searchParams.set('range', e.target.value);
            window.location.href = url.href;
        });
        document.getElementById('download').addEventListener('click', e => {
            e.preventDefault();
            let url = new URL('{{ route('download') }}');
            url.searchParams.set('range', document.getElementById('range').value);
            window.location.href = url.href;
        })
    });
</script>
@endpush
