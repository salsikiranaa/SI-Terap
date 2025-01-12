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

<div>

    <h2>Manage BSIP Profile</h2>

    <div>
        <form action="{{ route('manage.profile_bsip.index') }}">
            <input type="search" name="search" placeholder="Search here" value="{{ request()->search }}">
            <button type="submit">Search</button>
        </form>
    </div>

    <div style="display: flex;flex-direction: column;align-items:flex-end; gap: 10px ;padding: 0 0 10px 0;">
        <button onclick="toggleCreate()">+ Create</button>
        <form action="{{ route('manage.profile_bsip.store') }}" method="POST" enctype="multipart/form-data" id="create" style="display: none;flex-direction: column;align-items:flex-start; gap: 10px ;">
            @csrf
            <label for="bsip">BSIP</label>
            <select name="m_bsip_id" id="bsip" required>
                <option value="" selected disabled>-- Select One --</option>
                @foreach ($m_bsip as $bs)
                    <option value="{{ $bs->id }}">{{ $bs->name }}</option>
                @endforeach
            </select>
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="10" required></textarea>
            <label for="image">Image</label>
            <input type="file" name="image" id="image" accept=".jpg,.jpeg,.png" required>
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
                <th>BSIP</th>
                <th>Description</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($profiles as $key=>$prof)
                <tr>
                    <td class="number">{{ $loop->iteration + ( $profiles->currentPage() - 1 ) * $profiles->perPage() }}</td>
                    <form action="{{ route('manage.profile_bsip.update', Crypt::encryptString($prof->id)) }}" method="POST" enctype="multipart/form-data" class="edit">
                        @csrf
                        @method('PUT')
                        <td>
                            <div class="bsip-data" style="display: block;">
                                {{ $prof->m_bsip->name }}
                            </div>
                        </td>
                        <td>
                            <div class="description-data" style="display: block;">
                                {{ $prof->description }}
                            </div>
                            <textarea name="description" id="" cols="30" rows="10" class="description-input" style="display: none" required>{{ $prof->description }}</textarea>
                        </td>
                        <td>
                            <div class="image-data" style="display: block;">
                                <a href="{{ $prof->image_url }}" target="_blank">Look Image >></a>
                            </div>
                            <input type="file" name="image" accept=".jpg,.jpeg,.png" class="image-input" style="display: none">
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
                        <form action="{{ route('manage.profile_bsip.destroy', Crypt::encryptString($prof->id)) }}" method="POST" class="delete" style="display: none; border: 1px solid black;padding:5px 10px;">
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

</div>

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
        const descriptionData = document.getElementsByClassName('description-data')[index]
        const descriptionInput = document.getElementsByClassName('description-input')[index]
        const imageData = document.getElementsByClassName('image-data')[index]
        const imageInput = document.getElementsByClassName('image-input')[index]
        if (actions.style.display == 'block') actions.style.display = 'none'
        else if (actions.style.display == 'none') actions.style.display = 'block'
        if (editAction.style.display == 'block') editAction.style.display = 'none'
        else if (editAction.style.display == 'none') editAction.style.display = 'block'
        if (descriptionData.style.display == 'block') descriptionData.style.display = 'none'
        else if (descriptionData.style.display == 'none') descriptionData.style.display = 'block'
        if (descriptionInput.style.display == 'block') descriptionInput.style.display = 'none'
        else if (descriptionInput.style.display == 'none') descriptionInput.style.display = 'block'
        if (imageData.style.display == 'block') imageData.style.display = 'none'
        else if (imageData.style.display == 'none') imageData.style.display = 'block'
        if (imageInput.style.display == 'block') imageInput.style.display = 'none'
        else if (imageInput.style.display == 'none') imageInput.style.display = 'block'
    }

    const update = (index) => {
        const form = document.getElementsByClassName('edit')[index]
        form.submit()
    }
</script>
@endsection