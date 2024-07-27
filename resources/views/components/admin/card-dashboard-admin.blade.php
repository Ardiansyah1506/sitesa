
<div class="col-sm-6 col-md-3">
    <div class="card card-stats">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col-icon">
            <div class="icon-big text-center icon-{{ $iconColor }} bubble-shadow-small">
              <i class="fas {{ $icon }}"></i>
            </div>
          </div>
          <div class="col ms-3 ms-sm-0">
            <div class="numbers">
              <p class="card-category">{{ $category }}</p>
              <h4 class="card-title">{{ $value }}</h4>
            </div>
        </div>
        <div class="d-flex justify-content-end">
          <a href="{{ $moreInfo }}">more info</a>
        </div>
        </div>
      </div>
    </div>
  </div>
  