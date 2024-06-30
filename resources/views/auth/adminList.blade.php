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
                                    <h5 class="mb-0">All Admins</h5>
                                   <a href="{{ route('register') }}" class="btn btn-primary">Add Admin </a>
                                      </div>

<div class="px-4 pt-4 container-fluid">
    <div class="row g-4">
        <div class="col-12">
            <div class="p-4 rounded bg-light h-100">
                <h6 class="mb-4">Admin List</h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Admin ID</th>
                                <th scope="col"> Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Created at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($admins))
                            @foreach ($admins as $admin)
                            <tr>
                                <td> {{$admin->id}} </td>
                                <td> {{$admin->name}} </td>
                                <td> {{$admin->email}} </td>
                                <td> {{$admin->created_at}} </td>
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

