@extends('layouts.app')

@section('title', 'My Projects')

@section('content')
<style>
    .my-projects-page { min-height: 65vh; padding: 36px 18px 64px; background: #f3f7fa; }
    .my-projects-wrap { width: min(100%, 1120px); margin: 0 auto; }
    .my-projects-heading { display: flex; align-items: center; justify-content: space-between; gap: 16px; margin-bottom: 22px; }
    .my-projects-heading h1 { margin: 0 0 5px; color: #1c2c3e; font-size: 28px; font-weight: 750; }
    .my-projects-heading p { margin: 0; color: #64748b; }
    .my-projects-action { background: #f25c05; color: #fff; border-radius: 8px; padding: 10px 14px; text-decoration: none; font-weight: 700; white-space: nowrap; }
    .my-projects-action:hover { background: #d94f03; color: #fff; }
    .my-projects-table-wrap { overflow-x: auto; background: #fff; border: 1px solid #dfe7ef; border-radius: 10px; }
    .my-projects-table { width: 100%; border-collapse: collapse; min-width: 620px; }
    .my-projects-table th, .my-projects-table td { padding: 14px 16px; border-bottom: 1px solid #edf1f5; text-align: left; }
    .my-projects-table th { background: #f8fafc; color: #34445a; font-size: 13px; }
    .my-projects-table td { color: #425166; }
    .my-projects-empty { background: #fff; border: 1px solid #dfe7ef; border-radius: 10px; padding: 30px; text-align: center; color: #64748b; }
    @media (max-width: 600px) { .my-projects-heading { align-items: flex-start; flex-direction: column; } }
</style>

<main class="my-projects-page">
    <div class="my-projects-wrap">
        <div class="my-projects-heading">
            <div>
                <h1>My Projects</h1>
                <p>Welcome, {{ session('customer_name') }}. Your project requests are listed here.</p>
            </div>
            <a class="my-projects-action" href="{{ route('post') }}">+ Post a project</a>
        </div>

        @if($projects->isEmpty())
            <div class="my-projects-empty">You have not posted a project yet.</div>
        @else
            <div class="my-projects-table-wrap">
                <table class="my-projects-table">
                    <thead><tr><th>Project</th><th>City</th><th>Status</th><th>Posted</th></tr></thead>
                    <tbody>
                        @foreach($projects as $project)
                            <tr>
                                <td>{{ $project->title }}</td>
                                <td>{{ $project->city_name ?: '—' }}</td>
                                <td>{{ ucfirst($project->lead_status ?: 'Submitted') }}</td>
                                <td>{{ \Illuminate\Support\Carbon::parse($project->created_at)->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">{{ $projects->links() }}</div>
        @endif
    </div>
</main>
@endsection