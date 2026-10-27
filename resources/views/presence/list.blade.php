<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance List - UKM App</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <!-- CSS Sendiri -->
    <link rel="stylesheet" href="{{ asset('assets/css/schedule.css') }}">
    
    <style>
        body { padding-top: 80px; font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-light">

    {{-- <x-navbar></x-navbar> --}}

    <div class="container pb-5 my-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-0 fw-bold">Attendance List</h2>
                <p class="text-muted mb-0">Select an event to mark or view attendance.</p>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Event Name</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($schedules as $index => $schedule)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><strong>{{ $schedule->eventName }}</strong></td>
                                <td>{{ \Carbon\Carbon::parse($schedule->eventDate)->format('d M Y') }}</td>
                                <td>
                                    @if(\Carbon\Carbon::parse($schedule->eventDate)->isFuture())
                                        <span class="badge bg-success">Upcoming</span>
                                    @else
                                        <span class="badge bg-secondary">Completed</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('presence.index', $schedule->id) }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-person-check"></i> View / Mark Attendance
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-5">
                                    <i class="bi bi-calendar-x fs-1 d-block mb-3"></i>
                                    No schedules available.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- <x-footer></x-footer> --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>