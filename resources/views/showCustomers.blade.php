@include('layouts.header')
@include('layouts.sidebar')

<div class="content">
    @include('layouts.navbar')

    <div class="px-4 pt-4 container-fluid">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="p-4 rounded bg-light h-100">
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Customers</h5>
                        <a href="{{ route('customerForm') }}" class="btn btn-primary">Add Customer</a>
                        <a href="{{ route('showDeletedCustomers') }}" class="ms-2" style="text-decoration: none; color: inherit;">
                            <img src="{{asset('img/deleted.webp')}}" height="5%" width="35%" alt="Trash Icon">
                            <span>
                                @if (isset($deleted))
                                {{$deleted}}
                                @endif
                            </span>
                        </a>
                    </div>


                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Area</th>
                                    <th scope="col">Previous Amount</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($customers))
                                @foreach ($customers as $customer)
                                <tr>
                                    <th scope="row">{{$customer->id}}</th>
                                    <td>{{$customer->name}}</td>
                                    <td>{{$customer->phone}}</td>
                                    <td>{{$customer->area}}</td>
                                    @if(isset($customer->amount))
                                    <td>{{$customer->amount}}</td>
                                    @else
                                    <td>0</td>
                                    @endif
                                    <td><a href="{{route('editCustomer',['id'=>$customer->id])}}" class="btn btn-primary">Edit</a></td>
                                    <td><a href="{{route('deleteCustomer',['id'=>$customer->id])}}" class="btn btn-danger">Delete</a></td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="6"><h2>No Customer Added</h2></td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById("searchInput");
        const tableRows = document.querySelectorAll(".table tbody tr");

        searchInput.addEventListener("input", function() {
            const query = this.value.toLowerCase();

            tableRows.forEach(row => {
                const columns = row.querySelectorAll("td");
                let found = false;

                columns.forEach(column => {
                    if (column.textContent.toLowerCase().includes(query)) {
                        found = true;
                    }
                });

                if (found) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });
    });
</script>
