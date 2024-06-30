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
                        <div class="p-4 rounded bg-light h-100">
                            <h5 class="mb-4 ">Sacks</h5>

 <form action="{{route('addSack')}}" method="post">
@csrf
    <label for=""> <strong> Add Sack</strong></label>
 <input type="text" name="name" placeholder="Add Sack Type" required class="col-sm-8 col-xl-8">
 <input type="submit" value="Add" class="btn btn-primary">
</form>

<div class="px-4 pt-4 container-fluid">
    <div class="row g-4">
        <div class="col-12">
            <div class="p-4 rounded bg-light h-100">
                <h6 class="mb-4">Sacks List</h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Sack Name</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($sacks))
                            @foreach ($sacks as $Sack)
                            <tr>
                                <th scope="row">{{$Sack->id}}</th>
                                <td> {{$Sack->name}} </td>
                                <td> <a href="{{route('editSack',['id'=>$Sack->id])}}" class="btn btn-primary">Edit</a> </td>
                                <td><a href="{{route('deleteSack',['id'=>$Sack->id])}}"class="btn btn-danger">Delete</a></td>
                            </tr>
                            @endforeach
                          @else
                          <tr>
                            <td>
                                <h2>No Sack Added </h2>
                            </td>
                          </tr>
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
