@include('layouts.header')

<!-- Sidebar Start -->
@include('layouts.sidebar')
<!-- Sidebar End -->



        <!-- Content Start -->
        <div class="content">

   <!-- Navbar Start -->
   @include('layouts.navbar')
   <!-- Navbar End -->


            <!-- Form Start -->
            <div class="px-4 pt-4 container-fluid">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="p-4 rounded bg-light h-100 ">
                                <div class="mb-4 d-flex justify-content-between align-items-center">


                                      </div>


<div class="px-4 pt-4 container-fluid">
    <div class="row g-4">
        <div class="col-12">
            <div class="p-4 rounded bg-light h-100">
                <h6 class="mb-4"> </h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Expenses</th>
                                <th scope="col">Date</th>
                                <th scope="col">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($expenses))
                            @foreach ($expenses as $expense)
                            <tr>
                                <td> {{$expense->amount}} </td>
                                <td> {{$expense->created_date}} </td>
                           <td > <a href="{{route('expenseDetails',['date'=>$expense->created_date])}}"  class="btn btn-primary bg-primary">Details</a> </td>


                            </tr>
                            @endforeach
                            @endif

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>



                        </div>
                    </div>




                </div>
            </div>
            <!-- Form End -->


            <!-- Footer Start -->
          @include('layouts.footer')

