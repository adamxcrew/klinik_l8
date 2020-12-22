   <div class="form-group">
     <label for="role">Role</label>
     <select name="role" id="role" class="form-control">
       <option selected disabled>Select Role</option>
       @foreach($roles as $rl)
       <option {{ $role->id == $rl->id ? 'selected' :''}} value="{{$rl->id}}">{{$rl->name}}</option>
       @endforeach
     </select>
     @error("role")
     <div class="text-danger d-block mt-2">{{$message}}</div>
     @enderror
   </div>
   <div class="form-group">
     <label for="permission">Permission</label>
     <select name="permissions[]" id="permission" class="form-control select2" multiple>
       @foreach($permissions as $permission)
       <option {{ $role->permissions()->find($permission->id) ? 'selected' : ''}} value="{{$permission->id}}">{{$permission->name}}</option>
       @endforeach
     </select>
     @error("permissions")
     <div class="text-danger d-block mt-2">{{$message}}</div>
     @enderror
   </div>
   <div class="form-group"><input type="submit" value="{{$submit ?? 'Create'}}" class="btn btn-primary"></div>