@php
    $total = 0.0
@endphp
<html>
<head>
    <meta charset="utf-8"/>
    <title>Environmental Protection Agency | Payment Receipt</title>
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
    <tr><td colspan="6" align="center"><strong>Generated Invoice</strong></td></tr>
    <tr>
        <td>&nbsp;</td>
        <td colspan="5"><hr style="border: double;"></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><strong>DATE ISSUED:</strong></td>
        <td>{{ date('jS, F Y') }}</td>
        <td>&nbsp;</td>
        <td><strong>FORM NUMBER:</strong></td>
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
        <td><strong><strong>Plot/House No : </strong>:</strong></td>
        <td>
            @if (count($formData->checkType()) > 0)
                {{ $formData->checkType()[0]->plotNo }}
            @endif
        </td>

        </tr>
    <tr>
        <td>&nbsp;</td>
        <td><strong>Location : </strong></td>
        <td>
             @if (count($formData->checkType()) > 0)
                {{ $formData->checkType()[0]->location }}
            @endif
        </td>
        <td>&nbsp;</td>
        <td><strong><strong>City : </strong></td>
        <td>
             @if (count($formData->checkType()) > 0)
                {{ $formData->checkType()[0]->city }}
            @endif
        </td>

        </tr>
    <tr><tr>
        <td>&nbsp;</td>
        <td><strong>District : </strong></td>
        <td>
            @if (count($formData->checkType()) > 0)
                {{ Auth::User()->getDistrictName($formData->checkType()[0]->district) }}
            @endif
        </td>
        <td>&nbsp;</td>
        <td><strong><strong>Region :</strong></td>
        <td>
            @if (count($formData->checkType()) > 0)
                {{ Auth::User()->getRegionName($formData->checkType()[0]->region) }}
            @endif
        </td>

        </tr>
    <tr>
        <td colspan="7"><hr></td>
    </tr>

    <tr>
        <td colspan="7"><hr></td>
    </tr>
    <tr><td></td>
        <td>&nbsp;#</td>
        <td><strong>BILL ITEM:</strong></td>
        <td><strong>BILL AMOUNT</strong></td>
        <td>&nbsp;</td>

        <td>&nbsp;</td>

    </tr>
    <tr>
        <td colspan="7"><hr></td>
    </tr>

    @foreach ($billItemsList as $billItemsListItem)
        <tr>
            <td></td>
            <td>{{ $loop->index+1 }}</td>
            <td>{{ $billItemsListItem->name }}</td>
            <td>{{ $billItemsListItem->currency }} {{ number_format($billItemsListItem->amount,2) }}</td>
        </tr>
        @php
            $total = $total + (double)$billItemsListItem->amount;
        @endphp
    @endforeach
 

    <tr>
        <td>&nbsp;</td>
        <td colspan="5"><hr></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><strong>TOTAL BILL:</strong></td>
        <td style="color: red"><strong>GHC {{ number_format($total,2) }}</strong></td>
        <td>&nbsp;</td>
        <td></td>
        <td colspan="4"></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td colspan="5"><hr></td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td colspan="5"><hr></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><strong>ISSUED BY:</strong></td>
        <td>{{ Auth::User()->getUserName($formData->createdBy) }}</td>
        <td style="text-align: right"><strong>DATE PROCESSED:</strong></td>
        <td style="text-align: left"> {{ date('jS, F Y',strtotime($formData->createdOn)) }}</td>
        <td><strong>#: GNFS/RECPT/{{ $formData->id}}</strong></td>
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

</body>
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}" type="62b5855f7ca0f09492e000e4-text/javascript"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

        window.print();

    });
</script>
</html>