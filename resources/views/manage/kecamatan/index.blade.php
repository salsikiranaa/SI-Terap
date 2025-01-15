@extends('layouts.admin_layout')
@section('content')
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        overflow: hidden;
        border-radius: 7px;
    }

    th, td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: center;
    }

    th {
        background-color: #00452C;
        color: white;
    }
    
    .number {
        width: 20px;
        text-align: center;
    }
    
    .paginate-item {
        border: 1px solid gray;
        border-radius: 3px;
        padding: 0 5px;
        text-decoration: none;
        color: black;
    }

    .paginate-item:hover {
        border: 1px solid gray;
        background-color: lightgray;
        border-radius: 3px;
        padding: 0 5px;
        text-decoration: none;
        color: black;
    }
    
    .paginate-button {
        /* border: 1px solid black; */
        background-color: #3d943d;
        color: white;
        padding: 0 5px;
        text-decoration: none;
        border: 0px solid gray;
        border-radius: 3px;
    }

    .paginate-button:hover {
        /* border: 1px solid black; */
        background-color: #51ac51;
        color: white;
        padding: 0 5px;
        text-decoration: none;
        border: 0px solid gray;
        border-radius: 3px;
    }
    
    .disabled-paginate {
        pointer-events: none;
        background-color: #cacaca;
        color: white;
        border: none;
    }
    
    .active-paginate {
        pointer-events: none;
        background-color: #00452C;
        color: white;
        border: none;
    }

    .submit {
        background-color: #00452C;
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
        border: none;
        font-size: 16px;
    }

    .submit:hover {
        background-color: #005737;
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
        border: none;
        font-size: 16px;
    }
    
    .update {
        background-color: rgb(255, 191, 0);
        color: black;
        padding: 5px 10px;
        border-radius: 5px;
        border: none;
        font-size: 14px;
        margin: 5px;
    }

    .update:hover {
        background-color: rgb(255, 206, 57);
        color: black;
        padding: 5px 10px;
        border-radius: 5px;
        border: none;
        font-size: 14px;
        margin: 5px;
    }
    
    .delete {
        background-color: rgb(166, 0, 0);
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        border: none;
        font-size: 14px;
        margin: 5px;
    }

    .delete:hover {
        background-color: rgb(186, 0, 0);
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        border: none;
        font-size: 14px;
        margin: 5px;
    }
</style>

<h1>Manage Kecamatan</h1>

<div>
    <form action="{{ route('manage.kecamatan.view') }}">
        <input type="search" name="search" style="height: 40px; width: 250px; border-radius:5px; border: solid 1px; border-color: gray" placeholder="Search here" value="{{ request()->search }}">
        <button class="submit" type="submit">Search</button>
    </form>
</div>

