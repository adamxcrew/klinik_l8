<x-backend-layout>
  <x-slot name="header">
    <div class="page-header-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
        <circle cx="12" cy="7" r="4"></circle>
      </svg></div>
    Account Settings - Profile
  </x-slot>
  @include("User.Partials.navs")
  <hr class="mt-0 mb-4">
  <div class="row">
    <div class="col-xl-4">
      <!-- Profile picture card-->
      <div class="card">
        <div class="card-header">Profile Picture</div>
        <div class="card-body ">
          <div id="imgUpload" endpoint="{{route('user.uploadthumbnail',auth()->user()->id)}}" image="{{auth()->user()->takeThumbnail}}"></div>
        </div>
      </div>
    </div>
    <div class="col-xl-8">
      <!-- Account details card-->
      <div class="card mb-4">
        <div class="card-header">Account Details</div>
        <div class="card-body">
          <form action="{{route('user.profile')}}" method="post">
            @csrf
            @method("PUT")
            <!-- Form Group (username)-->
            <!-- <div class="form-group">
              <label class="small mb-1" for="inputUsername">Username (how your name will appear to other users on the site)</label>
              <input class="form-control" id="inputUsername" type="text" placeholder="Enter your username" value="{{auth()->user()->username}}">
            </div> -->
            <!-- Form Row-->
            <div class="form-row">
              <!-- Form Group (first name)-->
              <div class="form-group col-md-12">
                <label class="small mb-1" for="name">Full Name</label>
                <input class="form-control @error('name') is-invalid @enderror" name="name" id="name" type="text" placeholder="Enter your  name" value="{{ old('name') ?? auth()->user()->name}}">
                @error('name')
                <div class="text-danger mt-2 d-block">{{ $message }}</div>
                @enderror
              </div>

            </div>

            <!-- Form Group (email address)-->
            <div class="form-group">
              <label class="small mb-1" for="inputEmailAddress">Email address</label>
              <input class="form-control" id="inputEmailAddress" type="email" placeholder="Enter your email address" value="{{ old('email') ?? auth()->user()->email}}">
              <span class="text-secondary mt-2">leave blank if you don't want to change</span>
            </div>
            <!-- Form Row-->

            <!-- Save changes button-->
            <button class="btn btn-primary" type="submit">Save changes</button>
          </form>
        </div>
      </div>
    </div>
  </div>

</x-backend-layout>