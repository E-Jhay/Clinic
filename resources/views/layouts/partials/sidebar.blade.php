<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('dashboard')}}" class="brand-link">
      <img src="{{ asset('dist/img/psu.png') }}" alt="PSU Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name', 'Clinic Office') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('dist/img/user3.png') }}" class="img-circle elevation-3" alt="User Image">
        </div>
        <div class="info">
          {{Auth::user()->name}}
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{route('dashboard')}}" class="nav-link 
              {{ request()->is('dashboard') ? 'active' : null }}
            ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="" class="nav-link {{ request()->is('health-profile') || request()->is('daily-treatment-record') || request()->is('patient-records') ? 'active' : null }}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Medical Record
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('health-profile') }}" class="nav-link">
                  <i class="nav-icon fas fa-table"></i>
                  <p>
                    Health Profile
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('daily-treatment-record') }}" class="nav-link">
                  <i class="nav-icon fas fa-table"></i>
                  <p>
                    DTR Form
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('patient-records') }}" class="nav-link">
                  <i class="nav-icon fas fa-table"></i>
                  <p>
                    Patient Records
                  </p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="" class="nav-link {{ request()->is('monthly-reports') || request()->is('quarterly-reports') ? 'active' : null }}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Clinic Reports
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('medicine-monthly-report')}}" class="nav-link">
                  <i class="nav-icon fas fa-table"></i>
                  <p>
                    Medicine Reports
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('medical-services-monthly-report')}}" class="nav-link">
                  <i class="nav-icon fas fa-table"></i>
                  <p>
                    Medical Services
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('medical-illness-monthly-report')}}" class="nav-link">
                  <i class="nav-icon fas fa-table"></i>
                  <p>
                    Medical Illness
                  </p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="" class="nav-link {{ request()->is('medicine') || request()->is('supply') || request()->is('equipment') ? 'active' : null }}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Inventory
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('medicine')}}" class="nav-link">
                  <i class="nav-icon fas fa-table"></i>
                  <p>
                    Medicines
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('supply')}}" class="nav-link">
                  <i class="nav-icon fas fa-table"></i>
                  <p>
                    Supplies
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('equipment')}}" class="nav-link">
                  <i class="nav-icon fas fa-table"></i>
                  <p>
                    Equipments
                  </p>
                </a>
              </li>
            </ul>
          </li>
          {{-- 
          <li class="nav-header">
            Interface
          </li>
          <li class="nav-item">
            <a href="{{route('orders.index')}}" class="nav-link
              {{ request()->is('orders') ? 'active' : null }}
            ">
              <i class="nav-icon fas fa-paperclip"></i>
              <p>
                Requests
              </p>
            </a>
          </li>
          
          <li class="nav-item has-treeview">
            <a href="" class="nav-link {{ request()->is('monthly-reports') || request()->is('quarterly-reports') ? 'active' : null }}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Generate Report
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('monthly-reports')}}" class="nav-link">
                  <i class="nav-icon fas fa-table"></i>
                  <p>
                    Monthly Report
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('quarterly-reports')}}" class="nav-link">
                  <i class="nav-icon fas fa-table"></i>
                  <p>
                    Quarterly Report
                  </p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{route('documents')}}" class="nav-link
            {{ request()->is('documents') ? 'active' : null }}">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Document Types
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('accounts')}}" class="nav-link
            {{ request()->is('accounts') ? 'active' : null }}">
              <i class="nav-icon fas fa-user-circle"></i>
              <p>
                Accounts
              </p>
            </a>
          </li> --}}
          <li class="nav-item">
            {{-- <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"> --}}
            <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form> --}}
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>