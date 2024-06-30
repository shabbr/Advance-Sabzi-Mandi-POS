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

 <form action="{{route('updateSack',['id'=>$sack->id])}}" method="post">
  @csrf
    <label for=""> <strong> Update Sack</strong></label>
 <input type="text" name="name" value="{{$sack->name}}" required class="col-sm-8 col-xl-8">
 <input type="submit" value="Update" class="btn btn-primary">
</form>




                        </div>
                    </div>




                </div>
            </div>
            <!-- Form End -->


            <!-- Footer Start -->

            @include('layouts.footer')
