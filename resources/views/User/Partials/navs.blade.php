<nav class="nav nav-borders">
  <a class="nav-link{{request()->routeIs('user.profile') ? ' active ml-0' : '' }}" href="{{route('user.profile')}}">Profile</a>
  <a class="nav-link{{request()->routeIs('user.security') ? ' active ml-0' : '' }}" href="{{route('user.security')}}">Security</a>
</nav>