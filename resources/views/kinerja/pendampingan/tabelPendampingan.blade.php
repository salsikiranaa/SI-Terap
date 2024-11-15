@extends('layouts.layoutKinerja')

@section('content')

<style>
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
        border: 1.5px solid #086404; 
        color: #086404;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .page-item.active {
        background-color: #086404;
        color: white;
        border: none;
    }

    .page-item.active:hover {
        background-color: #086404;
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
</style>

<h1 class="page-title">Data Lembaga Penerap SIP - Nanggroe Aceh Darussalam</h1>

<div class="content stylish-content">
    <!-- Filter Section -->
    <div class="filter">
        <div class="form-row">
            <div class="form-group col-md-5">
                <label for="namaLembaga">Nama Lembaga Penerap</label>
                <input type="text" name="namaLembaga" id="namaLembaga" placeholder="Masukkan Nama Lembaga Penerap" required>
            </div>
            
            <div class="form-group col-md-5">
                <label for="bentukLembaga">Bentuk Lembaga</label>
                <select name="bentukLembaga" id="bentukLembaga" required style="height: 52px">
                    <option value="" disabled selected>Pilih Salah Satu</option>
                    <option value="">--- Batalkan Filter ---</option>
                    <option value="pt">PT</option>
                    <option value="cv">CV</option>
                    <option value="koperasi">Koperasi</option>
                    <option value="kelompok">Kelompok</option>
                    <option value="ud">UD</option>
                    <option value="bumdes">BUMDes</option>
                    <option value="BUMD">BUMD</option>
                </select>
            </div>
    
            <div class="form-group col-md-5">
                <label for="tahunPendampingan">Tahun</label>
                <input type="number" name="tahunPendampingan" class="form-control" id="tahunPendampingan" placeholder="Masukkan Tahun" required>
            </div>
    
            <button type="button" onclick="filterData()">Filter</button>
        </div>
    </div>

    <!-- Kegiatan Table -->
    <table id="pendampingan-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lembaga</th>
                <th>Bentuk Lembaga</th>
                <th>Tahun</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <div class="pagination">
        <div class="page-item">&lt;</div> <!-- Left arrow -->
        <div class="page-item active">1</div> <!-- Active page -->
        <div class="page-item">2</div>
        <div class="page-item">3</div>
        <span class="dots">...</span> <!-- Dots -->
        <div class="page-item">&gt;</div> <!-- Right arrow -->
    </div>
</div>

<script>
    const kegiatanData = [
        { no: 1, namaLembaga: 'PT Perkebunan Indonesia', bentukLembaga: 'PT', tahunPendampingan: 2023 },
        { no: 2, namaLembaga: 'Koperasi Tani Makmur', bentukLembaga: 'Koperasi', tahunPendampingan: 2022 },
        { no: 3, namaLembaga: 'UD Sumber Pangan', bentukLembaga: 'UD', tahunPendampingan: 2024 },
        { no: 4, namaLembaga: 'CV Agro Pratama', bentukLembaga: 'CV', tahunPendampingan: 2023 },
        { no: 5, namaLembaga: 'Kelompok Tani Sido Maju', bentukLembaga: 'Kelompok', tahunPendampingan: 2024 },
        { no: 6, namaLembaga: 'BUMDes Tani Jaya', bentukLembaga: 'BUMDes', tahunPendampingan: 2022 },
        { no: 7, namaLembaga: 'PT Agro Sejahtera', bentukLembaga: 'PT', tahunPendampingan: 2023 },
        { no: 8, namaLembaga: 'CV Agri Nusantara', bentukLembaga: 'CV', tahunPendampingan: 2024 },
        { no: 9, namaLembaga: 'Kelompok Tani Bersatu', bentukLembaga: 'Kelompok', tahunPendampingan: 2022 },
        { no: 10, namaLembaga: 'BUMD Agro Mandiri', bentukLembaga: 'BUMD', tahunPendampingan: 2023 }
    ];

    function filterData() {
        const namaLembaga = document.getElementById('namaLembaga').value.toLowerCase();
        const tahunPendampingan = document.getElementById('tahunPendampingan').value;
        const bentukLembaga = document.getElementById('bentukLembaga').value.toLowerCase();

        console.log("Filter values - Nama Lembaga:", namaLembaga, "Tahun Pendampingan:", tahunPendampingan, "Bentuk Lembaga:", bentukLembaga);

        const filteredData = kegiatanData.filter(item => {
            return (
                (namaLembaga === '' || item.namaLembaga.toLowerCase().includes(namaLembaga)) &&
                (tahunPendampingan === '' || item.tahunPendampingan === parseInt(tahunPendampingan, 10)) &&
                (bentukLembaga === '' || item.bentukLembaga.toLowerCase() === bentukLembaga)
            );
        });

        displayData(filteredData);
        }

        function displayData(data) {
            const tableBody = document.querySelector('#pendampingan-table tbody');
            tableBody.innerHTML = ''; 

            data.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.no}</td>
                    <td>${item.namaLembaga}</td>
                    <td>${item.bentukLembaga}</td>
                    <td>${item.tahunPendampingan}</td>
                `;
                tableBody.appendChild(row);
            });
        }

        displayData(kegiatanData);
</script>

@endsection