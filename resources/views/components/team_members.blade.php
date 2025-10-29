@props([
    'team_members',
    'total_team_members'
])

<div class="mt-4">
    <div class="d-flex justify-content-between">
        <h3>Team Members</h3>
        <a href="{{ route('invite') }}" class="btn btn-outline-primary">Invite</a>
    </div>
    <div class="table-responsive mt-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Total Generated URLs</th>
                    <th scope="col">Total URL Hits</th>
                </tr>
            </thead>
            <tbody>
                @foreach($team_members as $team_member)
                <tr>
                    <td>{{ $team_member->name }}</td>
                    <td>{{ $team_member->email }}</td>
                    <td>{{ ucwords($team_member->role->value) }}</td>
                    <td>{{ $team_member->urls_count }}</td>
                    <td>{{ $team_member->urls_sum_hits }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if(method_exists($team_members, 'links'))
    {{ $team_members->links() }}
    @else
    <div class="d-flex gap-3">
        <span class="my-auto">
            Showing {{ $team_members->count() }} of total {{ $total_team_members }}
        </span>
        <a href="{{ route('team_members') }}" class="btn btn-outline-primary">View All</a>
    </div>
    @endif
</div>
