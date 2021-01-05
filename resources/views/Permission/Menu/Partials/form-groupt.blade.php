<div class="form-group">Name Menu</label>
  <input class="form-control @error('name') is-invalid @enderror" id="nameMenu" name="name" placeholder="ex: Menu" value="{{old('name') ?? $menu->name}}">
  @error('name')
  <div class="text-danger mt-2 d-block">{{ $message }}</div>
  @enderror
</div>
<div class="form-group">
  <label for="sequence_number">Nomor Urut</label>
  <input type="text" name="sequence_number" id="sequence_number" class="form-control" value="{{old('sequence_number') ?? $menu->sequence_number}}">
  @error('sequence_number')
  <span class="text-danger d-block">{{$message}}</span>
  @enderror
</div>
<div class="form-group"><input type="submit" value="{{$submit ?? 'Create'}}" class="btn btn-primary"></div>