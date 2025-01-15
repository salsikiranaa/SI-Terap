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

<h1>Manage {{ $name }}</h1>
<div>
    <form action="{{ route('manage.data.common', ['name' => $name, 'table' => request()->table]) }}">
        <input type="search" name="search" placeholder="Search here" value="{{ request()->search }}">
        <button type="submit">Search</button>
    </form>
</div>
<div style="display: flex;flex-direction: column;align-items:flex-end; gap: 10px ;padding: 0 0 10px 0;">
    <button onclick="toggleCreate()">+ Create</button>
    <form action="{{ route('manage.data.common.store', request()->table) }}" method="POST" id="create" style="display: none;flex-direction: column;align-items:flex-start; gap: 10px ;">
        @csrf
        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="Type here" required>
        <div style="display: flex;align-items:center;justify-content:flex-end;gap:5px;">
            <button type="submit">Submit</button>
            <button type="button" onclick="toggleCreate()">Cancel</button>
        </div>
    </form>
</div>
<table>
    <thead>
        <tr>
            <th class="number">#</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key=>$dt)
            <tr>
                <td class="number">{{ $loop->iteration + ( $data->currentPage() - 1 ) * $data->perPage() }}</td>
                <td>
                    <div class="data" style="display: block;">
                        {{ $dt->name }}
                    </div>
                    <form action="{{ route('manage.data.common.update', [
                        'table' => request()->table,
                        'id' => Crypt::encryptString($dt->id),
                    ]) }}" method="POST" class="edit" style="display: none;">
                        @csrf
                        @method('PUT')
                        <input type="text" name="name" placeholder="Type here" value="{{ $dt->name }}" required>
                    </form>
                </td>
                <td>
                    <div class="actions" style="display: block;">
                        <button onclick="toggleEdit({{ $key }})">Edit</button>
                        <button onclick="toggleDelete({{ $key }})">Delete</button>
                    </div>
                    <div class="edit-action" style="display: none;">
                        <button onclick="update({{ $key }})">Submit</button>
                        <button onclick="toggleEdit({{ $key }})">Cancel</button>
                    </div>
                    <form action="{{ route('manage.data.common.destroy', [
                        'table' => request()->table,
                        'id' => Crypt::encryptString($dt->id),
                    ]) }}" method="POST" class="delete" style="display: none; border: 1px solid black;padding:5px 10px;">
                        @csrf
                        @method('DELETE')
                        <div>Are you sure <span style="color: red;">delete</span> this entry?</div>
                        <div style="display: flex;align-items:center;justify-content:flex-end;gap:5px;">
                            <button type="submit">Yes</button>
                            <button type="button" onclick="toggleDelete({{ $key }})">Cancel</button>
                        </div>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{-- {{ dd(request()->table) }} --}}
{{-- pagination --}}
<div style="margin: 10px;display:flex;align-items:center;justify-content:center;gap: 5px;">
    <a href="{{ route('manage.data.common', ['name' => $name, 'table' => request()->table, 'page' => 1]) }}" class="paginate-button {{ $data->currentPage() == 1 ? 'disabled-paginate' : '' }}">First</a>
    <a href="{{ route('manage.data.common', ['name' => $name, 'table' => request()->table, 'page' => $data->currentPage() - 1]) }}" class="paginate-button {{ $data->currentPage() == 1 ? 'disabled-paginate' : '' }}"><<</a>
    @for ($i = 1; $i <= $data->lastPage(); $i++)
        <a href="{{ route('manage.data.common', ['name' => $name, 'table' => request()->table, 'page' => $i]) }}" class="paginate-item {{ $data->currentPage() == $i ? 'active-paginate' : '' }}">{{ $i }}</a>
    @endfor
    <a href="{{ route('manage.data.common', ['name' => $name, 'table' => request()->table, 'page' => $data->currentPage() + 1]) }}" class="paginate-button {{ $data->currentPage() == $data->lastPage() ? 'disabled-paginate' : '' }}">>></a>
    <a href="{{ route('manage.data.common', ['name' => $name, 'table' => request()->table, 'page' => $data->lastPage()]) }}" class="paginate-button {{ $data->currentPage() == $data->lastPage() ? 'disabled-paginate' : '' }}">Last</a>
</div>
{{--  end pagination --}}

<script>
    const toggleCreate = () => {
        const form = document.getElementById('create')
        if (form.style.display == 'flex') form.style.display = 'none'
        else if (form.style.display == 'none') form.style.display = 'flex'
    }

    const toggleDelete = (index) => {
        const actions = document.getElementsByClassName('actions')[index]
        const form = document.getElementsByClassName('delete')[index]
        if (actions.style.display == 'block') actions.style.display = 'none'
        else if (actions.style.display == 'none') actions.style.display = 'block'
        if (form.style.display == 'block') form.style.display = 'none'
        else if (form.style.display == 'none') form.style.display = 'block'
    }
    
    const toggleEdit = (index) => {
        const actions = document.getElementsByClassName('actions')[index]
        const editAction = document.getElementsByClassName('edit-action')[index]
        const form = document.getElementsByClassName('edit')[index]
        const data = document.getElementsByClassName('data')[index]
        if (actions.style.display == 'block') actions.style.display = 'none'
        else if (actions.style.display == 'none') actions.style.display = 'block'
        if (editAction.style.display == 'block') editAction.style.display = 'none'
        else if (editAction.style.display == 'none') editAction.style.display = 'block'
        if (form.style.display == 'block') form.style.display = 'none'
        else if (form.style.display == 'none') form.style.display = 'block'
        if (data.style.display == 'block') data.style.display = 'none'
        else if (data.style.display == 'none') data.style.display = 'block'
    }

    const update = (index) => {
        const form = document.getElementsByClassName('edit')[index]
        form.submit()
    }
</script>
@endsection