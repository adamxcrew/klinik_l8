@if($type=='success' || session("success"))
<div class="alert alert-primary alert-icon" role="alert">
  <button class="close" type="button" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">×</span>
  </button>
  <div class="alert-icon-aside">
    <i class="far fa-flag"></i>
  </div>
  <div class="alert-icon-content">
    <h6 class="alert-heading">Sucses!</h6>
    {{ $message ?? session('success') }}
  </div>
</div>
@elseif($type=='danger'|| session("danger"))

<div class="alert alert-danger alert-icon" role="alert">
  <button class="close" type="button" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">×</span>
  </button>
  <div class="alert-icon-aside">
    <i data-feather="feather"></i>
  </div>
  <div class="alert-icon-content">
    <h6 class="alert-heading">Danger!</h6>
    {{ $message ?? session('danger') }}
  </div>
</div>
@endif