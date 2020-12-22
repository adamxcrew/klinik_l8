     <div class="form-group">
       <label for="nameRole">Name</label>
       <input class="form-control @error('name') is-invalid @enderror" id="nameRole" name="name" value="{{old('name') ?? $role->name ?? ''}}" placeholder="ex: 'super admin'">
       @error('name')
       <div class="text-danger mt-2 d-block">{{ $message }}</div>
       @enderror
     </div>
     <div class="form-group">
       <label for="guard_name">Guard Name</label>
       <input type="text" name="guard_name" id="guard_name" value="{{ old('guard_name')?? $role->guard_name ?? ''}}" class="form-control  @error('guard_name') is-invalid @enderror">
       @error('guard_name')
       <div class="text-danger mt-2 d-block">{{ $message }}</div>
       @enderror
     </div>
     <div class="form-group"><input type="submit" value="{{$submit ?? 'Create'}}" class="btn btn-primary"></div>