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

<h1>Manage BSIP</h1>
<div>
    <form action="{{ route('manage.bsip.view') }}">
        <input type="search" name="search" placeholder="Search here" value="{{ request()->search }}">
        <button type="submit">Search</button>
    </form>
</div>
<div style="display: flex;flex-direction: column;align-items:flex-end; gap: 10px ;padding: 0 0 10px 0;">
    <button onclick="toggleCreate()">+ Create</button>
    <form action="{{ route('manage.bsip.store') }}" method="POST" id="create" style="display: none;flex-direction: column;align-items:flex-start; gap: 10px ;">
        @csrf
        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="Type here" required>
        <label for="provinsi">Provinsi</label>
        <select name="provinsi_id" id="provinsi" required>
            <option value="" selected disabled>-- Select One --</option>
            @foreach ($provinsi as $pr)
                <option value="{{ $pr->id }}">{{ $pr->name }}</option>
            @endforeach
        </select>
        <label for="alamat">Alamat</label>
        <textarea name="alamat" id="alamat" cols="30" rows="10" placeholder="Type here" required></textarea>
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
            <th>Provinsi</th>
            <th>Alamat</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($bsip as $key=>$dt)
            <tr>
                <td class="number">{{ $loop->iteration + ( $bsip->currentPage() - 1 ) * $bsip->perPage() }}</td>
                <form action="{{ route('manage.bsip.update', Crypt::encryptString($dt->id)) }}" method="POST" class="edit">
                    @csrf
                    @method('PUT')
                    <td>
                        <div class="name-data" style="display: block;">
                            {{ $dt->name }}
                        </div>
                        <input type="text" name="name" class="name-input" style="display: none" placeholder="Type here" value="{{ $dt->name }}" required>
                    </td>
                    <td>
                        <div class="provinsi-data" style="display: block;">
                            {{ $dt->provinsi->name }}
                        </div>
                        <select name="provinsi_id" class="provinsi-input" style="display: none" required>
                            <option value="" disabled>-- Select One --</option>
                            @foreach ($provinsi as $pr)
                                <option value="{{ $pr->id }}" {{ $pr->id == $dt->provinsi->id ? 'selected' : '' }}>{{ $pr->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <div class="alamat-data" style="display: block;">
                            {{ $dt->alamat }}
                        </div>
                        <textarea name="alamat" class="alamat-input" cols="30" rows="10" placeholder="Type here" style="display: none" required>{{ $dt->alamat }}</textarea>
                    </td>
                </form>
                <td>
                    <div class="actions" style="display: block;">
                        <button onclick="toggleEdit({{ $key }})">Edit</button>
                        <button onclick="toggleDelete({{ $key }})">Delete</button>
                    </div>
                    <div class="edit-action" style="display: none;">
                        <button onclick="update({{ $key }})">Submit</button>
                        <button onclick="toggleEdit({{ $key }})">Cancel</button>
                    </div>
                    <form action="{{ route('manage.bsip.destroy', Crypt::encryptString($dt->id)) }}" method="POST" class="delete" style="display: none; border: 1px solid black;padding:5px 10px;">
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
    <a href="{{ route('manage.bsip.view', [...request()->all(), 'page' => 1]) }}" class="paginate-button {{ $bsip->currentPage() == 1 ? 'disabled-paginate' : '' }}">First</a>
    <a href="{{ route('manage.bsip.view', [...request()->all(), 'page' => $bsip->currentPage() - 1]) }}" class="paginate-button {{ $bsip->currentPage() == 1 ? 'disabled-paginate' : '' }}"><<</a>
    @for ($i = 1; $i <= $bsip->lastPage(); $i++)
        @if ($i > $bsip->currentPage() - 5 && $i < $bsip->currentPage() + 5)
            <a href="{{ route('manage.bsip.view', [...request()->all(), 'page' => $i]) }}" class="paginate-item {{ $bsip->currentPage() == $i ? 'active-paginate' : '' }}">{{ $i }}</a>
        @endif
    @endfor
    <a href="{{ route('manage.bsip.view', [...request()->all(), 'page' => $bsip->currentPage() + 1]) }}" class="paginate-button {{ $bsip->currentPage() == $bsip->lastPage() ? 'disabled-paginate' : '' }}">>></a>
    <a href="{{ route('manage.bsip.view', [...request()->all(), 'page' => $bsip->lastPage()]) }}" class="paginate-button {{ $bsip->currentPage() == $bsip->lastPage() ? 'disabled-paginate' : '' }}">Last</a>
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
        const provinsiData = document.getElementsByClassName('provinsi-data')[index]
        const alamatData = document.getElementsByClassName('alamat-data')[index]
        const nameInput = document.getElementsByClassName('name-input')[index]
        const provinsiInput = document.getElementsByClassName('provinsi-input')[index]
        const alamatInput = document.getElementsByClassName('alamat-input')[index]
        if (actions.style.display == 'block') actions.style.display = 'none'
        else if (actions.style.display == 'none') actions.style.display = 'block'
        if (editAction.style.display == 'block') editAction.style.display = 'none'
        else if (editAction.style.display == 'none') editAction.style.display = 'block'
        if (nameData.style.display == 'block') nameData.style.display = 'none'
        else if (nameData.style.display == 'none') nameData.style.display = 'block'
        if (provinsiData.style.display == 'block') provinsiData.style.display = 'none'
        else if (provinsiData.style.display == 'none') provinsiData.style.display = 'block'
        if (alamatData.style.display == 'block') alamatData.style.display = 'none'
        else if (alamatData.style.display == 'none') alamatData.style.display = 'block'
        if (nameInput.style.display == 'block') nameInput.style.display = 'none'
        else if (nameInput.style.display == 'none') nameInput.style.display = 'block'
        if (provinsiInput.style.display == 'block') provinsiInput.style.display = 'none'
        else if (provinsiInput.style.display == 'none') provinsiInput.style.display = 'block'
        if (alamatInput.style.display == 'block') alamatInput.style.display = 'none'
        else if (alamatInput.style.display == 'none') alamatInput.style.display = 'block'
    }

    const update = (index) => {
        const form = document.getElementsByClassName('edit')[index]
        form.submit()
    }
</script>
@endsection