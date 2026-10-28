<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cash Flow - UKM App</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/schedule.css') }}">
    
    <style>
        body { padding-top: 80px; font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }
        /* Kustomisasi Card Ringkasan */
        .card-income { background: linear-gradient(135deg, #4DD599, #c9fae3); color: white; }
        .card-expense { background: linear-gradient(135deg, #FF6B6B, #ffd8d8); color: white; }
        .card-balance { background: linear-gradient(135deg, #8ECFFF, #dcf0ff); color: white; }
        .card-summary h6 { font-weight: 500; opacity: 0.9; }
        .card-summary h3 { font-weight: 700; margin-bottom: 0; }
    </style>
</head>
<body class="bg-light">

    <x-navbar></x-navbar>

    <div class="container pb-5 my-4">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-0 fw-bold">Cash Flow</h2>
                <p class="text-muted mb-0">Manage UKM's income and expenses</p>
            </div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCashModal">
                <i class="bi bi-plus-lg"></i> Add Transaction
            </button>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Ringkasan Saldo -->
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card card-summary card-income shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h6>Total Income</h6>
                        <h3>Rp {{ number_format($totalIncome, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card card-summary card-expense shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h6>Total Expense</h6>
                        <h3>Rp {{ number_format($totalExpense, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card card-summary card-balance shadow-sm border-0 h-100">
                    <div class="card-body">
                        <h6>Current Balance</h6>
                        <h3>Rp {{ number_format($balance, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Transaksi -->
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Added By</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($cashes as $index => $cash)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($cash->date)->format('d M Y') }}</td>
                                <td><strong>{{ $cash->description }}</strong></td>
                                <td>
                                    @if($cash->type == 'income')
                                        <span class="badge bg-success">Income</span>
                                    @else
                                        <span class="badge bg-danger">Expense</span>
                                    @endif
                                </td>
                                <td class="{{ $cash->type == 'income' ? 'text-success' : 'text-danger' }} fw-bold">
                                    {{ $cash->type == 'income' ? '+' : '-' }} Rp {{ number_format($cash->amount, 0, ',', '.') }}
                                </td>
                                <td><small class="text-muted">{{ $cash->user->name ?? 'Unknown' }}</small></td>
                                <td class="text-center">
                                    <form action="{{ route('cash.destroy', $cash->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this transaction?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-5">
                                    <i class="bi bi-wallet2 fs-1 d-block mb-3"></i>
                                    No transactions found. Click "Add Transaction" to start.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add Transaction -->
    <div class="modal fade" id="addCashModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('cash.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Transaction Type</label>
                            <select class="form-select" name="type" required>
                                <option value="" disabled selected>-- Choose Type --</option>
                                <option value="income">Income (Uang Masuk)</option>
                                <option value="expense">Expense (Uang Keluar)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Amount (Rp)</label>
                            <input type="number" class="form-control" name="amount" placeholder="e.g., 50000" required min="1">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <input type="text" class="form-control" name="description" placeholder="e.g., Konsumsi Rapat" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" class="form-control" name="date" required value="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Transaction</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-footer></x-footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>