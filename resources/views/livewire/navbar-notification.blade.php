<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
      <i class="far fa-bell"></i>
        <span class="badge badge-danger navbar-badge">{{$totalNotifications}}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-xlg dropdown-menu-right">
      <span class="dropdown-header">Notifications</span>
      @forelse ($expiryMedicines as $expiryMedicine)
        <div class="dropdown-divider"></div>
        <a href="" class="dropdown-item">
            <i class="fas fa-clipboard-list"></i>
            {{-- @if ($expiryMedicine->bundleCount > 1)
                {{$expiryMedicine->bundleCount}}
            @endif --}}
            {{$expiryMedicine->stockCount ." pieces of "}} <strong>{{ucfirst($expiryMedicine->name)}}</strong> is about to expire
        </a>
      @empty
        <div class="dropdown-divider"></div>
        <a href="" class="dropdown-item">
            <i class="fas fa-clipboard-list"></i>
            Nothing Notification
        </a>
      @endforelse
    </div>
</li>
