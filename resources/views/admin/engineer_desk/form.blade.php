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
        text-decoration: none;
        display: inline-block;
    }

    .search-btn {
        background: #f25c05;
        color: #fff;
    }

    .search-btn:hover {
        background: #d94f03;
        color: #fff;
    }

    .reset-btn {
        background: #1c2c3e;
        color: #fff;
    }

    .reset-btn:hover {
        background: #162433;
        color: #fff;
    }
</style>

<div class="lead-list-page">
    <div class="lead-list-header">
        <h2>Intrested Lead List</h2>
    </div>

    <div class="search-card">
        <form id="searchForm" class="search-form">
            <input
                type="text"
                name="search"
                id="searchInput"
                class="search-input"
                placeholder="Search by title, contact name, mobile, city"
                value="{{ request('search') }}"
            >

            <button type="submit" class="search-btn">Search</button>
            <a href="{{ route('admin.allprojects') }}" class="reset-btn" id="resetSearch">Reset</a>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div id="projectTableWrapper">
        @include('admin.project.partials.project_table_serious', ['posts' => $posts])
    </div>
</div>
@endsection

@push('scripts')
<script>
    function loadProjectTable(url) {
        $.ajax({
            url: url,
            type: 'GET',
            beforeSend: function () {
                $('#projectTableWrapper').css('opacity', '0.6');
            },
            success: function (response) {
                $('#projectTableWrapper').html(response);
            },
            error: function () {
                alert('Data load failed.');
            },
            complete: function () {
                $('#projectTableWrapper').css('opacity', '1');
            }
        });
    }

    $(document).on('submit', '#searchForm', function(e) {
        e.preventDefault();

        let search = $('#searchInput').val();
        let url = "{{ route('admin.allprojects') }}?search=" + encodeURIComponent(search);

        loadProjectTable(url);
    });

    $(document).on('click', '#projectTableWrapper .pagination a', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
        loadProjectTable(url);
    });
</script>
@endpush