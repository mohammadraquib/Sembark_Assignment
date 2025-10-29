@props([
    'clients',
    'total_clients'
])

<div class="mt-4">
    <div class="d-flex justify-content-between">
        <h3>Clients</h3>
        <a href="{{ route('invite') }}" class="btn btn-outline-primary">Invite</a>
    </div>
    <div class="table-responsive mt-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Client Name</th>
                    <th scope="col">Users</th>
                    <th scope="col">Total Generated URLs</th>
                    <th scope="col">Total URL Hits</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                <tr>
                    <td>{{ $client->name }}<br><small>{{ $client->email }}</small></td>
                    <td>{{ $client->users_count }}</td>
                    <td>{{ $client->urls_count }}</td>
                    <td>{{ $client->urls_sum_hits ?? 0 }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if(method_exists($clients, 'links'))
    {{ $clients->links() }}
    @else
    <div class="d-flex gap-3">
        <span class="my-auto">
            Showing {{ $clients->count() }} of total {{ $total_clients }}
        </span>
        <a href="{{ route('clients') }}" class="btn btn-outline-primary">View All</a>
    </div>
    @endif
</div>
