$(document).ready(function(){
  $(function(){
    $('.account-create').click(function(e){
      e.preventDefault();
      $(".account-create").css("display","none");
      $(".modal-sign-in").css("display","block");
      $(".modal-title").html('<span class="glyphicon glyphicon-lock"></span> Register');
      $(".modal-body").html('<form action="" method="POST"><div class="form-group"><input type="text" class="form-control" placeholder="Username (this will be your display name)" name="user_name"></div><div class="form-group"><input type="text" class="form-control" placeholder="Password (case sensitive)" name="pass"></div><div class="form-group"><input type="password" class="form-control" placeholder="Confirm Password" name="confirm_pass"></div><div class="form-group"><input type="text" class="form-control" placeholder="Email Address" name="email"></div><div class="form-group"><input type="text" class="form-control" placeholder="Confirm Email" name="confirm_email"></div><input class="btn btn-block" type="submit" value="Create Account" name="register" style="background-color: #194775; color: white;" /></form>');
    });
  })

  $(function(){
    $('.modal-sign-in').click(function(e){
      e.preventDefault();
      $(".account-create").css("display","block");
      $(".modal-sign-in").css("display","none");
      $(".modal-title").html('<span class="glyphicon glyphicon-lock"></span> Sign In');
      $(".modal-body").html('<form action="" method="POST"><div class="form-group"><label for="usrname"><span class="glyphicon glyphicon-user"></span> Email</label><input type="text" class="form-control" placeholder="Enter email" name="email"></div><div class="form-group"><label for="psw"></span> Password</label><input type="password" class="form-control" placeholder="Enter password" name="pass"></div><div class="checkbox"><label><input type="checkbox" value="" checked>Remember me</label></div><input class="btn btn-block" type="submit" value="Sign In" name="login" style="background-color: #194775; color: white;" /></form>');
    });
  })
});
