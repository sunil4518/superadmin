<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="index.php" class="logo logo-light">
            <span class="logo-sm">
                <img src="assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-light.png" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>
    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-Menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="index.php" role="button" aria-expanded="false"
                        aria-controls="sidebarDashboards">
                        <i class="fas fa-chart-line"></i> <span data-key="t-dashboards">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item"> 
                    <a class="nav-link menu-link" href="#EmployeeManagement" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="EmployeeManagement">
                        <i class="fas fa-network-wired"></i>
                        <span data-key="t-base-ui">Employee Management</span>
                    </a>
                    <div class="collapse menu-dropdown mega-dropdown-menu" id="EmployeeManagement">
                        <div class="row">
                            <div class="col-lg-4">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="Branch.php" class="nav-link" data-key="t-alerts">Branch</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="Department.php" class="nav-link" data-key="t-alerts">Department</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="Designation.php" class="nav-link" data-key="t-alerts">Designation</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="Employees.php" class="nav-link" data-key="t-alerts">Employees</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#SalesManagement" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="SalesManagement">
                        <i class="fas fa-users"></i>
                        <span data-key="t-base-ui">Sales Management</span>
                    </a>
                    <div class="collapse menu-dropdown mega-dropdown-menu" id="SalesManagement">
                        <div class="row">
                            <div class="col-lg-4">
                                <ul class="nav nav-sm flex-column">


                                    <li class="nav-item">
                                        <a href="" class="nav-link" data-key="t-alerts">Department
                                            List</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#ServiceManagement" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="ServiceManagement">
                        <i class="fas fa-wrench"></i>
                        <span data-key="t-base-ui">Service Management</span>
                    </a>
                    <div class="collapse menu-dropdown mega-dropdown-menu" id="ServiceManagement">
                        <div class="row">
                            <div class="col-lg-4">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" data-key="t-alerts">Designation
                                            List</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#ClientManagement" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="ClientManagement">
                        <i class="fas fa-user"></i>
                        <span data-key="t-base-ui">Client Management</span>
                    </a>
                    <div class="collapse menu-dropdown mega-dropdown-menu" id="ClientManagement">
                        <div class="row">
                            <div class="col-lg-4">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" data-key="t-alerts">Designation
                                            List</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#AccountsManagement" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="AccountsManagement">
                        <i class="fas fa-calculator"></i>
                        <span data-key="t-base-ui">Accounts Management</span>
                    </a>
                    <div class="collapse menu-dropdown mega-dropdown-menu" id="AccountsManagement">
                        <div class="row">
                            <div class="col-lg-4">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" data-key="t-alerts">Designation
                                            List</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#Compliances" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="Compliances">
                        <i class="fas fa-file-invoice"></i>
                        <span data-key="t-base-ui">Compliances</span>
                    </a>
                    <div class="collapse menu-dropdown mega-dropdown-menu" id="Compliances">
                        <div class="row">
                            <div class="col-lg-4">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" data-key="t-alerts">Designation
                                            List</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#Reports" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="Reports">
                        <i class="fas fa-chart-pie"></i>
                        <span data-key="t-base-ui">Reports</span>
                    </a>
                    <div class="collapse menu-dropdown mega-dropdown-menu" id="Reports">
                        <div class="row">
                            <div class="col-lg-4">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link" data-key="t-alerts">Designation
                                            List</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#Security" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="Security">
                        <i class="fas fa-lock"></i>
                        <span data-key="t-base-ui">Security</span>
                    </a>
                    <div class="collapse menu-dropdown mega-dropdown-menu" id="Security">
                        <div class="row">
                            <div class="col-lg-4">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="User_Access.php" class="nav-link" data-key="t-alerts">User Access</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="pages-profile-settings.php" class="nav-link" data-key="t-alerts">Profile Settings</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
           
            </ul>
        </div>
    </div>
    <div class="sidebar-background"></div>
</div>