{{-- <!DOCTYPE html>
<html lang="ur">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>سبزی منڈی انوائس</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      font-family: 'Noto Nastaliq Urdu', sans-serif;
      direction: rtl;
    }
    .card-header {
      background-color: #28a745;
      color: #fff;
      text-align: center;
      padding: 20px;
    }
    .card-body {
      padding: 0;
    }
    .table {
      margin-bottom: 0;
    }
    .card-footer {
      text-align: right;
      padding: 20px;
      background-color: #f8f9fa;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="mt-5 row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h3>سبزی منڈی انوائس</h3>
            <p>جناب تفصیل</p>
            <p>تاریخ: 5 اپریل 2024</p>
          </div>
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">سبزی کا نام</th>
                  <th scope="col">مقدار</th>
                  <th scope="col">قیمت</th>
                </tr>
              </thead>
              <tbody>
                <!-- Sample row, you can dynamically add rows using JavaScript -->
                <tr>
                  <th scope="row">1</th>
                  <td>پیاز</td>
                  <td>2 کلو</td>
                  <td>120 روپے</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="card-footer">
            <p>مجموعی رقم: 120 روپے</p>
            <p>اخراجات: 10 روپے</p>
            <hr>
            <p>صاف رقم: 110 روپے</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html> --}}




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
            width:70%;
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
      margin-top: 30%;
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
<span style="color: rgb(49, 106, 212); font-size:2.2rem; font-weight:900;">

      چوہدری شاہد منّا

<span  style="color: rgb(42, 98, 203); font-size:2.1rem; font-weight:900;">
    اینڈ کمپنی

</span>                        </span>
<h3 style="color:  rgb(251, 251, 20); font-size:1.5rem; font-weight:900;">سبزی فروٹ کمیشن ایجنٹس</h4>

                    </div>
                </div>
        <div class="left-header">

            چوہدری انیس جٹ
<br>
                            03006033727 <br>

                            چوہدری شاہدمنّا
                             <br>
                             03006028935
                             <br>

              <img src="{{ asset('img/as2.png') }}" alt="vegetables" width="100px" style="border-radius: 35px;margin-top:5%;">
                    <img src="{{ asset('img/3.png') }}" alt="vegetables" width="200px">


        </div>
    </div>




            <div >




            </div>
@foreach ($buyedProducts as $buyed)
   <strong style="margin: 0 3%">نام </strong>  {{$buyed->seller->name}}
<br>
<strong style="margin: 0 2%">تاریخ </strong>  {{$buyed->created_at->format('d-m-Y')}}
<br>

@break
@endforeach


@foreach ($buyedProducts as $buyed)
   <strong style="margin: 0 3%">نام </strong>  {{$buyed->product->name}}
   <strong>،</strong>
<strong style="margin: 0 2%">کل مقدار </strong>  {{$buyed->quantity}}
<strong>،</strong>

<strong style="margin: 0 2%">باقی مقدار</strong>  {{$buyed->remaining}}

<br>
@endforeach

            <table style="margin-top: 5%">
                <thead>
                    <tr>
                        {{-- <th>شمارہ</th> --}}
                        <th>مقدار</th>
                        <th>نام</th>
                        {{-- <th>نگ</th> --}}
                        <th>قیمت</th>
                        <th>
                        کُل قیمت
                        </th>
                        {{-- <th>خرچہ</th>
                        <th > صافی قیمت</th> --}}

                    </tr>
                </thead>
                <tbody>
                        {{-- <td>1</td> --}}
                        {{--  <td>نام مصنوع</td>
                        <td>1</td>
                        <td> --}}

                        {{-- @php
                                $count=1;
                              foreach ($buyedProducts as $buyed){
                                $totalAmount=0;
                                $totalQuantity=0;
                            foreach ($sales as $sale){ --}}
                        {{-- //     if ($sale->product_id==$buyed->product_id){
                        //        echo '<td>'.$count.'</td>
                        //        <td>'.$buyed->seller->name.'</td>
                        //        <td><strong>'.$buyed->product->name.'</strong></td>
                        //        <td>'.$sale->quantity.'</td>';
                        //     $totalAmount=$totalAmount+$sale->total_price;
                        //     $count++;
                        //      }

                        //    }
                        //    echo '<td>'.$totalAmount.'</td>' ;
                        //    foreach ($amounts as $amount) {
                        //     // echo  '</tr>';
                        //     // echo    '<td>'.$buyed->seller_id.'</td></tr>';
                        //     if ($amount->seller_id==$buyed->seller_id && $amount->product_id ==$buyed->product_id) {
                        //         $pureAmount=$totalAmount-$amount->total_expenses;
                        //         echo '<td  style="padding: 20px;">کمیشن='.$amount->commision.'<br>
                        //             کرایہ='.$amount->fare.'<br>
                        //           مارکیٹ فیس='.$amount->market_fee.'<br>
                        //             مزدوری='.$amount->labour_charges.'<br>
                        //             منشیانہ='.$amount->clerkly.'<br>
                        //             <strong>_______</strong> <br>
                        //            <strong>    کل خرچ='.$amount->total_expenses.'</strong></td>
                        //             <td>'.$pureAmount.'</td></tr>';
                        //     }
                        // }
                        //  }
                        //  echo '</tr>';
                        //     @endphp --}}
                        <!-- Add more rows as needed -->
                        @php
                            $total_price = 0;
                            $total_quantity = 0;

                        @endphp
                        @foreach ($sales as $sale)
                    <tr>
                        <td> {{ $sale->quantity }} </td>
                        <td> {{ $sale->product->name }}  </td>
                        <td> {{$sale->price}} </td>
                        <td> {{ $sale->total_product_price }} </td>
                        @php
                            $total_price = $total_price + $sale->total_product_price;
                            $total_quantity = $total_quantity + $sale->quantity;
                     @endphp
                    </tr>
                    @endforeach
<tr>
<td> {{$total_quantity}}</td>
@foreach ($amounts as $amount)
<td colspan="2">

    <strong>کرایہ</strong> {{$amount->fare}} <br>
<strong>کمیشن</strong> {{$amount->commision}} <br>
 <strong>مزدوری</strong> {{$amount->labour_charges}} <br>
 <strong>مارکیٹ فیس</strong> {{$amount->market_fee}} <br>
<span style="border-bottom:2px solid black;">
   <strong> منشیانہ </strong>{{$amount->clerkly}} <br>
</span>
 <strong>میزان {{$amount->total_expenses}}</strong>

</td>
<td >
    <h4>
    کُل قیمت {{$amount->total_amount}} <br>
          <span style=" border-bottom: 2px solid black">
            خرچ {{$amount->total_expenses}} - </span> <br>
           صافی رقم {{$amount->pure_amount}}  </h4>
@endforeach
    </td>
</tr>
                </tbody>
            </table>
            {{-- <div style="margin-top: 10%"><strong>
                    چوہدری انیس جٹ :

                    03006033727</strong>
            </div>

            <div>
                <strong>
                    چوہدری انیس جٹ :
                    03006033727
                </strong>
            </div> --}}
<div class="card-footer"> نئی سبزی منڈی سرگودھا</div>        </div>
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
                    image: {
                        type: 'jpeg',
                        quality: 0.98
                    },
                    html2canvas: {
                        scale: 2
                    },
                    jsPDF: {
                        unit: 'in',
                        format: 'letter',
                        orientation: 'portrait'
                    }
                };

                html2pdf().from(pdfContent).set(options).save();
            });
        });
    </script>
</body>

</html>
