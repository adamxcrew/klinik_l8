@extends('layouts.admin')
@section('content')
@include('components.alert')
<div id="Permission" endpoint="{{route('roles.store')}}">
  <div class="card">
    <div class="card-header">{{ $page_title ?? "Create New Roles"}}</div>
    <div class="card-body">
      <form action="{{ route('permission.role.edit',$role)}}" method="post">
        @csrf
        @method('PUT')
        @include("Pages.Role.Partials.form-groupt")

      </form>
    </div>
  </div>
</div>
@endsection
