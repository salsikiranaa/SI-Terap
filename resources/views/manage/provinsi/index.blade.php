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

<h1>Manage Provinsi</h1>
<div>
    <form action="{{ route('manage.provinsi.view') }}">
        <input type="search" name="search" placeholder="Search here" value="{{ request()->search }}">
        <button type="submit">Search</button>
    </form>
</div>
<div style="display: flex;flex-direction: column;align-items:flex-end; gap: 10px ;padding: 0 0 10px 0;">
    <button onclick="toggleCreate()">+ Create</button>
    <form action="{{ route('manage.provinsi.store') }}" method="POST" id="create" style="display: none;flex-direction: column;align-items:flex-start; gap: 10px ;">
        @csrf
        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="Type here" required>
        <label for="longitude">Longitude</label>
        <input type="number" step="0.000001" id="longitude" name="longitude" placeholder="Type here" required>
        <label for="latitude">Latitude</label>
        <input type="number" step="0.000001" id="latitude" name="latitude" placeholder="Type here" required>
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
            <th>Longitude</th>
            <th>Latitude</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($provinsi as $key=>$pr)
            <tr>
                <td class="number">{{ $loop->iteration + ( $provinsi->currentPage() - 1 ) * $provinsi->perPage() }}</td>
                <form action="{{ route('manage.provinsi.update', Crypt::encryptString($pr->id)) }}" method="POST" class="edit">
                    @csrf
                    @method('PUT')
                    <td>
                        <div class="name-data" style="display: block;">
                            {{ $pr->name }}
                        </div>
                        <input type="text" name="name" class="name-input" placeholder="Type here" value="{{ $pr->name }}" style="display: none" required>
                    </td>
                    <td>
                        <div class="longitude-data" style="display: block;">
                            {{ $pr->longitude }}
                        </div>
                        <input type="number" step="0.000001" name="longitude" class="longitude-input" placeholder="Type here" value="{{ $pr->longitude }}" style="display: none" required>
                    </td>
                    <td>
                        <div class="latitude-data" style="display: block;">
                            {{ $pr->latitude }}
                        </div>
                        <input type="number" step="0.000001" name="latitude" class="latitude-input" placeholder="Type here" value="{{ $pr->latitude }}" style="display: none" required>
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
                    <form action="{{ route('manage.provinsi.destroy', Crypt::encryptString($pr->id)) }}" method="POST" class="delete" style="display: none; border: 1px solid black;padding:5px 10px;">
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
    <a href="{{ route('manage.provinsi.view', [...request()->all(), 'page' => 1]) }}" class="paginate-button {{ $provinsi->currentPage() == 1 ? 'disabled-paginate' : '' }}">First</a>
    <a href="{{ route('manage.provinsi.view', [...request()->all(), 'page' => $provinsi->currentPage() - 1]) }}" class="paginate-button {{ $provinsi->currentPage() == 1 ? 'disabled-paginate' : '' }}"><<</a>
    @for ($i = 1; $i <= $provinsi->lastPage(); $i++)
        <a href="{{ route('manage.provinsi.view', [...request()->all(), 'page' => $i]) }}" class="paginate-item {{ $provinsi->currentPage() == $i ? 'active-paginate' : '' }}">{{ $i }}</a>
    @endfor
    <a href="{{ route('manage.provinsi.view', [...request()->all(), 'page' => $provinsi->currentPage() + 1]) }}" class="paginate-button {{ $provinsi->currentPage() == $provinsi->lastPage() ? 'disabled-paginate' : '' }}">>></a>
    <a href="{{ route('manage.provinsi.view', [...request()->all(), 'page' => $provinsi->lastPage()]) }}" class="paginate-button {{ $provinsi->currentPage() == $provinsi->lastPage() ? 'disabled-paginate' : '' }}">Last</a>
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
        const longitudeData = document.getElementsByClassName('longitude-data')[index]
        const latitudeData = document.getElementsByClassName('latitude-data')[index]
        const nameInput = document.getElementsByClassName('name-input')[index]
        const longitudeInput = document.getElementsByClassName('longitude-input')[index]
        const latitudeInput = document.getElementsByClassName('latitude-input')[index]
        if (actions.style.display == 'block') actions.style.display = 'none'
        else if (actions.style.display == 'none') actions.style.display = 'block'
        if (editAction.style.display == 'block') editAction.style.display = 'none'
        else if (editAction.style.display == 'none') editAction.style.display = 'block'
        if (nameData.style.display == 'block') nameData.style.display = 'none'
        else if (nameData.style.display == 'none') nameData.style.display = 'block'
        if (longitudeData.style.display == 'block') longitudeData.style.display = 'none'
        else if (longitudeData.style.display == 'none') longitudeData.style.display = 'block'
        if (latitudeData.style.display == 'block') latitudeData.style.display = 'none'
        else if (latitudeData.style.display == 'none') latitudeData.style.display = 'block'
        if (nameInput.style.display == 'block') nameInput.style.display = 'none'
        else if (nameInput.style.display == 'none') nameInput.style.display = 'block'
        if (longitudeInput.style.display == 'block') longitudeInput.style.display = 'none'
        else if (longitudeInput.style.display == 'none') longitudeInput.style.display = 'block'
        if (latitudeInput.style.display == 'block') latitudeInput.style.display = 'none'
        else if (latitudeInput.style.display == 'none') latitudeInput.style.display = 'block'
    }

    const update = (index) => {
        const form = document.getElementsByClassName('edit')[index]
        form.submit()
    }
</script>
@endsection