<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Clients</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <div class="col-md-3">
            <a href="http://127.0.0.1:8000/clients/create"><button type="button" class="btn btn-primary mt-4" id="btn">AddMore</button></a>
        </div>
        <br>
        <h1>List of Clients</h1>
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="stateFilter" class="form-label">State:</label>
                <select id="stateFilter" class="form-select">
                    <option value="">All States</option>
                    <!-- Populate options dynamically with database information -->
                    @foreach($states as $state)
                    <option value="{{ $state }}">{{ $state }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="cityFilter" class="form-label">City:</label>
                <select id="cityFilter" class="form-select">
                    <option value="">All Cities</option>
                    <!-- Populate options dynamically with database information -->
                    @foreach($cities as $city)
                    <option value="{{ $city }}">{{ $city }}</option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="start_date" class="form-label">Start Date:</label>
                    <input type="text" class="form-control" id="start_date">
                </div>
                <div class="col-md-4">
                    <label for="end_date" class="form-label">End Date:</label>
                    <input type="text" class="form-control" id="end_date">
                </div>
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-primary mt-4" id="filterBtn">Apply Filter</button>
            </div>
        </div>

        @if ($clients->isEmpty())
        <p>No clients found.</p>
        @else
        <table id="clientsTable" class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Mobile Number</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>State</th>
                    <th>City</th>
                    <th>Create date</th>
                    <th>Address</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                <tr>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->mobile_number }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->gender }}</td>
                    <td>{{ $client->state }}</td>
                    <td>{{ $client->city }}</td>
                    <td>{{ $client->created_at?->format('Y-m-d') }}</td>


                    <td>
                        <div class="input-group">
                            <input type="text" class="form-control" value="{{ $client->address }}" readonly>
                            <button class="btn btn-outline-secondary" type="button" onclick="copyAddress(this)">Copy</button>
                        </div>
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editClientModal{{ $client->id }}">
                            Edit
                        </button>
                    </td>
                </tr>

                <!-- Edit Client Modal -->
                <div class="modal fade" id="editClientModal{{ $client->id }}" tabindex="-1" aria-labelledby="editClientModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editClientModalLabel">Edit Client</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('clients.update', $client->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $client->name }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $client->email }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable with options
            var table = $('#clientsTable').DataTable();

            window.copyAddress = function(button) {
                var input = button.parentNode.querySelector('input');
                input.select();
                document.execCommand('copy');
            };

            // Filter function
            $('#filterBtn').on('click', function() {
                var stateFilter = $('#stateFilter').val();
                var cityFilter = $('#cityFilter').val();
                var dateRangeFilter = $('#dateRangeFilter').val();

                // Apply filters
                table.column(4).search(stateFilter).draw();
                table.column(5).search(cityFilter).draw();

                // You can handle date range filter here
            });
        });
        $(document).ready(function() {
            // Initialize DataTable
            $('#clientsTable').DataTable();
        });
        $(document).ready(function() {
            // Initialize DataTable
            $('#clientsTable').DataTable();

            // Initialize datepickers
            $('#start_date, #end_date').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true
            });
        });
    </script>

    </script>

</body>

</html>