<div style="display: flex;flex-direction: column;align-items:flex-end; gap: 10px ;padding: 0 0 10px 0;">
    <button class="submit" onclick="toggleCreate()">+ Create</button>
    <form action="{{ route('manage.kecamatan.store') }}" method="POST" id="create" style="display: none;flex-direction: column;align-items:flex-start; gap: 10px ;">
        @csrf
        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="Type here" required>
        <label for="kabupaten">Kabupaten</label>
        <select name="kabupaten_id" id="kabupaten" required>
            <option value="" selected disabled>-- Select One --</option>
            @foreach ($kabupaten as $kb)
                <option value="{{ $kb->id }}">{{ $kb->name }}</option>
            @endforeach
        </select>
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
            <th>Kabupaten</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kecamatan as $key=>$dt)
            <tr>
                <td class="number">{{ $loop->iteration + ( $kecamatan->currentPage() - 1 ) * $kecamatan->perPage() }}</td>
                <form action="{{ route('manage.kecamatan.update', Crypt::encryptString($dt->id)) }}" method="POST" class="edit">
                    @csrf
                    @method('PUT')
                    <td>
                        <div class="name-data" style="display: block;">
                            {{ $dt->name }}
                        </div>
                        <input type="text" name="name" class="name-input" style="display: none" placeholder="Type here" value="{{ $dt->name }}" required>
                    </td>
                    <td>
                        <div class="kabupaten-data" style="display: block;">
                            {{ $dt->kabupaten->name }}
                        </div>
                        <select name="kabupaten_id" class="kabupaten-input" style="display: none" required>
                            <option value="" disabled>-- Select One --</option>
                            @foreach ($kabupaten as $kb)
                                <option value="{{ $kb->id }}" {{ $kb->id == $dt->kabupaten->id ? 'selected' : '' }}>{{ $kb->name }}</option>
                            @endforeach
                        </select>
                    </td>
                </form>
                <td>
                    <div class="actions" style="display: block;">
                        <button class="update" onclick="toggleEdit({{ $key }})">Edit</button>
                        <button class="delete" onclick="toggleDelete({{ $key }})">Delete</button>
                    </div>
                    <div class="edit-action" style="display: none;">
                        <button class="update" onclick="update({{ $key }})">Submit</button>
                        <button class="delete" onclick="toggleEdit({{ $key }})">Cancel</button>
                    </div>
                    <form action="{{ route('manage.kecamatan.destroy', Crypt::encryptString($dt->id)) }}" method="POST" class="delete" style="display: none; border: 1px solid black;padding:5px 10px;">
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
    <a href="{{ route('manage.kecamatan.view', [...request()->all(), 'page' => 1]) }}" class="paginate-button {{ $kecamatan->currentPage() == 1 ? 'disabled-paginate' : '' }}">First</a>
    <a href="{{ route('manage.kecamatan.view', [...request()->all(), 'page' => $kecamatan->currentPage() - 1]) }}" class="paginate-button {{ $kecamatan->currentPage() == 1 ? 'disabled-paginate' : '' }}"><<</a>
    @for ($i = 1; $i <= $kecamatan->lastPage(); $i++)
        @if ($i > $kecamatan->currentPage() - 5 && $i < $kecamatan->currentPage() + 5)
            <a href="{{ route('manage.kecamatan.view', [...request()->all(), 'page' => $i]) }}" class="paginate-item {{ $kecamatan->currentPage() == $i ? 'active-paginate' : '' }}">{{ $i }}</a>
        @endif
    @endfor
    <a href="{{ route('manage.kecamatan.view', [...request()->all(), 'page' => $kecamatan->currentPage() + 1]) }}" class="paginate-button {{ $kecamatan->currentPage() == $kecamatan->lastPage() ? 'disabled-paginate' : '' }}">>></a>
    <a href="{{ route('manage.kecamatan.view', [...request()->all(), 'page' => $kecamatan->lastPage()]) }}" class="paginate-button {{ $kecamatan->currentPage() == $kecamatan->lastPage() ? 'disabled-paginate' : '' }}">Last</a>
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
        const nameData = document.getElementsByClassName('name-data')[index]
        const kabupatenData = document.getElementsByClassName('kabupaten-data')[index]
        const nameInput = document.getElementsByClassName('name-input')[index]
        const kabupatenInput = document.getElementsByClassName('kabupaten-input')[index]
        if (actions.style.display == 'block') actions.style.display = 'none'
        else if (actions.style.display == 'none') actions.style.display = 'block'
        if (editAction.style.display == 'block') editAction.style.display = 'none'
        else if (editAction.style.display == 'none') editAction.style.display = 'block'
        if (nameData.style.display == 'block') nameData.style.display = 'none'
        else if (nameData.style.display == 'none') nameData.style.display = 'block'
        if (kabupatenData.style.display == 'block') kabupatenData.style.display = 'none'
        else if (kabupatenData.style.display == 'none') kabupatenData.style.display = 'block'
        if (nameInput.style.display == 'block') nameInput.style.display = 'none'
        else if (nameInput.style.display == 'none') nameInput.style.display = 'block'
        if (kabupatenInput.style.display == 'block') kabupatenInput.style.display = 'none'
        else if (kabupatenInput.style.display == 'none') kabupatenInput.style.display = 'block'
    }

    const update = (index) => {
        const form = document.getElementsByClassName('edit')[index]
        form.submit()
    }
</script>
@endsection