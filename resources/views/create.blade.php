<!DOCTYPE html>
<html>
<head>
    <title>Create Client</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Create Client</h2>

    <form method="POST" action="{{ route('clients.store') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="mobile_number" class="form-label">Mobile Number:</label>
            <input type="text" id="mobile_number" name="mobile_number" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="email" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Gender:</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="male" name="gender" value="Male" required>
                <label class="form-check-label" for="male">Male</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="female" name="gender" value="Female" required>
                <label class="form-check-label" for="female">Female</label>
            </div>
        </div>

        <div class="mb-3">
            <label for="state" class="form-label">State:</label>
            <input type="text" id="state" name="state" class="form-control" list="states" required>
            <datalist id="states">
                @foreach($states as $state)
                    <option value="{{ $state }}">
                @endforeach
            </datalist>
        </div>

        <div class="mb-3">
            <label for="city" class="form-label">City:</label>
            <input type="text" id="city" name="city" class="form-control" list="cities" required>
            <datalist id="cities">
                @foreach($cities as $city)
                    <option value="{{ $city }}">
                @endforeach
            </datalist>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address:</label>
            <textarea id="address" name="address" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Client</button>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
