$(document).ready(function(){
  $(function(){
    $('.account-create').click(function(e){
      e.preventDefault();
      $(".account-create").css("display","none");
      $(".modal-sign-in").css("display","block");
      $(".modal-title").html('<span class="glyphicon glyphicon-lock"></span> Register');
      $(".modal-body").html('<form action="" method="POST"><div class="form-group"><input type="text" class="form-control" placeholder="Email" name="email"></div><div class="form-group"><input type="password" class="form-control" placeholder="Password" name="pass"></div><div class="form-group"><input type="password" class="form-control" placeholder="Confirm Password" name="confirm_pass"></div><div class="form-group"><input type="text" class="form-control" placeholder="First Name" name="firstname"></div><div class="form-group">input type="text" class="form-control" placeholder="Last Name" name="lastname"></div><input class="btn btn-primary btn-sm" style="width:120px" type="submit" value="Create Account" name="submit"/></form>');
    });
  })

  $(function(){
    $('.modal-sign-in').click(function(e){
      e.preventDefault();
      $(".account-create").css("display","block");
      $(".modal-sign-in").css("display","none");
      $(".modal-title").html('<span class="glyphicon glyphicon-lock"></span> Sign In');
      $(".modal-body").html('<form action="" method="POST"><div class="form-group"><input type="text" class="form-control" placeholder="Email" name="email"></div><div class="form-group"><input type="password" class="form-control" placeholder="Password" name="pass"></div><div class="form-group"><input type="password" class="form-control" placeholder="Confirm Password" name="confirm_pass"></div><div class="form-group"><input type="text" class="form-control" placeholder="First Name" name="firstname"></div><div class="form-group"><input type="text" class="form-control" placeholder="Last Name" name="lastname"></div><input class="btn btn-primary btn-sm" style="width:120px" type="submit" value="Create Account" name="submit"/></form>');
    });
  })
});