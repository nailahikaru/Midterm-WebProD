<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Detail - {{ $schedule->eventName }}</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/schedule.css') }}">
    
    <style>
        body { padding-top: 80px; font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-light">

    <x-navbar></x-navbar>

    <div class="container pb-5 my-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h3 class="mb-1 fw-bold">Attendance: {{ $schedule->eventName }}</h3>
                        <p class="text-muted mb-0">
                            <i class="bi bi-calendar"></i> {{ \Carbon\Carbon::parse($schedule->eventDate)->format('d M Y') }} 
                            | <i class="bi bi-geo-alt"></i> {{ $schedule->eventLocation }}
                        </p>
                    </div>
                    <div>
                        <a href="{{ route('presence.list') }}" class="btn btn-outline-secondary me-2"><i class="bi bi-arrow-left"></i> Back</a>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editAttendanceModal">
                            <i class="bi bi-pencil-square"></i> Update Attendance
                        </button>
                    </div>
                </div>

                <!-- Tabel Rekap -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>
                                    @php $status = $presences[$user->id] ?? null; @endphp
                                    
                                    @if($status === 'present')
                                        <span class="badge bg-success">Present</span>
                                    @elseif($status === 'leave')
                                        <span class="badge bg-warning text-dark">Leave</span>
                                    @elseif($status === 'alfa')
                                        <span class="badge bg-danger">Absent</span>
                                    @else
                                        <span class="badge bg-secondary">Not Marked</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Update Absensi -->
    <div class="modal fade" id="editAttendanceModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Attendance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('presence.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="sch_id" value="{{ $schedule->id }}">
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    @php $currentStatus = $presences[$user->id] ?? 'alfa'; @endphp
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                <input type="radio" class="btn-check" name="status[{{ $user->id }}]" id="p_present_{{ $user->id }}" value="present" {{ $currentStatus == 'present' ? 'checked' : '' }}>
                                                <label class="btn btn-outline-success" for="p_present_{{ $user->id }}">Present</label>

                                                <input type="radio" class="btn-check" name="status[{{ $user->id }}]" id="p_leave_{{ $user->id }}" value="leave" {{ $currentStatus == 'leave' ? 'checked' : '' }}>
                                                <label class="btn btn-outline-warning" for="p_leave_{{ $user->id }}">Leave</label>

                                                <input type="radio" class="btn-check" name="status[{{ $user->id }}]" id="p_alfa_{{ $user->id }}" value="alfa" {{ $currentStatus == 'alfa' ? 'checked' : '' }}>
                                                <label class="btn btn-outline-danger" for="p_alfa_{{ $user->id }}">Absent</label>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Attendance</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-footer></x-footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>