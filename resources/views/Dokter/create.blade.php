@extends('layouts.admin')
@section('content')
@include('components.alert')
<div id="Permission" endpoint="{{route('permission.create')}}">
  <div class="card">
    <div class="card-header">{{ $page_title ?? "Create New Permission"}}</div>
    <div class="card-body">
      <form action="{{ route('permission.assign.create')}}" method="post">
        @csrf
        @include("Permission.Role-user.Partials.form-groupt",['submit'=> "Create"])
      </form>
    </div>
  </div>
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h2 class="card-title">{{ $page_title ?? 'List Permission'}}</h2>
      <a href="{{route('permission.create')}}" class="btn btn-primary">Tambah Permission</a>
    </div>
    <div class="card-body">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Have Permission</th>
          </tr>
        </thead>
        <tbody>
          @foreach($roles as $i => $role)
          <tr>
            <td>{{$i+1}}</td>
            <td>{{$role->name}}</td>
            <td>{{implode(", ",$role->getPermissionNames()->toArray())}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
@section("styles")
<link rel="stylesheet" href="\vendor\select2\css\select2.min.css">
@endsection
@push("scripts")
<script src="\vendor\select2\js\select2.min.js"></script>
<script>
  $(document).ready(function() {
    $(".select2").select2({
      placeholder: "Select Permission"
    })
  })
</script>
@endpush