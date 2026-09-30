@extends('layouts.app')

@section('title', 'Dashboard — LibraryMS')
@section('breadcrumb', 'Dashboard')

@section('content')

{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    @php
    $cards = [
        ['label'=>'Total Books',      'value'=>$stats['total_books'],      'icon'=>'bi-journals',         'bg'=>'#eff6ff','icon_bg'=>'#2563eb','icon_color'=>'#fff'],
        ['label'=>'Available Books',  'value'=>$stats['available_books'],  'icon'=>'bi-check-circle',     'bg'=>'#f0fdf4','icon_bg'=>'#16a34a','icon_color'=>'#fff'],
        ['label'=>'Total Members',    'value'=>$stats['total_members'],    'icon'=>'bi-people',           'bg'=>'#faf5ff','icon_bg'=>'#7c3aed','icon_color'=>'#fff'],
        ['label'=>'Active Borrows',   'value'=>$stats['active_borrows'],   'icon'=>'bi-arrow-left-right', 'bg'=>'#fff7ed','icon_bg'=>'#ea580c','icon_color'=>'#fff'],
        ['label'=>'Overdue Books',    'value'=>$stats['overdue_borrows'],  'icon'=>'bi-exclamation-triangle','bg'=>'#fff1f2','icon_bg'=>'#e11d48','icon_color'=>'#fff'],
        ['label'=>'Total Authors',    'value'=>$stats['total_authors'],    'icon'=>'bi-person-lines-fill','bg'=>'#ecfdf5','icon_bg'=>'#059669','icon_color'=>'#fff'],
        ['label'=>'Categories',       'value'=>$stats['total_categories'], 'icon'=>'bi-tag',              'bg'=>'#fefce8','icon_bg'=>'#ca8a04','icon_color'=>'#fff'],
        ['label'=>'Total Fines ($)',  'value'=>number_format($stats['total_fines'],2), 'icon'=>'bi-cash-coin','bg'=>'#fff7ed','icon_bg'=>'#d97706','icon_color'=>'#fff'],
    ];
    @endphp

    @foreach($cards as $card)
    <div class="col-6 col-md-3">
        <div class="card stat-card h-100" style="background:{{ $card['bg'] }}">
            <div class="card-body d-flex align-items-center gap-3 py-3">
                <div class="stat-icon flex-shrink-0"
                     style="background:{{ $card['icon_bg'] }};color:{{ $card['icon_color'] }}">
                    <i class="bi {{ $card['icon'] }}"></i>
                </div>
                <div>
                    <div class="fw-bold fs-5 lh-1">{{ $card['value'] }}</div>
                    <div class="text-muted" style="font-size:.8rem">{{ $card['label'] }}</div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="row g-3">

    {{-- Recent Borrows --}}
    <div class="col-lg-7">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center py-3">
                <span><i class="bi bi-clock-history me-2 text-primary"></i>Recent Borrow Activity</span>
                <a href="{{ route('borrows.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="ps-3">Book</th>
                                <th>Member</th>
                                <th>Due Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentBorrows as $borrow)
                            <tr>
                                <td class="ps-3">
                                    <a href="{{ route('books.show', $borrow->book) }}"
                                       class="text-decoration-none fw-semibold text-dark"
                                       title="{{ $borrow->book->title }}">
                                        {{ Str::limit($borrow->book->title, 30) }}
                                    </a>
                                </td>
                                <td>{{ $borrow->member->name }}</td>
                                <td>{{ $borrow->due_date->format('d M Y') }}</td>
                                <td>
                                    <span class="badge badge-{{ $borrow->status }} px-2 py-1 rounded-pill">
                                        {{ ucfirst($borrow->status) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center text-muted py-4">No borrow records yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Right column --}}
    <div class="col-lg-5 d-flex flex-column gap-3">

        {{-- Overdue --}}
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center py-3">
                <span><i class="bi bi-exclamation-triangle me-2 text-danger"></i>Overdue Books</span>
                <a href="{{ route('borrows.index', ['status'=>'overdue']) }}" class="btn btn-sm btn-outline-danger">View All</a>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @forelse($overdueBorrows as $borrow)
                    <li class="list-group-item d-flex justify-content-between align-items-start py-2 px-3">
                        <div>
                            <div class="fw-semibold" style="font-size:.88rem">{{ Str::limit($borrow->book->title, 28) }}</div>
                            <small class="text-muted">{{ $borrow->member->name }}</small>
                        </div>
                        <span class="badge bg-danger rounded-pill mt-1">
                            {{ $borrow->due_date->diffForHumans() }}
                        </span>
                    </li>
                    @empty
                    <li class="list-group-item text-center text-muted py-3">No overdue books.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        {{-- Popular Books --}}
        <div class="card">
            <div class="card-header py-3">
                <i class="bi bi-star me-2 text-warning"></i>Most Borrowed Books
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @forelse($popularBooks as $i => $book)
                    <li class="list-group-item d-flex align-items-center gap-3 py-2 px-3">
                        <span class="fw-bold text-muted" style="width:20px">{{ $i + 1 }}</span>
                        <div class="flex-grow-1">
                            <div class="fw-semibold" style="font-size:.88rem">{{ Str::limit($book->title, 28) }}</div>
                            <small class="text-muted">{{ $book->author->name ?? '—' }}</small>
                        </div>
                        <span class="badge bg-primary rounded-pill">{{ $book->borrow_records_count }}</span>
                    </li>
                    @empty
                    <li class="list-group-item text-center text-muted py-3">No data yet.</li>
                    @endforelse
                </ul>
            </div>
        </div>

    </div>
</div>

@endsection
