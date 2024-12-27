@extends('layouts.admin_layout')
@section('content')
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid black;
        padding: 5px 10px;
    }
    .number {
        width: 20px;
        text-align: center;
    }
    .paginate-item {
        border: 1px solid black;
        padding: 0 5px;
        text-decoration: none;
    }
    .paginate-button {
        /* border: 1px solid black; */
        background-color: #3d943d;
        color: white;
        padding: 0 5px;
        text-decoration: none;
    }
    .disabled-paginate {
        pointer-events: none;
        background-color: #cacaca;
        color: white;
        border: none;
    }
    .active-paginate {
        pointer-events: none;
        background-color: green;
        color: white;
        border: none;
    }
</style>

<h1>Manage Services</h1>
<table>
    <thead>
        <tr>
            <th class="number">#</th>
            <th>Name</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($services as $key=>$sr)
            <tr>
                <td class="number">{{ $loop->iteration }}</td>
                <td>
                    {{ $sr->name }}
                </td>
                <td style="color: {{ $sr->is_locked ? 'red' : 'green' }}">{{ $sr->is_locked ? 'Locked' : 'Active' }}</td>
                <td>
                    @if ($sr->is_locked)
                        <form action="{{ route('manage.service.unlock', Crypt::encryptString($sr->id)) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit">Unlock</button>
                        </form>
                    @else
                        <form action="{{ route('manage.service.lock', Crypt::encryptString($sr->id)) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit">Lock</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection