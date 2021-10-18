<html>
  <head>
          <title>VacciHub</title>
          <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
          <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
          <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light p-4 bg-light justify-content-around">
      <!--Logo-->
      <div>
        <a class="navbar-brand" href="#">VacciHub</a>
      </div>
      <div>
        <!--Mobile Menu Button-->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Nav Bar Links -->
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav nav-fill">
            <!--Standard Menu Options-->
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url(); ?>welcome"> Home </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url(); ?>coronavirus"> Coronavirus </a>
            </li>
            
            <!--Menu Options if User Not Logged In-->
            <?php if(!$this->session->userdata('logged_in')) : ?>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url(); ?>login"> Book Appointment </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url(); ?>login"> Login / Register </a>
              </li>
            <?php endif; ?>
            <!--Menu Options if User Logged In-->
            <?php if($this->session->userdata('logged_in')) : ?>
              <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url(); ?>book">Manage Bookings</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url(); ?>profile">Profile</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url(); ?>login/logout">Logout</a>
              </li>
            <?php endif; ?>
          </ul>
      </div>
    </nav>
  </body>
</html>

<style>
  .navbar-brand {
    font-size: 1.75rem;
  }
</style>



