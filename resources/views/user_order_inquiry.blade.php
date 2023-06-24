<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Order Confirmation</title>
  </head>
  <style>
    table tr:first-child>td>center {
      /*background: #ff0000;*/
    }
  </style>
  <body>
    <table style="background:#fff; border:#000000 1px solid;" width="622" cellspacing="0" cellpadding="0" border="0" align="center">
      <tbody>
        <tr class="first">
          <td>
            <center>
              <img src="{{asset('images/logo.png')}}" style="padding: 15px;">
            </center>
          </td>
        </tr>
        <tr>
          <td height="1"></td>
        </tr>
        <tr>
          <td style="font-family:Arial, Helvetica, sans-serif;" bgcolor="#f5f9f6">
            <table width="622" cellspacing="0" cellpadding="0" border="0" align="center">
              <tbody>
                <tr>
                  <td style="padding:8px 15px;">
                    <p>
                      <strong>Dear {{$request['fname']}} </strong>
                    </p>
                  </td>
                </tr>
                <tr>
                  <td style="font-size:13px; line-height:22px; padding:0 15px; margin-bottom:15px;"> This email is to let you know that your inquiry submited successfuly. We will contact you soon. Thank you for visiting  this site: </td>
                </tr>
                <tr>
                  <a href="{{$url}}">Product Link</a>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>
  </body>
</html>