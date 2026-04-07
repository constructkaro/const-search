<!DOCTYPE html>
<html>
<head>
    <title>{{ ucfirst(str_replace('-', ' ', $slug)) }} List</title>
    <style>
        body{
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            margin: 0;
            padding: 30px;
        }

        .page-title{
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #222;
        }

        .top-bar{
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .add-btn{
            background: orange;
            color: #fff;
            text-decoration: none;
            padding: 10px 16px;
            border-radius: 4px;
            font-size: 14px;
        }

        .add-btn:hover{
            background: #e69500;
        }

        .table-box{
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 6px;
            overflow: hidden;
        }

        table{
            width: 100%;
            border-collapse: collapse;
        }

        table th{
            background: #f1f1f1;
            color: #333;
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        table td{
            padding: 12px;
            border-bottom: 1px solid #eee;
            color: #444;
        }

        table tr:hover{
            background: #fafafa;
        }

        .no-data{
            text-align: center;
            padding: 20px;
            color: #777;
        }

        .success-msg{
            background: #d4edda;
            color: #155724;
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <div class="page-title">
        {{ ucfirst(str_replace('-', ' ', $slug)) }} List
    </div>

    @if(session('success'))
        <div class="success-msg">
            {{ session('success') }}
        </div>
    @endif

    <div class="top-bar">
        <div></div>
        <a href="{{ route('vendor.category.create', $slug) }}" class="add-btn">
            + Add New
        </a>
    </div>

    <div class="table-box">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Company Name</th>
                    <th>City</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->company_name ?? '-' }}</td>
                        <td>{{ $item->city ?? '-' }}</td>
                        <td>{{ $item->status ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="no-data">No data found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>
</html>