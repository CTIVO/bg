<form  method="POST" action="#" id="loginform" onsubmit="return false">
        <div class="card-body">
  
          <div class="form-group">
            <label for="exampleInputPassword1">Enter Your Pin</label>
            <input type="password" name="thepin" style="font-size:18px;color:red" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"  maxlength="4" class="form-control" id="thepin" placeholder="Pin" required />
         </div>
         
          <div class="form-group">
              <?php
              $me=$_SESSION['me'];
              if($me=='' || $me==null)
              {
                  
              }else if($me=='Invalid login Credentials')
              {
              ?>
               <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <?php echo $me; ?>
              </div>
              <?php
              }else if($me=='acessno')
              {
               ?>
               <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <?php echo 'Sorry. You have no right to access the system for now! '; ?>
              </div>
               <?php
              }else if($me=='granted')
              {
               ?>
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <strong>ACCESS GRANTED !</strong>
                </div>
               <?php
              }
              ?>
          </div>
          
          <div class="form-group">
            <input class="form-check-input" type="checkbox" name="remember" value="true" onclick="myFunction()" id="rememberMe">
            <label class="form-check-label" for="rememberMe">Show Pin</label>
          </div>
                 
        <div class="row">
          <!-- /.col -->
          <div class="col-md-12 col-lg-12">
               <center><label id="loginmsg"></label></center>
         </div>
          <div class="col-md-12 col-lg-12">
            <button type="submit" class="btn btn-primary btn-block" name="loginpin" id="login">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
        </div>
      </form>