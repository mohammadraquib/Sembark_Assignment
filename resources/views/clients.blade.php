@extends('layouts.app')

@section('title', 'Clients')

@section('content')
<x-clients :clients="$clients" :total_clients="$clients->count()"/>
@endsection
