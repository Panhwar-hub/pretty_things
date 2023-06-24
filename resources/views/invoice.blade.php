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
    <table style="border:#000000 1px solid;" width="622" cellspacing="0" cellpadding="0" border="0"
        align="center">
        <tbody>
            <tr class="first">
                <td>
                    <center>
                        <img src="{{asset($logo->img_path)}}" style="padding: 15px;">
                    </center>
                </td>
            </tr>
            <tr>
                <td height="1"></td>
            </tr>
            <tr>
                <td style="font-family:Arial, Helvetica, sans-serif;">
                    <table width="622" cellspacing="0" cellpadding="0" border="0" align="center">
                        <tbody>
                            <tr>
                                <td style="padding:8px 15px;">
                                    <p><strong>Payment Successfuly </strong></p>
                                </td>
                            </tr>
                            <tr style="margin:20px 0; float:left;">
                                <td width="622">
                            
                            <?php 
                        foreach($order_detail as $key => $val)
                        {
                            ?>
                                    <table style="margin-top:20px;" width="580" cellspacing="0" cellpadding="0" border="0" align="center">
                                        <tbody style="font-size: 20px;">
                                                <tr style="color:rgb(10, 10, 10)">
                                                    <td>Name</td>
                                                    <td>{{$val['name']}}</td>
                                                </tr>
                                                 <tr style="color:rgb(10, 10, 10)">
                                                    <td>Quantity</td>
                                                    <td>{{$val['quantity']}}</td>
                                                </tr>
                                                <tr style="color:rgb(10, 10, 10)">
                                                    <td>Price</td>
                                                    <td>{{$val['price']}}</td>
                                                </tr>
                                                <tr style="color:rgb(10, 10, 10)">
                                                    <td>Sub Total</td>
                                                    <td>{{$val['sub_total']}}</td>
                                                </tr>
                                                
                                            
                                            </tr>
                                        </tbody>
                                    </table>
                        <?php
                        }
                        ?>
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