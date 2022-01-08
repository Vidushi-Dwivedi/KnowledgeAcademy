<body>
  <!-- top head bar -->
  <nav class="navbar navbar-light bg-light top">
  <img class="navbar-brand " src="..\images\logo1.png" alt="Knowledge Academy Logo">
  </nav>

  <!-- second bar with links -->
  <nav class="navbar navbar-expand-lg second  nav-fill w-fill">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"><i class="fas fa-ellipsis-h"></i></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav justify-content-between w-100">
      <li class="nav-item active">
        <a class="nav-link" href="profile.php"><i class="fas fa-home ico"></i> Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-graduation-cap ico"></i> Academic Info
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="showscheme.php"><i class="fas fa-pen-alt ico"></i> Scheme</a>
          <a class="dropdown-item" href="showsyllabus.php"><i class="fas fa-journal-whills ico"></i> Syllabus</a>
          <a class="dropdown-item" href="showtimetable.php"><i class="fas fa-calendar-alt ico"></i> Timetable</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-tasks ico"></i> Attendance
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="student_attendance_portal.php?i=0"><i class="fas fa-pen-alt ico"></i> View/Edit Student Attendance</a>
          <a class="dropdown-item" href="log_student_attendance.php"><i class="fas fa-clipboard-check"></i> Log Student Attendance</a>
          <a class="dropdown-item" href="view_self_attendance.php"><i class="fas fa-calendar-alt ico"></i> View Self Attendance</a>
          <a class="dropdown-item" href="LeaveApplicationForm.php"><i class="fab fa-wpforms"></i> Leave Application Form</a>
          <a class="dropdown-item" href="leave_balance.php"><i class="fas fa-calculator"></i> Leave Balance</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="subjects_Assigned.php"><i class="fas <i fas fa-book ico"></i> Subjects</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-poll"></i>Result
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        <a class="nav-link" href="student_result.php"><i class="fas fa-user"></i> Student Result</a>
        <!-- <a class="nav-link" href="class_result.php"><i class="fas fa-users"></i> Class Result</a> -->
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="consultation.php"><i class="fas fa-hands-helping ico"></i> Consultation</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="password_change.php" ><i class="fas ico fa-unlock-alt ico"></i> Change Password</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php" ><i class="fas ico fa-sign-out-alt ico"></i> Logout</a>
      </li>
    </ul>
  </div>
</nav>

</body>
