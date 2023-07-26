<!DOCTYPE html>
<html lang="en">
​
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reserva</title>
</head>
<body  style="margin-top:20px;margin-bottom:20px">
  <!-- Main table -->
  <table border="0" align="center" cellspacing="0" cellpadding="0" bgcolor="white" width="650">
    <tr>
      <td>
        <!-- Child table -->
        <table border="0" cellspacing="0" cellpadding="0" style="color:#0f3462; font-family: sans-serif;">
          <tr>
            <td>
              <h2 style="text-align:center;margin: 0px;padding-bottom: 25px;margin-top: 25px;background: aliceblue;padding: 23px;color: #d7d7d7;font-size: 20px;border: 1px solid #f3f0f0;">
                Reserva</h2>
            </td>
          </tr>
         
          <tr>
            <td style="text-align: center;">
              <h1 style="margin: 0px;padding-bottom: 25px;text-transform: capitalize;font-size: 23px;text-align: left;margin-top: 22px;color: black;">Hello !</h1>
              <h2 style="margin: 0px;padding-bottom: 23px;text-transform: capitalize;font-size: 18px;text-align: left;margin-top: 0px;font-weight: 100;color: #a9a8a8;line-height: 30px;"> You are receiving this email because we recievd a password reset request for your account.</h2>
              <tr>
                <td>
                    <a href="{{ route('reset.password.get', $token) }}"><button type="button" style="    background-color: #3097d1;
                  color: white;
                  padding: 15px 38px;
                  outline: none;
                  display: block;
                  margin: auto;
                  border-radius: 10px;
                  font-weight: 300;
                  font-size: 16px;
                  margin-bottom: 25px;
                  border: none;
                  text-transform: capitalize; ">Reset Password</button></a>
                </td>
              </tr>
            </td>
          </tr>
         
          <tr>
            <td style="text-align:center;">
              <h2 style="margin: 0px;padding-bottom: 23px;text-transform: capitalize;font-size: 18px;text-align: left;margin-top: 0px;font-weight: 100;color: #a9a8a8;line-height: 30px;">This Password reset link will expire in 60 minutes.</h2>
              <h2 style="margin: 0px;padding-bottom: 23px;text-transform: capitalize;font-size: 18px;text-align: left;margin-top: 0px;font-weight: 100;color: #a9a8a8;line-height: 30px;">if you did not  request a password reset, no further action is required.</h2>
            </td>
          </tr>
          <tr>
            <td style="text-align:center;">
              <h2 style="margin: 0px;padding-bottom: 5px;text-transform: capitalize;font-size: 18px;text-align: left;margin-top: 0px;font-weight: 100;color: #a9a8a8;line-height: 30px;">Regards,</h2>
              <h2 style="margin: 0px;padding-bottom: 23px;text-transform: capitalize;font-size: 18px;text-align: left;margin-top: 0px;font-weight: 100;color: #a9a8a8;">Reserva</h2>
            </td>
          </tr>
        </table>
        <!-- /Child table -->
      </td>
    </tr>
  </table>
  <!-- / Main table -->
</body>
​
</html>