<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{route('home')}}">
              <i class="ti-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
         {{--  <li class="nav-item">
            <a class="nav-link" href="{{route('attendance.own')}}">
              <i class="ti-home menu-icon"></i>
              <span class="menu-title">Attendance</span>
            </a>
          </li> --}}
            
         {{--  <li class="nav-item">
            <a class="nav-link" href="{{route('attendance.own.old')}}">
              <i class="ti-home menu-icon"></i>
              <span class="menu-title">Attendance OLD</span>
            </a>
          </li>
            <li class="nav-item">
            <a class="nav-link" href="{{route('attendance.approve.index.old')}}">
              <i class="ti-home menu-icon"></i>
              <span class="menu-title">Approve Old</span>
            </a>
          </li> --}}
          @if (Auth::user()->email !="lg@gmail.com" )
          @hasanyrole('super-admin|admin')
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="ti-layers-alt menu-icon"></i>
                <span class="menu-title">HR Structure</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('company.index')}}">
                        <i class="ti-settings menu-icon"></i>
                        <span class="menu-title">Comapny</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('sub-department.index')}}">
                        <i class="ti-settings menu-icon"></i>
                        <span class="menu-title">Sub Department</span>
                      </a>
                    </li> 

                    <li class="nav-item">
                      <a class="nav-link" href="{{route('department.index')}}">
                        <i class="ti-settings menu-icon"></i>
                        <span class="menu-title">Department</span>
                      </a>
                    </li> 
                   <li class="nav-item">
                      <a class="nav-link" href="{{route('designation.index')}}">
                        <i class="ti-settings menu-icon"></i>
                        <span class="menu-title">Designation</span>
                      </a>
                    </li>  
                  {{-- <li class="nav-item"> <a class="nav-link" href="pages/samples/lock-screen.html"> Lockscreen </a></li> --}}
                </ul>
              </div>
          </li>
     
  
           <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#employee" aria-expanded="false" aria-controls="employee">
                <i class="ti-layers-alt menu-icon"></i>
                <span class="menu-title">Manage Employee</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="employee">
                <ul class="nav flex-column sub-menu">
                     <li class="nav-item">
                      <a class="nav-link" href="{{route('add-employee')}}">
                        <i class="ti-settings menu-icon"></i>
                        <span class="menu-title">Employee</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('profile.approve.index')}}">
                        <i class="ti-settings menu-icon"></i>
                        <span class="menu-title">Approve Informartion</span>
                      </a>
                    </li>
                    
                </ul>
              </div>
          </li>
           {{-- else spatie roles --}}
          @else
          {{-- else display --}}
    @endhasanyrole
           <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#attendance" aria-expanded="false" aria-controls="attendance">
                <i class="ti-layers-alt menu-icon"></i>
                <span class="menu-title">Manage Attendance</span>
                <i class="menu-arrow"></i>
              </a>
              
              <div class="collapse" id="attendance">
                <ul class="nav flex-column sub-menu">
                   <li class="nav-item">
                      <a class="nav-link" href="{{route('attendance.own')}}">
                        <i class="ti-home menu-icon"></i>
                        <span class="menu-title">Attendance</span>
                      </a>
                    </li>
                    @hasallroles('super-admin')
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('attendance.approve.index')}}">
                        <i class="ti-home menu-icon"></i>
                        <span class="menu-title">Approve</span>
                      </a>
                    </li> 
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('attendance.single.index')}}">
                        <i class="ti-home menu-icon"></i>
                        <span class="menu-title">Add Single Attendance</span>
                      </a>
                    </li>
                  {{-- else spatie roles --}}
                      @else
          {{-- else display --}}
            @endhasallroles
                    
                  {{-- <li class="nav-item"> <a class="nav-link" href="pages/samples/lock-screen.html"> Lockscreen </a></li> --}}
                </ul>
              </div>
          </li>
       @endif 
            {{-- expr --}}
       @hasanyrole('super-admin|admin')
          <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#lead_generation" aria-expanded="false" aria-controls="lead_generation">
                <i class="ti-layers-alt menu-icon"></i>
                <span class="menu-title">Lead Generation</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="lead_generation">
                <ul class="nav flex-column sub-menu">
                     <li class="nav-item">
                      <a class="nav-link" href="{{route('lead.industry.index')}}">
                        <i class="ti-settings menu-icon"></i>
                        <span class="menu-title">Industry</span>
                      </a>
                    </li>  
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('lead.subindustry.index')}}">
                        <i class="ti-settings menu-icon"></i>
                        <span class="menu-title">Sub Industry</span>
                      </a>
                    </li>  
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('lead.productorservice.index')}}">
                        <i class="ti-settings menu-icon"></i>
                        <span class="menu-title">Product or Service</span>
                      </a>
                    </li> 
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('lead.company.index')}}">
                        <i class="ti-settings menu-icon"></i>
                        <span class="menu-title">Organization</span>
                      </a>
                    </li> 
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('lead.brand.index')}}">
                        <i class="ti-settings menu-icon"></i>
                        <span class="menu-title">Brand</span>
                      </a>
                    </li> 
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('lead.brandservice.index')}}">
                        <i class="ti-settings menu-icon"></i>
                        <span class="menu-title">BrandCompanyServices</span>
                      </a>
                    </li>
                </ul>
              </div>
          </li>
           {{-- else spatie roles --}}
          @else
          {{-- else display --}}
    @endhasanyrole
         
        {{--   <li class="nav-item">
            <a class="nav-link" href="{{route('add-employee')}}">
              <i class="ti-settings menu-icon"></i>
              <span class="menu-title">Employee</span>
            </a>
          </li>
         <li class="nav-item">
            <a class="nav-link" href="{{route('designation.index')}}">
              <i class="ti-settings menu-icon"></i>
              <span class="menu-title">Designation</span>
            </a>
          </li>  
          <li class="nav-item">
            <a class="nav-link" href="{{route('sub-department.index')}}">
              <i class="ti-settings menu-icon"></i>
              <span class="menu-title">Sub Department</span>
            </a>
          </li> 
          <li class="nav-item">
            <a class="nav-link" href="{{route('department.index')}}">
              <i class="ti-settings menu-icon"></i>
              <span class="menu-title">Department</span>
            </a>
          </li> 
          <li class="nav-item">
            <a class="nav-link" href="{{route('company.index')}}">
              <i class="ti-settings menu-icon"></i>
              <span class="menu-title">comapny</span>
            </a>
          </li> --}}
           
        
        
        </ul>
      </nav>
