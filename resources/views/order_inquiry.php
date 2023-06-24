<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Order Inquiry</title>
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
                  <td style="font-size:13px; line-height:22px; padding:0 15px; margin-bottom:15px;"> This email is to let you know that we have received your order inquiry. Below are your order details: </td>
                </tr>
                <tr style="margin:20px 0; float:left;height:86px;     background-color: #000000;" bgcolor="#68A13E">
                  <td width="622">
                    <table style="margin-top:20px;" width="580" cellspacing="0" cellpadding="0" border="0" align="center">
                      <tbody style="font-size: 20px;">
                        <tr style="color:#fff;  ">
                          <td width="251" align="left ">Name : <b>{{$request->fname}} {{$request->lname}}</b></td>
                          <td width="251" align="left ">Email : <b>{{$request->email}}</b></td>
                          <td width="251" align="left ">City : <b>{{$request->city}}</b></td>
                          <td width="251" align="left ">Country : <b>{{$request->country}}</b></td>
                          <td width="251" align="left ">Shipping Address : <b>{{$request->address}}</b></td>
                          <td width="251" align="left ">ZIP Code : <b>{{$request->zip_code}}</b></td>
                          <td width="251" align="left ">Message : <b>{{$request->message}}</b></td>
                          <td width="251" align="left ">Product : <b>{{$product->name}}</b></td>
                          <td width="251" align="left ">Quantity : <b>{{$product->quantity}}</b></td>
                          <td width="251" align="left ">Select Stock : <b>{{$product->select_stock}}</b></td>
                          <td width="251" align="left ">Product Price : <b>{{$product->product_price}}</b></td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
                <div class="text-center"></div>

                <tr>
                  <td style="font-size:16px; line-height:22px; padding:0 15px; margin-bottom:15px; padding-bottom:10px;"> For Product Details <a href="{{$currenturl}}"></a> 
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>
  </body>
</html>