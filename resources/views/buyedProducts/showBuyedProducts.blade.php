@include('layouts.header')
@include('layouts.sidebar')

<div class="content">
    @include('layouts.navbar')

    <div class="px-4 pt-4 container-fluid">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="p-4 rounded bg-light h-100">
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Received Products</h5>
                        <a href="{{ route('buyedProductForm') }}" class="btn btn-primary">Add Received Products</a>
                        {{-- <a href="" class="ms-2" style="text-decoration: none; color: inherit;">
                            <img src="{{asset('img/deleted.webp')}}" height="5%" width="35%" alt="Trash Icon">
                            <span>
                                @if (isset($deleted))
                                {{$deleted}}
                                @endif
                            </span>
                        </a> --}}
                    </div>


                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($buyedProducts))
                                @foreach ($buyedProducts as $buyedProduct)
                                <tr>
                                    <td>{{$buyedProduct->total_quantity}}</td>
                                    <td data-date="{{$buyedProduct->created_date}}">{{ \Carbon\Carbon::parse($buyedProduct->created_date)->format('d-m-Y') }}
                                    </td>
                                    <td><a href="{{route('dayDetails',['date'=>$buyedProduct->created_date])}}" class="m-2 btn btn-primary bg-primary">Details</a></td>
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
                    // Check text content
                    if (column.textContent.toLowerCase().includes(query)) {
                        found = true;
                    }
                    // Check date attribute
                    if (column.getAttribute("data-date") && column.getAttribute("data-date").includes(query)) {
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
