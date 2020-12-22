<div class="form-group">
  <label for="email">Email Users</label>
  <input type="text" id="email" name="email" value="{{ old('email')?? $user->email}}" class="form-control">
  @error("email")
  <div class="text-danger d-block mt-2">{{$message}}</div>
  @enderror
</div>
<div class="form-group">
  <label for="roles">Roles</label>
  <select name="roles[]" id="role" class="form-control select2" multiple>
    @foreach($roles as $rl)
    <option {{ $user->roles()->find($rl->id) ? 'selected' :''}} value="{{$rl->id}}">{{$rl->name}}</option>
    @endforeach
  </select>
  @error("roles")
  <div class="text-danger d-block mt-2">{{$message}}</div>
  @enderror
</div>

<div class="form-group"><input type="submit" value="{{$submit ?? 'Create'}}" class="btn btn-primary"></div>