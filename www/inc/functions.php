<?php
function redirectTo($location = NULL)
{

  if ($location != NULL) {
    header("Location: $location");
    exit;
  }
}

function loginForm()
{
  return '<div class="login-cont"><form action="processLogin.php" class="login-form" method = "POST">
  <div class="input-group">
      <label for="username">User Name</label>
      <input type="text" id="username" name="username">
  </div>
  <div class="input-group">
      <label for="pass">Password</label>
      <input type="password" id="password" name="password">
  </div>
  <div>
      <button type="submit">Login</button>
      <button type="reset">Clear Form</button>
  </div>

</form></div>';
}