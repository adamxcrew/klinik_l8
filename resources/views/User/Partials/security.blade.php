<div class="row">
  <div class="col-lg-8">
    <!-- Change password card-->
    <div class="card mb-4">
      <div class="card-header">Change Password</div>
      <div class="card-body">
        <form action="{{route('user.security')}}" method="POST">
          @csrf
          <!-- Form Group (current password)-->
          <div class="form-group">
            <label class="small mb-1" for="currentPassword">Current Password</label>
            <input class="form-control @error('current_password') is-invalid @enderror" id="currentPassword" type="password" name="current_password" placeholder="Enter current password">
            @error('current_password')
            <div class="text-danger mt-2 d-block">{{ $message }}</div>
            @enderror
          </div>
          <!-- Form Group (new password)-->
          <div class="form-group">
            <label class="small mb-1" for="newPassword">New Password</label>
            <input class="form-control @error('password') is-invalid @enderror" id="newPassword" name="password" type="password" placeholder="Enter new password">
            @error('password')
            <div class="text-danger mt-2 d-block">{{ $message }}</div>
            @enderror
          </div>
          <!-- Form Group (confirm password)-->
          <div class="form-group">
            <label class="small mb-1" for="confirmPassword">Confirm Password</label>
            <input class="form-control" id="confirmPassword" type="password" name="password_confirmation" placeholder="Confirm new password">
          </div>
          <button class="btn btn-primary" type="submit">Save</button>
        </form>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <!-- Delete account card-->
    <div class="card mb-4">
      <div class="card-header">Delete Account</div>
      <div class="card-body">
        <p>Deleting your account is a permanent action and cannot be undone. If you are sure you want to delete your account, select the button below.</p>
        <button class="btn btn-danger-soft text-danger" type="button">I understand, delete my account</button>
      </div>
    </div>
  </div>
</div>