<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Student Management System</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --sidebar-bg: #1e1e2e;
            --sidebar-hover: #2d2d44;
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
        }

        /* Modern Top Navigation */
        .navbar {
            background: var(--primary-gradient) !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            padding: 1rem 1.5rem;
            border: none;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.4rem;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: white !important;
            transition: var(--transition);
        }

        .navbar-brand:hover {
            transform: translateY(-2px);
        }

        .navbar-brand i {
            font-size: 1.6rem;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
        }

        .user-section {
            display: flex;
            align-items: center;
            gap: 1rem;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .user-section span {
            color: white;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .btn-logout {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 0.5rem 1.2rem;
            border-radius: 25px;
            font-weight: 600;
            transition: var(--transition);
            backdrop-filter: blur(10px);
        }

        .btn-logout:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        /* Modern Sidebar */
        .sidebar {
            min-height: calc(100vh - 72px);
            background: var(--sidebar-bg);
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary-gradient);
        }

        .sidebar .nav {
            padding: 1.5rem 0;
        }

        .sidebar .nav-item {
            margin: 0.3rem 1rem;
        }

        .sidebar a {
            color: #b4b4c5;
            text-decoration: none;
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            border-radius: 12px;
            transition: var(--transition);
            font-weight: 500;
            position: relative;
            overflow: hidden;
        }

        .sidebar a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: var(--primary-gradient);
            transform: translateX(-100%);
            transition: var(--transition);
        }

        .sidebar a:hover {
            background: var(--sidebar-hover);
            color: #ffffff;
            transform: translateX(5px);
        }

        .sidebar a:hover::before {
            transform: translateX(0);
        }

        .sidebar a.active {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.2) 0%, rgba(118, 75, 162, 0.2) 100%);
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .sidebar a.active::before {
            transform: translateX(0);
        }

        .sidebar a i {
            font-size: 1.2rem;
            width: 24px;
            text-align: center;
        }

        /* Main Content Area */
        main {
            padding: 2rem;
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Modern Alerts */
        .alert {
            border: none;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            box-shadow: var(--card-shadow);
            backdrop-filter: blur(10px);
            animation: slideDown 0.5s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
            border-left: 4px solid #28a745;
        }

        .alert-danger {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            color: #721c24;
            border-left: 4px solid #dc3545;
        }

        .btn-close {
            filter: brightness(0.8);
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                min-height: auto;
            }

            .user-section {
                flex-direction: column;
                gap: 0.5rem;
                padding: 0.75rem;
            }

            main {
                padding: 1rem;
            }
        }

        /* Content Cards Enhancement */
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        /* SweetAlert2 Custom Styling */
        .swal2-popup {
            border-radius: 16px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .swal2-styled.btn-danger {
            background: #dc3545 !important;
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            margin: 0 0.5rem;
        }

        .swal2-styled.btn-secondary {
            background: #6c757d !important;
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            margin: 0 0.5rem;
        }

        .swal2-styled:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <!-- Modern Top Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-graduation-cap"></i>
                <span>Student Management System</span>
            </a>
          <<div class="user-section">
    <span><i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}</span>
    
    <!-- Profile Button -->
    <a href="{{ route('admin.profile') }}" class="btn btn-sm text-white" style="background: rgba(255, 255, 255, 0.2); border: 1px solid rgba(255, 255, 255, 0.3); padding: 0.5rem 1rem; border-radius: 25px; font-weight: 600; text-decoration: none; transition: all 0.3s;" title="Edit Profile">
        <i class="fas fa-user-cog"></i>
    </a>
    
    <form method="POST" action="{{ route('admin.logout') }}" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-logout btn-sm">
            <i class="fas fa-sign-out-alt me-1"></i> Logout
        </button>
    </form>
</div>

    </nav>

    <div class="container-fluid p-0">
        <div class="row g-0">
            <!-- Modern Sidebar -->
            <nav class="col-md-2 d-md-block sidebar">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}" 
                               href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('students.*') ? 'active' : '' }}" 
                               href="{{ route('students.index') }}">
                                <i class="fas fa-user-graduate"></i>
                                <span>Students</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('teachers.*') ? 'active' : '' }}" 
                               href="{{ route('teachers.index') }}">
                                <i class="fas fa-chalkboard-teacher"></i>
                                <span>Teachers</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('classes.*') ? 'active' : '' }}" 
                               href="{{ route('classes.index') }}">
                                <i class="fas fa-school"></i>
                                <span>Classes</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('subjects.*') ? 'active' : '' }}" 
                               href="{{ route('subjects.index') }}">
                                <i class="fas fa-book"></i>
                                <span>Subjects</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('grades.*') ? 'active' : '' }}" 
                               href="{{ route('grades.index') }}">
                                <i class="fas fa-award"></i>
                                <span>Grades</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('courses.*') ? 'active' : '' }}" 
                               href="{{ route('courses.index') }}">
                                <i class="fas fa-bookmark"></i>
                                <span>Courses</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-10">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>

    <!-- Show SweetAlert for session messages -->
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end',
            timerProgressBar: true,
            customClass: {
                popup: 'colored-toast'
            }
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ session('error') }}',
            timer: 3000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end',
            timerProgressBar: true,
            customClass: {
                popup: 'colored-toast'
            }
        });
    </script>
    @endif

    @stack('scripts')
</body>
</html>