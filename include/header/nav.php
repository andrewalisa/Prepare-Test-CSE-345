<?php
  if (isset($this->session->userdata['is_logged_in'])) {
  $is_logged_in = ($this->session->userdata['is_logged_in']);
  $email = ($this->session->userdata['email']);
  $Fullname = ($this->session->userdata['full_name']);
  $Fullname = ucwords(strtolower($Fullname));
} else {
  $is_logged_in = 0;
  $email = null;
  $Fullname = null;
}
?>


    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		  
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/Main">Prepare for Test!</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
		  <ul class="nav navbar-nav">
            <li class="active"><a href="/Main">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
		  
          <form action="http://preparetestcse345.co/Main/login_validation" method="post" accept-charset="utf-8" class="navbar-form navbar-right">

          <?php
              //Gives error messages, if user forgot to input email or password
              echo '<div class="error">';
              echo validation_errors();
              echo '</div>';
          ?>
		      <?php if ($is_logged_in == 1) { ?>

            <!--<div class="welcome">
              <div class="form-group">
                Hello <?= $Fullname ?>!
              </div>
            </div>
            <a class="btn btn-danger" role="button" href='<?php echo base_url()."Main/signup"; ?>'> Sign up!</a> -->

                <div class="btn-group">
                  <div class="welcome">
                    Hello <?= $Fullname ?>!
                  </div>
                </div>

                <div class="btn-group">
                  <a class="btn btn-danger" role="button" href='<?php echo base_url()."Main/logout"; ?>'> Log Out</a>
              </div>
		      <?php } elseif ($is_logged_in != 1) { ?>
            <div class="form-group">
                <input type="text" placeholder="Email" name="STU_EMAIL" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Password" name="STU_PASSWORD" class="form-control">
            </div>
              <button type="submit" name="login" class="btn btn-success">Sign in</button>
              <a class="btn btn-danger" role="button" href='<?php echo base_url()."Main/signup"; ?>'> Sign up!</a>
            </form>
          <?php } ?>
		  
        </div><!--/.navbar-collapse -->
      </div>
    </nav>