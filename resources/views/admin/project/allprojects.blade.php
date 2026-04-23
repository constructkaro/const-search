@extends('layouts.admin')

@section('content')
<style>
    .lead-list-page {
        background: #f4f7fb;
        min-height: 100vh;
        padding: 24px;
    }

    .lead-list-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .lead-list-header h2 {
        margin: 0;
        color: #1c2c3e;
        font-weight: 700;
        font-size: 28px;
    }

    .add-btn {
        background: #f25c05;
        color: white;
        padding: 10px 18px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        display: inline-block;
    }

    .add-btn:hover {
        color: #fff;
        background: #d94f03;
    }

    .search-card {
        background: #fff;
        border-radius: 18px;
        padding: 18px;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
        border: 1px solid #ebeff5;
        margin-bottom: 20px;
    }

    .search-form {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        align-items: center;
    }

    .search-input {
        flex: 1;
        min-width: 260px;
        border: 1px solid #dbe3ec;
        border-radius: 12px;
        padding: 11px 14px;
        font-size: 14px;
        outline: none;
    }

    .search-input:focus {
        border-color: #f25c05;
        box-shadow: 0 0 0 0.15rem rgba(242, 92, 5, 0.15);
    }

    .search-btn,
    .reset-btn {
        border: none;
        border-radius: 12px;
        padding: 11px 18px;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        display: inline-block;
        cursor: pointer;
    }

    .search-btn { background: #f25c05; color: #fff; }
    .search-btn:hover { background: #d94f03; color: #fff; }
    .reset-btn { background: #1c2c3e; color: #fff; }
    .reset-btn:hover { background: #162433; color: #fff; }
</style>

<div class="lead-list-page">

    {{-- ✅ Header with Add Button --}}
    <div class="lead-list-header">
        <h2>Lead List</h2>
        <a href="{{ route('admin.post-leads.create') }}" class="add-btn">+ Add New Lead</a>
    </div>

    {{-- ✅ Search Bar --}}
    <div class="search-card">
        <form id="searchForm" class="search-form">
            <input
                type="text"
                name="search"
                id="searchInput"
                class="search-input"
                placeholder="Search by title, contact name, mobile, city..."
                value="{{ request('search') }}"
            >
            <button type="submit" class="search-btn">Search</button>
            <a href="{{ route('admin.allprojects') }}" class="reset-btn">Reset</a>
        </form>
    </div>

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- ✅ Table loaded via partial --}}
    <div id="projectTableWrapper">
        @include('admin.project.partials.project_table', ['posts' => $posts])
    </div>

</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const CSRF_TOKEN = '{{ csrf_token() }}';

    // ── Bind status dropdowns (called on load + after AJAX) ──
    function bindStatusDropdowns() {
        document.querySelectorAll('.lead-status-dropdown').forEach(function (select) {
            // remove old listener by cloning
            const fresh = select.cloneNode(true);
            select.parentNode.replaceChild(fresh, select);

            fresh.addEventListener('change', function () {
                const id     = this.dataset.id;
                const status = this.value;
                const el     = this;

                if (!status) return;

                fetch(`/admin/post-leads/${id}/update-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                    },
                    body: JSON.stringify({ lead_status: status }),
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        el.className = 'status-select lead-status-dropdown';
                        if (status === 'timepass')  el.classList.add('status-timepass');
                        if (status === 'exploring') el.classList.add('status-exploring');
                        if (status === 'serious')   el.classList.add('status-serious');
                        showToast('Status updated successfully!', 'success');
                    } else {
                        showToast('Update failed. Try again.', 'error');
                    }
                })
                .catch(() => showToast('Something went wrong.', 'error'));
            });
        });
    }

    // ── AJAX Table Load ──
    function loadProjectTable(url) {
        $('#projectTableWrapper').css('opacity', '0.5');
        $.ajax({
            url: url,
            type: 'GET',
            success: function (response) {
                $('#projectTableWrapper').html(response);
                bindStatusDropdowns();
            },
            error: function () {
                alert('Data load failed. Please try again.');
            },
            complete: function () {
                $('#projectTableWrapper').css('opacity', '1');
            }
        });
    }

    // ── Search Submit ──
    $(document).on('submit', '#searchForm', function (e) {
        e.preventDefault();
        const search = $('#searchInput').val();
        const url = "{{ route('admin.allprojects') }}?search=" + encodeURIComponent(search);
        loadProjectTable(url);
    });

    // ── Pagination Click ──
    $(document).on('click', '#projectTableWrapper .pagination a', function (e) {
        e.preventDefault();
        loadProjectTable($(this).attr('href'));
    });

    // ── Toast ──
    function showToast(message, type) {
        const toast = document.createElement('div');
        toast.textContent = message;
        toast.style.cssText = `
            position:fixed; bottom:24px; right:24px; z-index:9999;
            padding:12px 20px; border-radius:10px; font-size:14px; font-weight:600;
            box-shadow:0 4px 12px rgba(0,0,0,0.12); transition:opacity 0.4s ease;
            background:${type === 'success' ? '#dcfce7' : '#fee2e2'};
            color:${type === 'success' ? '#15803d' : '#dc2626'};
        `;
        document.body.appendChild(toast);
        setTimeout(() => {
            toast.style.opacity = '0';
            setTimeout(() => toast.remove(), 400);
        }, 2500);
    }

    // ── Init ──
    bindStatusDropdowns();
</script>
@endsection