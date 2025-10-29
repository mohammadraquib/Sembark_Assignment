@extends('layouts.app')

@section('title', 'Team Members')

@section('content')
<x-team_members :team_members="$team_members" :total_team_members="$team_members->count()" />
@endsection
