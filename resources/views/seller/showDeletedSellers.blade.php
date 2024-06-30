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
                         <h5 class="mb-4 ">Deleted Senders</h5>



<div class="px-4 pt-4 container-fluid">
    <div class="row g-4">
        <div class="col-12">
            <div class="p-4 rounded bg-light h-100">
                <h6 class="mb-4">Deleted Sender List</h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Sender Name</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Area</th>
                                <th scope="col">Restore</th>
                                <th scope="col">Permanent Delete</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($sellers))
                            @foreach ($sellers as $seller)
                            <tr>
                                <th scope="row">{{$seller->id}}</th>
                                <td> {{$seller->name}} </td>
                                <td> {{$seller->phone}} </td>
                                <td> {{$seller->area}} </td>
                                <td> <a href="{{route('restoreSeller',['id'=>$seller->id])}}" class="btn btn-primary">Restore</a> </td>
                                <td> <a href="{{route('permanentDeleteSeller',['id'=>$seller->id])}}" class="btn btn-danger">Permanent Delete</a> </td>
                            </tr>
                            @endforeach
                            @endif

                        </tbody>
                    </table>
                @if (isset($deleted))
                      @if ($deleted==1)
                    <h6>      Total Deleted Senders : {{$deleted}}</h6>
                       @elseif ($deleted>1)
                    <h6>Total Deleted Senders : {{$deleted}}</h6>
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

