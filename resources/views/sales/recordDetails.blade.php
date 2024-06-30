<!DOCTYPE html>
<html lang="ur">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{asset('frontend/html2pdf/pdf.js')}}"></script>

    <title>ڈیجیٹل رسید</title>
    <style>
        @font-face {
            font-family: valky;
            src: url(urdu.ttf);
        }


        .allbody {
            font-family: valky;
            direction: rtl;
            /* Right-to-left text direction for Urdu */
            text-align: right;
            /* Right align text */
            background-color: #f9f9f9;
            padding: 20px;
        }



        .receipt {
            background-image: url({{ asset('img/2.png') }});
            background-position: bottom;
            background-repeat: no-repeat;
            background-size: cover;

            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 595px;
            min-height: 640px;
            margin: 0 auto;
        }

        .receipt-header {
            height: 250px;
            max-width: 595px;
            display: flex;
            justify-content: space-around;

        }

        .title h1 {
            margin-top: -10px;
            font-size: 4rem;
            color: rgb(255, 255, 255);
            font-weight: 900;
            -webkit-text-stroke-width: 0.01px;
            -webkit-text-stroke-color: rgba(135, 6, 6, 0.837);
        }

        .title h2 {
            margin-top: -70px;
            font-size: 3.5rem;
            color: rgb(0, 81, 28);
            font-weight: 900;
            -webkit-text-stroke-width: 0.01px;
            -webkit-text-stroke-color: rgba(5, 176, 110, 0.842);
        }


        table {

            width: 100%;
            text-align: center;
            border-spacing: 0px;
            border-radius: 10px;
        }


        th,
        td {

            padding: 5px;
            text-align: center;
            border: 1px solid rgb(0, 0, 0);

        }

        th {
            background-color: #f2f2f245;
            font-size: 1.5rem;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        td {
            border-top: none;
            border-bottom: none;

        }

        table tr:last-child td {
            border-top: 1px solid rgb(0, 0, 0);
            border-bottom: 1px solid rgb(0, 0, 0);
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }


        th:nth-child(1),
        td:nth-child(1) {
            width: 5%;
            /* Adjust width of "شمارہ" column */
        }

        th:nth-child(2),
        td:nth-child(2) {
            width: 20%;
            /* Adjust width of "تفصیل" column */
        }

        th:nth-child(3),
        td:nth-child(3) {
            width: 15%;
            /* Adjust width of "مقدار" column */
        }

        th:nth-child(4),
        td:nth-child(4) {
            width: 15%;
            /* Adjust width of "قیمت" column */
        }

        .details {

            width: 595px;
            height: 50px;
            position: absolute;
            top: 134%;
            display: flex;
            justify-content: space-around;

        }

        .details span {
            font-size: 1.5rem;
        }


        /* Print-specific CSS */
        @media print {
            .allbody {

                /* White background for printing */
                padding: 0;
                margin: 0;

            }

            .receipt {
                background-position: center;
                border: none;
                box-shadow: none;
                max-width: none;
                margin: 0;


            }

            .receipt-header {
                justify-content: space-between;
            }

            .print-button {
                display: none;
            }

            .details {
                top: 85%;
            }





        }

        .print-button {
            text-align: center;
            margin-top: 20px;

        }

        .print-button button {
            font-family: valky;
            font-size: 1rem;
            border-radius: 10px;
            border: 1px solid black;
            padding: 5px 20px;
            cursor: pointer;
        }
        .header-container {
    display: flex;
    justify-content: space-between; /* This will push the divs to the opposite ends */
}
        .left-header{

            width:27%;
            font-weight: 500;
            font-size: 1rem;
            display: flex;
    flex-direction: column;
            justify-content: center; /* Centers content horizontally */
    align-items: center;
           color: #fff;
        }

        .right-header{
            width:67%;
            /* font-size:2.2rem;
            font-weight: 900; */
           color: #fff;

        }
        .card-footer {
      text-align: center;
      font-size: 1.5rem;
      font-weight: 600;
      /* padding: 20px; */
      /* background-color: #0a6aca; */
      margin-top: 5%;
    }
    </style>


</head>

<body>
    <section class="allbody">
        <div class="receipt">

            <div class="header-container">

                <div class="right-header">
                    <div class="title">
                        <span  style="color: rgb(240, 240, 25);padding-top:3%; font-size:3.5rem; font-weight:900; margin-top:5%;">
                            چوہدری انیس جٹ
</span>
<span style="color: rgb(27, 75, 163); font-size:2.5rem; font-weight:900;">

      چوہدری شاہد منّا

<span  style="color: rgb(27, 75, 163); font-size:2.1rem; font-weight:900;">
    اینڈ کمپنی

</span>                        </span>
<h3 style="color:  rgb(251, 251, 20); font-size:1.5rem; font-weight:900;">سبزی فروٹ کمیشن ایجنٹس</h4>

                    </div>
                </div>
        <div class="left-header">

            چوہدری انیس جٹ
<br>
                            03006033727 <br>
                            چوہدری شاہد منّا
                            <br>
                            03006028935 <br>

              <img src="{{ asset('img/as2.png') }}" alt="vegetables" width="100px" style="border-radius: 35px;margin-top:5%;">
                    <img src="{{ asset('img/3.png') }}" alt="vegetables" width="200px">


        </div>
    </div>




            <div >




            </div>
            @foreach ($sales as $sale)

             گاہک کا نام:  {{$sale->customer->name}} <br>
             گاہک ایریا: {{$sale->customer->area}}  <br>
             گاہک فون:{{$sale->customer->phone}} <br>
            @break
            @endforeach
            @if (isset($sales))
            @foreach ($sales as $sale)
         تاریخ: {{$sale->created_at->format('d-m-Y')}}<br>
            @break
            @endforeach
           @endif


            <table style="margin-top: 5%;">
                <thead>
                    <tr>
                        {{-- <th scope="col">آئی ڈی</th> --}}
                        <th>نام</th>
                        <th scope="col">بوری </th>
                        <th scope="col">قیمت</th>
                        <th>مقدار</th>
                        <th scope="col">کل قیمت</th>



                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @if (isset($sales))
                        @php
                            $grandTotal=0;
                        @endphp
                        @foreach ($sales as $sale)
                        <tr>
                            {{-- <td> {{$sale->id}} </td> --}}
                                    <td> {{$sale->product->name}} </td>
                            <td> {{$sale->sack->name}} </td>
                            <td> {{$sale->price}} </td>
                            <td> {{$sale->quantity}} </td>
                            <td> {{$sale->total_price}} </td>
                            {{-- <td> {{$sale->created_at->format('d-m-Y')}} </td> --}}

                            @php
                                $grandTotal=$grandTotal+$sale->total_price;
                               $total_amount= $remainingAmount+$grandTotal;
                            @endphp

                            {{-- <td> {{$sale->payment_status}} </td> --}}
                            {{-- <td > <a href="{{route('editSale',['id'=>$sale->id])}}"  class="btn btn-primary bg-primary">Edit</a> </td>
                            <td > <a href="{{route('deleteSale',['id'=>$sale->id])}}" class="btn btn-danger bg-danger">Delete</a> </td> --}}
                        </tr>

                        @endforeach

                        @endif
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>


            </table>

         <div style="font-size: large;font-weight:bold;margin-top:5%; ">
            سابقہ ​​بقایا : {{$remainingAmount}}   <br>
          <span style="border-bottom:2px solid black; "> مجموعی رقم: {{$grandTotal}} </span> <br>
    <span>     کل رقم: {{$total_amount}}</span>
        </div>


            </div>
        </div>
        <div class="print-button">
            <button onclick="window.print()">پرنٹ کریں</button>
             <button id="downloadPdf">Download PDF</button>
        </div>
    </section>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const downloadPdfButton = document.getElementById("downloadPdf");
            const pdfContent = document.querySelector(".allbody");

            downloadPdfButton.addEventListener("click", function() {
                const options = {
                margin: 1,
                filename: 'Receipt.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
            };

                html2pdf().from(pdfContent).set(options).save();
            });
        });
    </script>
</body>

</html>
