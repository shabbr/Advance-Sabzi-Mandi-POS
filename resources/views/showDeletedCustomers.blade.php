@include('layouts.header')

<!-- Sidebar Start -->
@include('layouts.sidebar')
<!-- Sidebar End -->



        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <!-- Navbar End -->



            <!-- Form Start -->
            <div class="px-4 pt-4 container-fluid">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="p-4 rounded bg-light h-100">
                         <h5 class="mb-4 ">Deleted Customers</h5>



<div class="px-4 pt-4 container-fluid">
    <div class="row g-4">
        <div class="col-12">
            <div class="p-4 rounded bg-light h-100">
                <h6 class="mb-4">Deleted Customers List</h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Area</th>
                                <th scope="col">Restore</th>
                                <th scope="col">Permanent Delete</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($customers))
                            @foreach ($customers as $customer)
                            <tr>
                                <th scope="row">{{$customer->id}}</th>
                                <td> {{$customer->name}} </td>
                                <td> {{$customer->phone}} </td>
                                <td> {{$customer->area}} </td>
                                <td> <a href="{{route('restoreCustomer',['id'=>$customer->id])}}" class="btn btn-primary">Restore</a> </td>
                                <td> <a href="{{route('permanentDeleteCustomer',['id'=>$customer->id])}}" class="btn btn-danger">Permanent Delete</a> </td>
                            </tr>
                            @endforeach
                            @endif

                        </tbody>
                    </table>
                @if (isset($deleted))
                      @if ($deleted==1)
                    <h6>      Total Deleted Customer : {{$deleted}}</h6>
                       @elseif ($deleted>1)
                    <h6>Total Deleted Customers : {{$deleted}}</h6>
                         @elseif ($deleted==0)
                    <h4> Your Trash is Empty </h4>
                      @endif
                @endif


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

