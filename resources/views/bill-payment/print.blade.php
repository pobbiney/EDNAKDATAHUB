
<html>
<head>
    <meta charset="utf-8"/>
    <title>EPA | Payment Receipt</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.jpeg') }}">
   <style type="text/css">
       .receipt{
           font-size: small;
           width: 900px;
       }
   </style>
</head>
<body>
<table class="receipt" style="border-top: 1px solid black; border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">
    <tr>
        <td>&nbsp;</td>
        <td colspan="5" align="center"><img src="{{ asset('assets/img/EPA-top-logo.png') }}"></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td colspan="5"><hr style="border: double;"></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><strong>DATE ISSUED:</strong></td>
        <td>{{ date('jS F, Y',strtotime($formData->createdOn)) }}</td>
        <td>&nbsp;</td>
        <td><strong>SERIAL NUMBER:</strong></td>
        <td>{{ $formData->formNumber }}</td>
    </tr>
    <tr>
        <td colspan="7"><hr></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><strong>NAME:</strong></td>
        <td>{{ $formData->applicantName }}</td>
        <td>&nbsp;</td>
        <td><strong>AMOUNT PAID:</strong></td>
        <td>{{ $formData->formTypeDetails()->currency }} {{ number_format($payment->amount,2)  }}</td>
    

        </tr>
         <tr>
        <td>&nbsp;</td>
        <td colspan="7"><hr></td>
    </tr>
      <tr>
        <td>&nbsp;</td>
      
        <td><strong>PAYMENT MODE:</strong></td>
        <td>{{ $payment->payment_mode }} </td>

        </tr>
    <tr>
        <td colspan="7"><hr></td>
    </tr>

    <tr>
        <td colspan="7"><hr></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><strong>TELEPHONE:</strong></td>
        <td><?php echo $formData->tell;?></td>
        <td>&nbsp;</td>
        <td></td>
        <td rowspan="5"><img id='barcode' src="https://api.qrserver.com/v1/create-qr-code/?data={{ base64_encode($formData->serialNumber) }}&amp;size=170x170" alt="" title="HELLO" width="170" height="170" /></td>
        <td>&nbsp;</td>

    </tr>
    <tr>
        <td>&nbsp;</td>
        <td colspan="4"><hr></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><strong>PIN:</strong></td>
        <td>{{ $formData->pin }}</td>
        <td>&nbsp;</td>
        <td></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td colspan="4"><hr></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><strong>PAYMENT FOR:</strong></td>
        <td>{{ $payment->billType->formName ?? 'N/A'}}</td>
        <td>&nbsp;</td>
        <td></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td colspan="4"><hr></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><strong>ISSUED BY:</strong></td>
        <td>{{ $payment->createdByName() }}</td>
        <td style="text-align: right"><strong>DATE PROCESSED:</strong></td>
        <td style="text-align: left">{{$payment->createdOn}}</td>
        <td><strong>#:</strong><?php echo " GNFS/RECPT/".$payment->id;?></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td colspan="5"><hr style="border: double;"></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td colspan="7"><div style="font-style: italic; text-align: center;"><strong>&copy; {{ Date('Y') }} Index Com Limited</strong></div></td>
    </tr>
</table>
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}" type="62b5855f7ca0f09492e000e4-text/javascript"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

        window.print();

    });
</script>
</body>
</html>