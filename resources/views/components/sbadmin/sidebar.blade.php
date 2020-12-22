<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">{{config('app.name')}}</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
    <a class="nav-link" href="index.html">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  @foreach($menus as $menu)
  <!-- Heading -->
  @if(count($menu->navigations)>0)
  <div class="sidebar-heading">
    {{$menu->name}}
  </div>
  @endif

  <!-- Nav Item - Pages Collapse Menu -->
  @foreach($menu->navigations as $navigation)
  @can($navigation->permission_name)
  <li class="nav-item" id="{{$navigation->permission_name}}">
    @if($navigation->url)
    <a class="nav-link" href="#link">
      <i class="fas fa-fw fa-cog"></i>
      <span>{{$navigation->name}}</span>
    </a>
    @else
    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapse-{{$navigation->id}}" aria-controls="collapse{{$navigation->permission_name}}">
      <i class="fas fa-fw fa-folder"></i>
      <span> {{$navigation->name}}</span>
    </a>
    <div id="collapse-{{$navigation->id}}" class="collapse" aria-labelledby="headingPermission" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Header {{substr($navigation->name,0,16)}}:</h6>
        @foreach($navigation->children as $child)
        <a class="collapse-item{{request()->is($child->url)  || request()->is($child->url.'/*') ? ' active' :''}}" href="{{url($child->url)}}">{{$child->name}}</a>
        @endforeach
      </div>
    </div>
    @endif

  </li>
  @endcan
  @endforeach

  @if(count($menu->navigations)>0)
  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">
  @endif
  @endforeach


  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<script>
  let collapItem = document.querySelectorAll(".collapse-item");
  collapItem.forEach(item => {
    if (item.classList.contains("active")) {
      item.closest(".collapse").classList.add("show")
    }
  })
</script>