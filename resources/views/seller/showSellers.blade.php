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
                                    <h5 class="mb-0">Sender</h5>
                                    <a href="{{ route('sellerForm') }}" class="btn btn-primary">Add Sender</a>
                                    <a href="{{ route('showDeletedSellers') }}" class=" ms-2" style="text-decoration: none; color: inherit;">
                                      <img src="{{asset('img/deleted.webp')}}" height="5%" width="35%" alt="Trash Icon">
                                     <span>
                                         @if (isset($deleted))
                                       {{$deleted}}
                                       @endif
                                    </span>
                                    </a>
                                      </div>

<div class="px-4 pt-4 container-fluid">
    <div class="row g-4">
        <div class="col-12">
            <div class="p-4 rounded bg-light h-100">
                <h6 class="mb-4">Senders List</h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Sender Name</th>
                                <th scope="col">Phone Number</th>
                                <th> Account Number</th>
                                <th scope="col">Area</th>
                                <th scope="col">Previous Amount</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($sellers))
                            @foreach ($sellers as $seller)
                            <tr>
                                <th scope="row">{{$seller->id}}</th>
                                <td> {{$seller->name}} </td>
                                <td> {{$seller->phone}} </td>
                                <td> {{$seller->account}} </td>
                                <td> {{$seller->area}} </td>
                                @if(isset($seller->amount))
                                <td>{{$seller->amount}}</td>
                                @else
                                <td>0</td>
                                @endif
                                {{-- <td></td> --}}
                                 <td> <a href="{{route('editSeller',['id'=>$seller->id])}}" class="btn btn-primary">Edit</a> </td>
                                <td><a href="{{route('deleteSeller',['id'=>$seller->id])}}"class="btn btn-danger">Delete</a></td>

                            </tr>
                            @endforeach
                            @endif

                        </tbody>
                    </table>
                    @if ($count==1)
                    <h6>      Total Sender : {{$count}}</h6>
                       @elseif ($count>1)
                    <h6> Total Senders : {{$count}}</h6>
                         @elseif ($count==0)
                    <h4> There is no Sender </h4>
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
 @include('layouts.footer')

