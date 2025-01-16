@extends('layouts.admin_layout')
@section('content')
<style>
    .disabled {
        pointer-events: none;
        opacity: 0.6;
        color: white !important;
        background-color: gray;
        border: none !important;
    }

    .content.stylish-content {
        padding: 20px;
    }

    .page-title {
        text-align: center;
        font-size: 2em;
        color: #00452C;
        margin: 20px 0;
        margin-bottom: 50px;
        padding-top: 70px !important;
    }

    .stylish-button {
        display: block;
        width: fit-content;
        margin: 20px auto;
        padding: 12px 25px;
        color: white;
        background-color: #00452C;
        text-decoration: none;
        border-radius: 5px;
        text-align: center;
        font-size: 1.1em;
    }

    .stylish-button:hover {
        background-color: #006633;
    }

    .stylish-content {
        margin: 0 auto;
        max-width: 1200px;
        padding: 40px 20px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    #map {
        height: 400px;
        width: 100%;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

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

    .filter{
        background-color: #e7e7e7;
        padding: 20px 20px 0 20px;
        border-radius: 5px;
    }
    
    .filter-container {
        margin-bottom: 20px;
    }

    .filter-container select, .filter-container input {
        padding: 8px;
        font-size: 1em;
        margin-right: 10px;
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    .form-row button {
        padding: 8px 15px;
        background-color: #00452C;
        color: white;
        border: none;
        border-radius: 5px;
        height: 50px;
        margin-top: 32px;
    }

    .form-row button:hover {
        background-color: #006633;
    }

    .form-container {
        max-width: 90%;
        margin: auto;
        background-color: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        font-family: 'Poppins', sans-serif;
        color: #333;
        margin-bottom: 50px; 
    }

    .form-title {
        font-size: 2em;
        font-weight: bold;
        color: #006633;
        text-align: center;
        margin-top: 50px;
        margin-bottom: 100px;
        text-transform: uppercase;
    }

    .form-group {
        margin-bottom: 25px;
        flex: 1 1 45%; /* Mengatur setiap kolom memiliki lebar 45% */
        width: auto;
    }

    label {
        font-weight: bold;
        margin-bottom: 8px;
        display: block;
        color: #333;
    }

    select, input[type="text"], input[type="number"], input[type="date"] {
        width: 100%;
        padding: 12px;
        border: 2px solid #ccc;
        border-radius: 6px;
        font-size: 1em;
        transition: border-color 0.3s ease;
    }

    select:focus, input[type="text"]:focus, input[type="number"]:focus, input[type="date"]:focus {
        border-color: #00452C;
        outline: none;
    }

    select::placeholder, input[type="date"], input[type="number"], input[type="text"], input[type="option"]{
        color: #888;
    }

    .checkbox-group {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .radio-group {
        display: flex;
        gap: 20px;
    }

    .submit-button {
        background-color: #006633;
        color: #fff;
        padding: 12px 20px;
        border: none;
        border-radius: 6px;
        font-size: 1.1em;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 100%;
        text-align: center;
    }

    .submit-button:hover {
        background-color: #009144;
        box-shadow: 0 4px 8px rgba(0, 100, 70, 0.3);
    }

    .form-group input[type="checkbox"] {
        margin-right: 5px;
    }

    .form-group input[type="radio"] {
        margin-right: 5px;
    }

    .form-row{
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    .table{
        border: #00452C;
        border-radius: 5px;
    }

    /* PAGINATION */

    .pagination {
        display: flex;
        align-items: center;
        gap: 10px;
        justify-content: center;
        padding: 25px;
    }

    .page-item {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 25px;
        height: 25px;
        border: 1.5px solid #00452C; 
        color: #00452C;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .page-item.active {
        background-color: #00452C;
        color: white;
        border: none;
    }

    .page-item.active:hover {
        background-color: #00452C;
        color: white;
        border: none;
    }


    .dots {
        font-size: 24px;
        color: #00a652;
    }

    .page-item:hover {
        background-color: #d6f7e1;
    }

    #resetFilter{
        /* padding: 8px 15px; */
        background-color: #e7e7e7;
        color: #00452C;
        border-color: #00452C;
        border-style: solid;
        border-radius: 5px;
        border-width: 1.5px;
        height: 50px;
        margin-top: 32px;
    }

    #resetFilter:hover{
        background-color: #006633;
        color: white;
        border-color: #006633;
        border-style: solid;
        border-radius: 5px;
        height: 50px;
        margin-top: 32px;
    }

    .link-benih {
        text-decoration: none;
        color: #00452C;
        font-weight: bold;
        transition: color 0.3s;
    }

    .link-benih:hover {
        color: #007B5E;
        text-decoration: underline;
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