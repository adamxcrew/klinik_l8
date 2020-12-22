   <div class="form-group">

     <label for="menu_id">Menu</label>
     <select name="menu_id" id="menu_id" class="form-control   @error('menu_id') is-invalid @enderror">
       <option selected disabled>Select Menu</option>
       @foreach($menus as $menu)
       <option @if($navigation->menu) {{ $navigation->menu->id == $menu->id ? 'selected' :''}} @endif value="{{$menu->id}}">{{$menu->name}}</option>
       @endforeach
     </select>
     @error("menu_id")
     <div class="text-danger d-block mt-2">{{$message}}</div>
     @enderror
   </div>
   <div class="form-group">
     <label for="parent">Parent</label>
     <select name="parent" id="parent" class="form-control">
       <option selected value="">Choose Parent</option>
       @foreach($navigations as $nv)
       @if($navigation->id != $nv->id && (!$nv->parent_id && !$nv->url))
       <option {{ $navigation->parent_id == $nv->id ? 'selected' :''}} value="{{$nv->id}}">{{$nv->name}}</option>
       @endif
       @endforeach
     </select>
     @error("parent")
     <div class="text-danger d-block mt-2">{{$message}}</div>
     @enderror
   </div>
   <div class="form-group">
     <label for="permission">Permission</label>
     <select name="permission" id="permission" class="select2 form-control ">
       <!-- <option selected disabled>Choose Permission</option> -->
       @foreach($permissions as $perms)
       <option {{ old('permission')== $perms->name  ? 'selected':  ($navigation->permission_name === $perms->name ? 'selected' : '')}} value="{{$perms->name}}">{{$perms->name}}</option>
       @endforeach
     </select>
     @error("permission")
     <div class="text-danger d-block mt-2">{{$message}}</div>
     @enderror
   </div>
   <div class="row">
     <div class="col-md-6">
       <div class="form-group">
         <label for="name">Name</label>
         <input type="text" name="name" id="name" class="form-control" value="{{old('name') ?? $navigation->name}}">
         @error('name')
         <span class="text-danger d-block">{{$message}}</span>
         @enderror
       </div>
     </div>
     <div class="col-md-6">
       <div class="form-group">
         <label for="url">URL</label>
         <input type="text" name="url" id="url" class="form-control" value="{{old('url') ?? $navigation->url}}">
         @error('url')
         <span class="text-danger d-block">{{$message}}</span>
         @enderror
       </div>

     </div>
   </div>
   <div class="form-group"><input type="submit" value="{{$submit ?? 'Create'}}" class="btn btn-primary"></div>