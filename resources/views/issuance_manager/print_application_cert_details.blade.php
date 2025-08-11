@php 

$pageName = "approval"; 

$subpageName = "print_cert";
 
@endphp

 <head>
    <meta charset="utf-8"/>
    <title>EPA</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
   <!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/img/logo-png.png')}}">
   <style type="text/css">
       .receipt{
           /*font-size: small;
           width: 900px;*/
           margin-top: -65px;
       }
       @media print {
           @page { margin: 0; }
           body { margin: 1.6cm; }
       }

       @media print {
  body {
    -webkit-print-color-adjust: exact;
    print-color-adjust: exact;
    background-image: url('{{ asset('assets/img/logo-png.png') }}');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
  }
}
   </style>

</head>


 

<body>
    <div class="receipt" align="center"><br><br><br><br>

        <table align="center" style="
                   position: relative;
                   border: 4px solid;
                   width: 100%;
                   height: 300px;
                   overflow: hidden;
               ">
            <tr>
                    
                <td align="center" style="position: relative; overflow: hidden;">
                    <!-- Background image overlay -->
                    <div style="
                        position: absolute;
                        top: 170;
                        left: 0;
                        width: 100%;
                        height: 70%;
                        background-image: url('{{ asset('assets/img/logo-png.png') }}');
                        background-repeat: no-repeat;
                        background-position: center top;
                        background-size: contain;
                        opacity: 0.2; /* Adjust opacity here */
                        z-index: 0;
                        pointer-events: none;
                    "></div>
                
                    <!-- Foreground content (above the image) -->
                    <div style="position: relative; z-index: 1;">
                        <img src="{{ asset('assets/img/logo-png.png') }}" width="100" alt="logo" align="center">
                        <br>
                         <table>
                            <tr>
                                <td></td>
                                <td style="width: 600px"><p style="float: right"><b>Permit No: {{ $list->formNumber }}</b></p></td>
                            </tr>
                         </table>
                        <h1 style="font-family: 'Times New Roman', Times, serif; text-align: center;">
                            ENVIRONMENTAL PROTECTION AGENCY
                        </h1>
                
                        <h1 style="font-family: Brush Script MT, Lucida Handwriting; text-align: center; font-size: 40pt; color: red;">
                            Environmental Permit
                        </h1>
                
                        <h2 style="font-family: 'Times New Roman', Times, serif; text-align: center; font-size: 14pt;">
                            ENVIRONMENTAL ASSESSMENT REGULATIONS, 1999 (LI 1652)
                        </h2>
                
                        <br><br>
                
                        <p style="margin-left: -500px; font-size: 15pt;">This is to authorize</p>
                
                        <h2 style="font-family: 'Times New Roman', Times, serif; text-align: center; font-size: 25pt; text-transform: uppercase; color: green;">
                            {{ $data->proponent_name }}
                        </h2>
                        <p style="font-size: 15pt;"><b>To commence the proposed development of {{ $data->project_title }} <br>as per attached schedule </b></p>
                        <p style="font-size: 15pt;"><b>Located at {{ $data->town }} in the {{ $data->getDistrict->name }} of the {{ $data->getRegion->name }}</b></p>
                
                    </div>
                    <div class="row " style="margin-top: 100px">
                        <table>
                            <tr>
                                <td align="left">
                                    <p ><b>................................................</b></p>
                                    <p><b>Ebenezer Appah-Sampong<br/>
                                     Deputy Executive Director/Technical Service<br>
                                    For: Executive Director</b></p>
                                </td>
                                <td style="width: 50px"></td>
                                <td align="left">
                                    <p><b>Date Issued: {{ \Carbon\Carbon::now()->format('l, F j, Y') }}<br>
                            Expiry Date: {{ \Carbon\Carbon::now()->addYear()->format('l, F j, Y') }}</b></p>

                                </td>
                            </tr>
                        </table>
                        <p><b><span style="font-style: italic">NB:</span> This Permit is only valid with the attached Schedule and the Seal of the Environmental <br>Protection Agency and conditioned upon obtaining other permits from relevant institutions<br> among others</b></p>
                        <br>
                    </div>
                </td>
                
            </tr>
            
 
       
             
        </table>
         
       

    </div>
</body>


 

@section('scripts')
 <script type="text/javascript">
    $(document).ready(function(){

        window.print();

    });
</script>
@endsection