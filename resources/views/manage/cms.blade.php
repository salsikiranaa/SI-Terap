@extends('layouts.admin_layout')
@section('content')
<style>
    .card {
        box-shadow: 0 4px 8px #aaa;
        border-radius: 5px;
        padding: 5px 10px;
    }
    label {
        text-transform: capitalize;
    }
    .input-item {
        width: 250px;
        display: flex;
        flex-direction: column;
        margin-bottom: 10px;
    }
    .submit {
        background-color: green;
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
    .delete {
        background-color: rgb(166, 0, 0);
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        border: none;
        font-size: 14px;
        margin: 5px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid black;
    }
</style>
<div style="padding: 10px 20px;">
    <h2>CMS</h2>
    <div class="card">
        <h4>App Setting</h4>
        <div>
            <form action="{{ route('manage.cms.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="input-item">
                    <label for="institute">institute</label>
                    <input type="text" id="institute" name="institute" value="{{ $cms->institute }}" required>
                </div>
                <div class="input-item">
                    <label for="app_name">app name</label>
                    <input type="text" id="app_name" name="app_name" value="{{ $cms->app_name }}" required>
                </div>
                <div class="input-item">
                    <label for="description">app description</label>
                    <textarea name="description" id="description" cols="30" rows="10" required>{{ $cms->description }}</textarea>
                </div>
                <div class="input-item">
                    <label for="contact_1">contact 1</label>
                    <input type="text" id="contact_1" name="contact_1" value="{{ $cms->contact_1 }}" required>
                </div>
                <div class="input-item">
                    <label for="contact_2">contact 2 (whatsapp)</label>
                    <input type="text" id="contact_2" name="contact_2" value="{{ $cms->contact_2 }}" required>
                </div>
                <div class="input-item">
                    <label for="email">email</label>
                    <input type="email" id="email" name="email" value="{{ $cms->email }}" required>
                </div>
                <div class="input-item">
                    <label for="address">address</label>
                    <textarea name="address" id="address" cols="30" rows="10" required>{{ $cms->address }}</textarea>
                </div>
                <div class="input-item">
                    <label for="website">website</label>
                    <input type="text" id="website" name="website" value="{{ $cms->website }}" required>
                </div>
                <div class="input-item">
                    <label for="logo_light">logo light</label><br>
                    <img src="/storage/cms/logo_light.png" alt="logo light" style="background-color: #aaa;"><br>
                    <input type="file" id="logo_light" name="logo_light">
                </div>
                <div class="input-item">
                    <label for="logo_green">logo colored</label><br>
                    <img src="/storage/cms/logo_green.png" alt="logo colored"><br>
                    <input type="file" id="logo_green" name="logo_green">
                </div>

                <button type="submit" class="submit">Submit</button>
            </form>
        </div>
    </div>
    <br>
    <div class="card">
        <h4>Social Media</h4>
        <div style="display: flex;justify-content:flex-end;">
            <button onclick="showAddSocial()" class="submit">+ Add Social</button>
        </div>
        <br>
        <div id="add-social" style="display: none;">
            <form action="{{ route('manage.social.store') }}" method="POST" style="border: 1px solid black; padding: 10px;">
                @csrf
                <div class="input-item">
                    <label for="name">name</label>
                    <select name="name" id="" required>
                        <option value="" disabled selected>--options--</option>
                        <option value="facebook">Facebook</option>
                        <option value="youtube">Youtube</option>
                        <option value="instagram">Instagram</option>
                        <option value="x-twitter">X-Twitter</option>
                        <option value="tiktok">Tiktok</option>
                    </select>
                </div>
                <div class="input-item">
                    <label for="url">URL</label>
                    <input type="url" id="url" name="url" required>
                </div>
                <button type="submit" class="submit">Add</button>
            </form>
            <br>
        </div>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>URL</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($social as $key=>$sc)
                        <tr>
                            <form action="{{ route('manage.social.update', Crypt::encryptString($sc->id)) }}" method="POST" id="social-update-{{ $key }}">
                                @csrf
                                @method('PUT')
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <input type="text" name="name" value="{{ $sc->name }}" style="width:450px; border:none;padding: 10px;">
                                </td>
                                <td>
                                    <input type="text" name="url" value="{{ $sc->url }}" style="width:450px; border:none;padding: 10px;">
                                </td>
                            </form>
                            <td>
                                <button type="button" onclick="socialUpdate('social-update-{{ $key }}')" class="update">Update</button>
                                <form action="{{ route('manage.social.destroy', Crypt::encryptString($sc->id)) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    const socialUpdate = (formId) => {
        document.getElementById(formId).submit()
    }
    const showAddSocial = () => {
        const button = document.getElementById('add-social').style
        if(button.display == 'none') button.display = 'block'
        else if(button.display == 'block') button.display = 'none'
    }
</script>
@endsection