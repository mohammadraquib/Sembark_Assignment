@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    {{-- Show Clients Table if the logged in user is SuperAdmin --}}
    @if($user->isSuperAdmin())
        <x-clients :clients="$clients" :total_clients="$total_clients" />
    @endif
    {{-- Show Short URLS for all the users --}}
    <x-short_urls :short_urls="$short_urls" :total_short_urls="$total_short_urls"/>
    {{-- Show Team Members table if the logged in user is Admin --}}
    @if($user->isAdmin())
        <x-team_members :team_members="$team_members" :total_team_members="$total_team_members"/>
    @endif
@endsection
