<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box {{ $color }}">
      <div class="inner">
        <h3>{{ $value }}</h3>
        {{ $slot }}
      </div>
      <div class="icon">
        <i class="{{ $icon }}"></i>
      </div>
      <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>