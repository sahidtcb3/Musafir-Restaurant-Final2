<div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{ $pending_orders_count }}</h3>

          <p>Pending Orders</p>
        </div>
        <div class="icon">
          <i class="ion ion-help-circled"></i>
        </div>
        <a href="{{ route('admin.orders.index', ['filter' => 'pending']) }}" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <p>Confirmed Orders</p>
        </div>
        <div class="icon">
          <i class="ion ion-android-globe"></i>
        </div>
        <h3>{{ $confirmed_orders_count }}</h3>
        <a href="{{ route('admin.orders.index', ['filter' => 'confirmed']) }}" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>{{ $rejected_orders_count }}</h3>

          <p>Rejected Orders</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="{{ route('admin.orders.index', ['filter' => 'rejected']) }}" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>{{ $delivered_orders_count }}</h3>

          <p>Delivered Orders</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="{{ route('admin.orders.index', ['filter' => 'delivered']) }}" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div>
 