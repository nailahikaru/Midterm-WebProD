<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Event Schedule - UKM</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/schedule.css') }}">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="bi bi-calendar-event"></i> UKM App</a>
            <div class="d-flex">
                <span class="navbar-text text-white">Hello, {{ Auth::user()->name ?? 'Guest' }}</span>
            </div>
        </div>
    </nav>

    <div class="container pb-5">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-0 fw-bold">Event Schedule</h2>
                <p class="text-muted mb-0">List of UKM agendas and events</p>
            </div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addScheduleModal">
                <i class="bi bi-plus-lg"></i> Add Schedule
            </button>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control" id="searchInput" placeholder="Search events by name or location...">
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover" id="scheduleTable">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Event Name</th>
                                <th>Date & Time</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="scheduleBody">
                            <!-- UBAH VARIABEL JADI $schedules -->
                            @forelse($schedules as $index => $schedule)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <strong>{{ $schedule->eventName }}</strong>
                                    <br><small class="text-muted">Created by: {{ $schedule->user->name ?? 'Unknown' }}</small>
                                </td>
                                <td>
                                    <i class="bi bi-clock text-muted"></i> 
                                    {{ \Carbon\Carbon::parse($schedule->eventDate)->format('d M Y') }}, {{ $schedule->eventTime }}
                                </td>
                                <td><i class="bi bi-geo-alt text-muted"></i> {{ $schedule->eventLocation }}</td>
                                <td>
                                    @if(\Carbon\Carbon::parse($schedule->eventDate)->isFuture())
                                        <span class="badge bg-success">Upcoming</span>
                                    @else
                                        <span class="badge bg-secondary">Completed</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <!-- Sesuaikan nama route & ID -->
                                    <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#attendanceModal-{{ $schedule->id }}" title="Attendance"><i class="bi bi-person-check"></i></button>
                                    
                                    <button class="btn btn-sm btn-outline-warning" title="Edit"><i class="bi bi-pencil"></i></button>
                                    
                                    <!-- Route delete disesuaikan -->
                                    <form action="{{ route('schedule.destroy', $schedule->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this schedule?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>

                            <!-- MODAL ATTENDANCE -->
                            <div class="modal fade" id="attendanceModal-{{ $schedule->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Attendance: {{ $schedule->eventName }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="#" method="POST"> <!-- Nanti ganti action route presensi -->
                                            @csrf
                                            <input type="hidden" name="sch_id" value="{{ $schedule->id }}">
                                            <div class="modal-body">
                                                <p class="text-muted small">Mark the attendance status for each member below.</p>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th>Name</th>
                                                                <th class="text-center">Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <!-- UBAH JADI $users -->
                                                            @forelse($users as $user)
                                                            <tr>
                                                                <td>{{ $user->name }}</td>
                                                                <td class="text-center">
                                                                    <div class="btn-group btn-group-sm">
                                                                        <!-- Value disesuaikan dengan enum database: present, leave, alfa -->
                                                                        <input type="radio" class="btn-check" name="status[{{ $user->id }}]" id="present_{{ $schedule->id }}_{{ $user->id }}" value="present" checked>
                                                                        <label class="btn btn-outline-success" for="present_{{ $schedule->id }}_{{ $user->id }}">Present</label>

                                                                        <input type="radio" class="btn-check" name="status[{{ $user->id }}]" id="leave_{{ $schedule->id }}_{{ $user->id }}" value="leave">
                                                                        <label class="btn btn-outline-warning" for="leave_{{ $schedule->id }}_{{ $user->id }}">Leave</label>

                                                                        <input type="radio" class="btn-check" name="status[{{ $user->id }}]" id="alfa_{{ $schedule->id }}_{{ $user->id }}" value="alfa">
                                                                        <label class="btn btn-outline-danger" for="alfa_{{ $schedule->id }}_{{ $user->id }}">Absent</label>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            @empty
                                                            <tr>
                                                                <td colspan="2" class="text-center text-muted">No members found.</td>
                                                            </tr>
                                                            @endforelse
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
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    <i class="bi bi-calendar-x fs-3 d-block mb-2"></i>
                                    No schedules found. Click "Add Schedule" to create one.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div id="noResults" class="text-center text-muted d-none mt-3">
                    <i class="bi bi-search fs-4"></i>
                    <p>No events found matching your search.</p>
                </div>

            </div>
        </div>
    </div>

    <!-- MODAL ADD SCHEDULE -->
    <div class="modal fade" id="addScheduleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Schedule</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('schedule.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="eventName" class="form-label">Event Name</label>
                            <!-- name="" disesuaikan dengan database -->
                            <input type="text" class="form-control" id="eventName" name="eventName" placeholder="e.g., Weekly Meeting" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="eventDate" class="form-label">Start Date</label>
                                <input type="date" class="form-control" id="eventDate" name="eventDate" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="eventTime" class="form-label">Time</label>
                                <input type="time" class="form-control" id="eventTime" name="eventTime" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="eventLocation" class="form-label">Location</label>
                            <input type="text" class="form-control" id="eventLocation" name="eventLocation" placeholder="e.g., Main Hall" required>
                        </div>
                        <div class="mb-3">
                            <label for="eventDesc" class="form-label">Description (Optional)</label>
                            <textarea class="form-control" id="eventDesc" name="eventDesc" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Schedule</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/schedule.js') }}"></script>
</body>
</html>