<h2>{{ ucfirst(str_replace('-', ' ', $slug)) }} List</h2>

{{-- ADD BUTTON --}}
<a href="{{ route('vendor.category.create', $slug) }}" style="background:orange;padding:10px;color:white;">
    + Add New
</a>

<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Company Name</th>
        <th>City</th>
        <th>Status</th>
    </tr>

    @foreach($data as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->company_name }}</td>
            <td>{{ $item->city }}</td>
            <td>{{ $item->status }}</td>
        </tr>
    @endforeach
</table>