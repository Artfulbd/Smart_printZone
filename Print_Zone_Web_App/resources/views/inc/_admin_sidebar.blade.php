<nav class="sidebar sidebar-offcanvas" id="sidebar" style="background: linear-gradient(to top, #e388bf, #1a4aa1);" >
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="profile-image">
                    <img class="img-xs rounded-circle" src="assets/images/faces/face8.jpg" alt="profile image">
                    <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                    <p class="profile-name">{{auth()->user()->name}}</p>
                    <p class="designation">
                        @if(strtolower(auth()->user()->role) == 'super_admin')
                            Super Admin
                        @elseif(strtolower(auth()->user()->role) == 'admin_1')
                            Admin 1
                        @endif
                    </p>
                </div>
            </a>
        </li>
        <li class="nav-item nav-category">Main Menu</li>
        <li class="nav-item">
            <a class="nav-link" href="/admin_landing">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        {{-----------Print System Starts--------------}}
        <li class="nav-item">
            {{--<a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">--}}
            <a class="nav-link" data-toggle="collapse" href="#print_system" aria-expanded="false" aria-controls="print_system">
                <i class="menu-icon typcn typcn-document-add"></i>
                <span class="menu-title">Print System</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse multi-collapse" id="print_system">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="/on_off_system"> On/Off System</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/view_print_setting"> Print Setting </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/"> Make Default Setting </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/"> Add Page to new User </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/"> Set Default Count </a>
                    </li>
                </ul>
            </div>
        </li>
        {{-----------Print System Ends----------------}}


        {{-----------Manage Admins Starts--------------}}
        <li class="nav-item">
            <a class="nav-link" href="/view_manage_admin">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Manage Admin</span>
            </a>
        </li>

        {{-----------Manage Admin Ends----------------}}




        {{-----------Manage Students Starts--------------}}
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#manage_student" aria-expanded="false" aria-controls="manage_student">
                <i class="menu-icon typcn typcn-document-add"></i>
                <span class="menu-title">Manage Students</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse multi-collapse" id="manage_student">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="/"> Add New Student</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/"> Remove Student</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/"> Deactivate Student </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/"> Active Student </a>
                    </li>
                </ul>
            </div>
        </li>
        {{-----------Manage Students Ends----------------}}





        {{-----------View Admin History Starts--------------}}
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#view_admin_history" aria-expanded="false" aria-controls="view_admin_history">
                <i class="menu-icon typcn typcn-document-add"></i>
                <span class="menu-title">View Admin History</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse multi-collapse" id="view_admin_history">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="/"> By Name</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/"> By Action</a>
                    </li>
                </ul>
            </div>
        </li>
        {{-----------View Admin History Ends----------------}}




        {{-----------View Student History Starts--------------}}
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#view_student_history" aria-expanded="false" aria-controls="view_student_history">
                <i class="menu-icon typcn typcn-document-add"></i>
                <span class="menu-title">View Student History</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse multi-collapse" id="view_student_history">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="/"> Single Student</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/"> By Date</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/"> By Batch</a>
                    </li>
                </ul>
            </div>
        </li>
        {{-----------View Student History Ends----------------}}



        {{--<li class="nav-item">
            <a class="nav-link" href="/print_pdf">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Print PDF</span>
            </a>
        </li>--}}


        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                <i class="menu-icon typcn typcn-shopping-bag"></i>
                <span class="menu-title">Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>

    </ul>
</nav>


