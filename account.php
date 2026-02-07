  <p class="text-danger">Enter the following data to create Account</p>
    <form  method="POST" action="" id="loginform" onsubmit="return false">
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Your Email</label>
          <input type="email" name="cont" class="form-control" id="emaill" required />
            <label id="feedback" style="font-size:11px"></label>
        </div>

       <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" name="pass" class="form-control" disabled id="pass" placeholder="Password" required />
       </div>

       <div class="form-group">
          <label for="exampleInputPassword1">Confirm Password</label>
          <input type="password" name="copass" class="form-control" id="copass" disabled placeholder="Password" required />
       </div>
       
        <div class="form-group">
          <input class="form-check-input" type="checkbox" name="remember" value="true" onclick="myFunctioncreate()" id="rememberMe">
          <label class="form-check-label" for="rememberMe">Show password</label>
        </div>
               
      <div class="row">
        <!-- /.col -->
        <div class="col-md-12 col-lg-12">
             <center><label id="loginmsg"></label></center>
       </div>
        <div class="col-md-12 col-lg-12">
          <button type="submit" class="btn btn-primary btn-block" name="login" id="btncreate" disabled> Create</button>
        </div>
        <!-- /.col -->
      </div>
      </div>
    </form>