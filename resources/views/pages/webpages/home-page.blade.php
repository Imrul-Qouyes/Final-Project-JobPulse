@extends('layout.app')

@section('content')
  @include('components.home.header')
  @include('components.home.hero')
  @include('components.home.topcompanies')
  @include('components.home.recentpublishedjob')
  @include('components.home.footer')
@endsection