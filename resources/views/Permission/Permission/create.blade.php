@extends('layouts.admin')
@section('content')
@include('components.alert')
<div id="Permission" endpoint="{{route('permission.create')}}">
  <div class="card">
    <div class="card-header">{{ $page_title ?? "Create New Permission"}}</div>
    <div class="card-body">
      <form action="{{ route('permission.create')}}" method="post">
        @csrf
        @include("Pages.Permission.Partials.form-groupt",['submit'=> "Create"])
      </form>
    </div>
  </div>
</div>
@endsection
