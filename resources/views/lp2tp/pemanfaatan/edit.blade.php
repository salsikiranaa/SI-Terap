@extends('layouts.layoutIp2tp')

@section('content')
<style>
    .form-container {
        max-width: 800px;
        margin: auto;
        background-color: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        font-family: 'Poppins', sans-serif;
        color: #333;
    }

    .form-title {
        font-size: 2em;
        font-weight: bold;
        color: #28B96C;
        text-align: center;
        margin-bottom: 25px;
        text-transform: uppercase;
    }

    .form-group {
        margin-bottom: 20px;
        position: relative;
    }

    /* Row layout for side-by-side fields */
    .form-row {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-row .form-group {
        flex: 1;
        margin-bottom: 0;
    }

    label {
        font-weight: bold;
        margin-bottom: 8px;
        display: block;
        color: #333;
    }

    select, input[type="text"], input[type="number"], input[type="file"] {
        width: 100%;
        padding: 12px;
        border: 2px solid #ccc;
        border-radius: 6px;
        font-size: 1em;
        transition: border-color 0.3s ease;
        box-sizing: border-box;
    }

    select:focus, input[type="text"]:focus, input[type="number"]:focus, input[type="file"]:focus {
        border-color: #28B96C;
        outline: none;
        box-shadow: 0 0 0 3px rgba(40, 185, 108, 0.1);
    }

    /* Error States - Hanya border yang berubah merah */
    .form-group.has-error select,
    .form-group.has-error input[type="text"],
    .form-group.has-error input[type="number"],
    .form-group.has-error input[type="file"] {
        border-color: #dc3545 !important;
    }

    .form-group.has-error select:focus,
    .form-group.has-error input[type="text"]:focus,
    .form-group.has-error input[type="number"]:focus,
    .form-group.has-error input[type="file"]:focus {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1) !important;
    }

    /* Hide error messages */
    .error-message {
        display: none;
    }

    /* Helper text styling */
    .helper-text {
        color: #6c757d;
        font-size: 0.875em;
        margin-top: 5px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .helper-text i {
        font-size: 0.8em;
        opacity: 0.7;
    }

    .dynamic-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 15px;
    }

    .dynamic-table th {
        background-color: #28B96C;
        color: white;
        font-weight: bold;
        text-align: left;
        padding: 12px;
    }

    .dynamic-table td {
        padding: 10px;
        border: 1px solid #ddd;
        position: relative;
    }

    .dynamic-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .dynamic-table input {
        border: 1px solid #ddd;
        padding: 8px;
        border-radius: 4px;
        width: 100%;
        box-sizing: border-box;
        transition: border-color 0.3s ease;
    }

    .dynamic-table input:focus {
        border-color: #28B96C;
        outline: none;
    }

    /* Error states for table inputs - Hanya border yang berubah merah */
    .dynamic-table input.error {
        border-color: #dc3545 !important;
    }

    .dynamic-table input.error:focus {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 2px rgba(220, 53, 69, 0.1) !important;
    }

    /* Hide table error messages */
    .table-error-message {
        display: none;
    }

    .dynamic-input-container {
        border: 1px solid #ddd;
        padding: 20px;
        margin-bottom: 15px;
        border-radius: 8px;
        background-color: #fafafa;
    }

    .table-container {
        margin-bottom: 15px;
        overflow-x: auto;
    }

    .section-title {
        color: #28B96C;
        border-bottom: 2px solid #28B96C;
        padding-bottom: 8px;
        margin-top: 30px;
        margin-bottom: 20px;
        font-size: 1.3em;
        font-weight: 600;
    }

    .table-header {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 15px;
        padding: 0;
    }

    .add-button {
        background-color: #28B96C;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        font-size: 0.95em;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
    }

    .add-button:hover {
        background-color: #22a862;
        box-shadow: 0 4px 8px rgba(40, 185, 108, 0.3);
        transform: translateY(-1px);
    }

    .delete-row {
        background-color: #dc3545;
        color: white;
        border: none;
        border-radius: 4px;
        padding: 6px 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.875em;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        white-space: nowrap;
    }

    .delete-row:hover:not(:disabled) {
        background-color: #c82333;
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .delete-row:disabled {
        background-color: #6c757d;
        cursor: not-allowed;
        opacity: 0.6;
        transform: none;
    }

    .submit-button {
        background-color: #28B96C;
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
        background-color: #22a862;
        box-shadow: 0 4px 8px rgba(40, 185, 108, 0.3);
    }

    .submit-button:disabled {
        background-color: #6c757d;
        cursor: not-allowed;
        opacity: 0.6;
    }

    .back-button {
        background-color: #6c757d;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        font-size: 1em;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        margin-bottom: 20px;
    }

    .back-button:hover {
        background-color: #5a6268;
        text-decoration: none;
        color: #fff;
    }

    /* File Upload Styling */
    .file-upload-container {
        position: relative;
        margin-bottom: 20px;
    }

    .file-upload-area {
        border: 2px dashed #ccc;
        border-radius: 8px;
        padding: 40px 20px;
        text-align: center;
        background-color: #f8f9fa;
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .file-upload-area:hover {
        border-color: #28B96C;
        background-color: #f0f9f4;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(40, 185, 108, 0.15);
    }

    .file-upload-area.dragover {
        border-color: #28B96C;
        background-color: #e8f5e8;
    }

    .file-upload-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }

    .file-upload-icon {
        font-size: 2.5em;
        color: #6c757d;
        transition: color 0.3s ease;
    }

    .file-upload-area:hover .file-upload-icon {
        color: #28B96C;
    }

    .file-upload-text {
        font-size: 1.1em;
        font-weight: 600;
        color: #495057;
        margin-bottom: 5px;
    }

    .file-upload-subtext {
        font-size: 0.9em;
        color: #6c757d;
    }

    .file-input-hidden {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
        top: 0;
        left: 0;
    }

    .photo-preview {
        margin-top: 20px;
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 15px;
    }

    .preview-item {
        position: relative;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease;
    }

    .preview-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .preview-item img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        display: block;
    }

    .remove-preview {
        position: absolute;
        top: 8px;
        right: 8px;
        background: rgba(220, 53, 69, 0.9);
        color: white;
        border: none;
        border-radius: 50%;
        width: 28px;
        height: 28px;
        font-size: 16px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        backdrop-filter: blur(2px);
    }

    .remove-preview:hover {
        background: rgba(220, 53, 69, 1);
        transform: scale(1.1);
    }

    .existing-images {
        margin-bottom: 20px;
    }

    .existing-images-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 15px;
        margin-top: 15px;
    }

    .existing-image-item {
        position: relative;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease;
    }

    .existing-image-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .existing-image-item img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        display: block;
    }

    .remove-existing-image {
        position: absolute;
        top: 8px;
        right: 8px;
        background: rgba(220, 53, 69, 0.9);
        color: white;
        border: none;
        border-radius: 50%;
        width: 28px;
        height: 28px;
        font-size: 16px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        backdrop-filter: blur(2px);
    }

    .remove-existing-image:hover {
        background: rgba(220, 53, 69, 1);
        transform: scale(1.1);
    }

    .image-section {
        border: 1px solid #e0e0e0;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        background-color: #fafafa;
    }

    .image-section h4 {
        margin-top: 0;
        color: #28B96C;
        font-size: 1.2em;
        font-weight: 600;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .upload-info {
        margin-top: 15px;
        padding: 12px;
        background-color: #e8f4fd;
        border-left: 4px solid #28B96C;
        border-radius: 4px;
        font-size: 0.9em;
        color: #495057;
    }

    .alert {
        padding: 12px 20px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 6px;
        font-size: 14px;
    }

    .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }

    .alert ul {
        margin-bottom: 0;
        padding-left: 20px;
    }

    small {
        color: #6c757d;
        font-size: 0.875em;
        display: block;
        margin-top: 5px;
    }

    /* Hide validation summary */
    .validation-summary {
        display: none !important;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .form-row {
            flex-direction: column;
            gap: 0;
        }
        
        .form-row .form-group {
            margin-bottom: 20px;
        }
        
        .table-header {
            justify-content: center;
        }
        
        .add-button {
            width: 100%;
            justify-content: center;
        }

        .delete-row {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="form-container">
    
    <h2 class="form-title">Edit Pemanfaatan Kebun Percobaan</h2>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('lp2tp.pemanfaatan_kp.update', $pemanfaatan_sip->id) }}" method="POST" enctype="multipart/form-data" id="edit-form">
        @csrf
        @method('PUT')

        <div class="form-group" id="ip2sip-group">
            <label for="ip2sip_id">IP2SIP <span style="color: red;">*</span></label>
            <select name="ip2sip_id" id="ip2sip_id" required>
                <option value="" disabled>-- Pilih Balai Pengkajian Teknologi Pertanian --</option>
                @foreach($ip2sip as $ip)
                    <option value="{{ $ip->id }}" {{ old('ip2sip_id', $pemanfaatan_sip->ip2sip_id) == $ip->id ? 'selected' : '' }}>
                        BPSIP {{ $ip->bsip->name }} - IP2SIP {{ $ip->name }}
                    </option>
                @endforeach
            </select>
            <div class="helper-text">
                <i class="fas fa-info-circle"></i>
                Pilih Balai Pengkajian Standar Instrumen Pertanian yang sesuai
            </div>
        </div>

        <div class="form-row">
            <div class="form-group" id="luas-sip-group">
                <label for="luas_sip">Luas Standar Instrumen Pertanian <span style="color: red;">*</span></label>
                <input type="number" name="luas_sip" id="luas_sip" min="0" step="0.001" 
                       value="{{ old('luas_sip', $pemanfaatan_sip->luas_sip) }}" 
                       placeholder="10.5" required>
                <div class="helper-text">
                    <i class="fas fa-ruler-combined"></i>
                    Dalam satuan hektar (Ha)
                </div>
            </div>

            <div class="form-group" id="jumlah-sdm-group">
                <label for="jumlah_sdm">Jumlah Sumber Daya Manusia <span style="color: red;">*</span></label>
                <input type="number" name="jumlah_sdm" id="jumlah_sdm" min="0" 
                       value="{{ old('jumlah_sdm', $pemanfaatan_sip->jumlah_sdm) }}" 
                       placeholder="15" required>
                <div class="helper-text">
                    <i class="fas fa-users"></i>
                    Total personil yang terlibat
                </div>
            </div>
        </div>

        <div class="form-group" id="agro-ekosistem-group">
            <label for="agro_ekosistem">Jenis Agroekosistem <span style="color: red;">*</span></label>
            <input type="text" name="agro_ekosistem" id="agro_ekosistem" 
                   value="{{ old('agro_ekosistem', $pemanfaatan_sip->agro_ekosistem) }}" 
                   placeholder="Lahan Sawah Irigasi" required>
            <div class="helper-text">
                <i class="fas fa-seedling"></i>
                Jelaskan kondisi lingkungan pertanian yang digunakan
            </div>
        </div>

        <h3 class="section-title">Pemanfaatan Diseminasi</h3>
        
        <div class="form-group">
            <div id="input_diseminasi_container" class="dynamic-input-container">
                <div class="table-header">
                    <button type="button" class="add-button" onclick="addRowDiseminasi()">
                        <i class="fas fa-plus"></i> Tambah Diseminasi
                    </button>
                </div>
                <div class="table-container">
                    <table id="diseminasi_table" class="dynamic-table">
                        <thead>
                            <tr>
                                <th width="50%">Nama Diseminasi <span style="color: red;">*</span></th>
                                <th width="30%">Luas (Ha) <span style="color: red;">*</span></th>
                                <th width="20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($pemanfaatan_sip->pemanfaatan_diseminasi && count($pemanfaatan_sip->pemanfaatan_diseminasi) > 0)
                                @foreach($pemanfaatan_sip->pemanfaatan_diseminasi as $index => $diseminasi)
                                    <tr>
                                        <td>
                                            <input type="text" 
                                                   name="pemanfaatan_diseminasi[{{ $index }}][name]" 
                                                   placeholder="Nama Diseminasi" 
                                                   value="{{ old('pemanfaatan_diseminasi.'.$index.'.name', $diseminasi->name) }}" 
                                                   class="diseminasi-name"
                                                   required>
                                        </td>
                                        <td>
                                            <input type="number" 
                                                   name="pemanfaatan_diseminasi[{{ $index }}][luas]" 
                                                   min="0" step="0.001" 
                                                   placeholder="Luas (Ha)" 
                                                   value="{{ old('pemanfaatan_diseminasi.'.$index.'.luas', $diseminasi->luas) }}" 
                                                   class="diseminasi-luas"
                                                   required>
                                        </td>
                                        <td>
                                            <button type="button" class="delete-row" onclick="deleteRow(this, 'diseminasi')" 
                                                    {{ $index == 0 && count($pemanfaatan_sip->pemanfaatan_diseminasi) == 1 ? 'disabled' : '' }}>
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>
                                        <input type="text" name="pemanfaatan_diseminasi[0][name]" placeholder="Nama Diseminasi" class="diseminasi-name" required>
                                    </td>
                                    <td>
                                        <input type="number" name="pemanfaatan_diseminasi[0][luas]" min="0" step="0.001" placeholder="Luas (Ha)" class="diseminasi-luas" required>
                                    </td>
                                    <td>
                                        <button type="button" class="delete-row" onclick="deleteRow(this, 'diseminasi')" disabled>
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <h3 class="section-title">Dokumentasi Foto</h3>
        <div class="form-group">
            @if($pemanfaatan_sip->dokumentasi && count($pemanfaatan_sip->dokumentasi) > 0)
                <div class="image-section">
                    <h4>
                        <i class="fas fa-images"></i>
                        Foto yang Sudah Ada
                    </h4>
                    <div class="existing-images" id="existing_images">
                        <div class="existing-images-grid">
                            @foreach($pemanfaatan_sip->dokumentasi as $index => $foto)
                                <div class="existing-image-item" id="existing_image_{{ $index }}">
                                    <img src="{{ asset('storage/' . $foto) }}" alt="Dokumentasi Kebun Percobaan">
                                    <button type="button" class="remove-existing-image" onclick="removeExistingImage({{ $index }})" title="Hapus foto ini">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <input type="hidden" name="existing_images[]" value="{{ $foto }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            
            <div class="image-section">
                <h4>
                    <i class="fas fa-cloud-upload-alt"></i>
                    Tambah Foto Baru
                </h4>
                
                <div class="file-upload-container">
                    <div class="file-upload-area" onclick="document.getElementById('dokumentasi').click()">
                        <input type="file" 
                               name="dokumentasi[]" 
                               id="dokumentasi" 
                               accept="image/*" 
                               multiple 
                               onchange="previewImages(this)"
                               class="file-input-hidden">
                        <div class="file-upload-content">
                            <i class="fas fa-camera file-upload-icon"></i>
                            <div class="file-upload-text">Pilih atau seret foto ke sini</div>
                            <div class="file-upload-subtext">Klik untuk memilih file</div>
                        </div>
                    </div>
                </div>

                <div class="upload-info">
                    <i class="fas fa-info-circle"></i>
                    <strong>Informasi Upload:</strong> Format JPG, JPEG, PNG. Maksimal 2MB per foto. Maksimal 5 foto total. Foto akan membantu dokumentasi dan evaluasi kegiatan.
                </div>
                
                <div class="photo-preview" id="photo_preview"></div>
            </div>
        </div>

        <button type="submit" class="submit-button" id="submit-btn">
            <i class="fas fa-save"></i> Update Data Pemanfaatan
        </button>
    </form>
</div>

<script>
    let currentIndexDiseminasi = {{ $pemanfaatan_sip->pemanfaatan_diseminasi ? count($pemanfaatan_sip->pemanfaatan_diseminasi) - 1 : 0 }};
    let uploadedImagesCount = 0;
    let existingImagesCount = {{ $pemanfaatan_sip->dokumentasi ? count($pemanfaatan_sip->dokumentasi) : 0 }};
    let removedExistingImages = [];

    // Simplified validation function - only visual border changes
    const validateForm = () => {
        let isValid = true;

        // Validate IP2SIP
        const ip2sip = document.getElementById('ip2sip_id');
        const ip2sipGroup = document.getElementById('ip2sip-group');
        if (!ip2sip.value) {
            ip2sipGroup.classList.add('has-error');
            isValid = false;
        } else {
            ip2sipGroup.classList.remove('has-error');
        }

        // Validate Luas SIP
        const luasSip = document.getElementById('luas_sip');
        const luasSipGroup = document.getElementById('luas-sip-group');
        if (!luasSip.value || parseFloat(luasSip.value) < 0) {
            luasSipGroup.classList.add('has-error');
            isValid = false;
        } else {
            luasSipGroup.classList.remove('has-error');
        }

        // Validate Jumlah SDM
        const jumlahSdm = document.getElementById('jumlah_sdm');
        const jumlahSdmGroup = document.getElementById('jumlah-sdm-group');
        if (!jumlahSdm.value || parseInt(jumlahSdm.value) < 0) {
            jumlahSdmGroup.classList.add('has-error');
            isValid = false;
        } else {
            jumlahSdmGroup.classList.remove('has-error');
        }

        // Validate Agroekosistem
        const agroEkosistem = document.getElementById('agro_ekosistem');
        const agroEkosistemGroup = document.getElementById('agro-ekosistem-group');
        if (!agroEkosistem.value.trim()) {
            agroEkosistemGroup.classList.add('has-error');
            isValid = false;
        } else {
            agroEkosistemGroup.classList.remove('has-error');
        }

        // Validate Diseminasi table
        const diseminasiNames = document.querySelectorAll('.diseminasi-name');
        const diseminasiLuas = document.querySelectorAll('.diseminasi-luas');
        
        diseminasiNames.forEach((input) => {
            if (!input.value.trim()) {
                input.classList.add('error');
                isValid = false;
            } else {
                input.classList.remove('error');
            }
        });

        diseminasiLuas.forEach((input) => {
            if (!input.value || parseFloat(input.value) < 0) {
                input.classList.add('error');
                isValid = false;
            } else {
                input.classList.remove('error');
            }
        });

        return isValid;
    };

    const addRowDiseminasi = () => {
        currentIndexDiseminasi++;
        const table = document.getElementById('diseminasi_table').getElementsByTagName('tbody')[0];
        const newRow = table.insertRow();
        
        newRow.innerHTML = `
            <td>
                <input type="text" name="pemanfaatan_diseminasi[${currentIndexDiseminasi}][name]" placeholder="Nama Diseminasi" class="diseminasi-name" required>
            </td>
            <td>
                <input type="number" name="pemanfaatan_diseminasi[${currentIndexDiseminasi}][luas]" min="0" step="0.001" placeholder="Luas (Ha)" class="diseminasi-luas" required>
            </td>
            <td>
                <button type="button" class="delete-row" onclick="deleteRow(this, 'diseminasi')">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </td>
        `;
        
        // Enable the delete button on the first row if we now have more than one row
        if (table.rows.length > 1) {
            const firstRowDeleteBtn = table.rows[0].getElementsByClassName('delete-row')[0];
            if (firstRowDeleteBtn) {
                firstRowDeleteBtn.disabled = false;
            }
        }

        validateForm();
    };

    const deleteRow = (btn, type) => {
        const row = btn.parentNode.parentNode;
        const table = row.parentNode;
        
        // If this is the last row, don't delete it
        if (table.rows.length <= 1) {
            return;
        }
        
        row.parentNode.removeChild(row);
        
        // If we now have only one row, disable its delete button
        if (table.rows.length === 1) {
            const firstRowDeleteBtn = table.rows[0].getElementsByClassName('delete-row')[0];
            if (firstRowDeleteBtn) {
                firstRowDeleteBtn.disabled = true;
            }
        }
        
        // Reindex the remaining rows to prevent gaps in the indices
        reindexRows(type);
        validateForm();
    };

    const reindexRows = (type) => {
        const table = document.getElementById(`${type}_table`).getElementsByTagName('tbody')[0];
        const rows = table.rows;
        
        for (let i = 0; i < rows.length; i++) {
            const inputs = rows[i].getElementsByTagName('input');
            for (let j = 0; j < inputs.length; j++) {
                const input = inputs[j];
                const name = input.getAttribute('name');
                if (name) {
                    const newName = name.replace(/\[\d+\]/, `[${i}]`);
                    input.setAttribute('name', newName);
                }
            }
        }
        
        // Update current index
        currentIndexDiseminasi = rows.length - 1;
    };

    const previewImages = (input) => {
        const preview = document.getElementById('photo_preview');
        const files = input.files;
        
        const totalImages = existingImagesCount + files.length;
        
        if (totalImages > 5) {
            alert('Maksimal 5 foto total. Silakan hapus beberapa foto yang sudah ada atau kurangi foto baru.');
            input.value = '';
            return;
        }
        
        // Clear existing previews
        preview.innerHTML = '';
        uploadedImagesCount = 0;
        
        for (let i = 0; i < files.length; i++) {
            if (uploadedImagesCount >= 5) break;
            
            const file = files[i];
            if (!file.type.match('image.*')) continue;
            
            // Check file size (2MB = 2 * 1024 * 1024 bytes)
            if (file.size > 2 * 1024 * 1024) {
                alert(`File ${file.name} terlalu besar. Maksimal 2MB per foto.`);
                continue;
            }
            
            const reader = new FileReader();
            reader.onload = (e) => {
                const div = document.createElement('div');
                div.className = 'preview-item';
                div.innerHTML = `
                    <img src="${e.target.result}" alt="Preview foto baru">
                    <button type="button" class="remove-preview" onclick="removePreview(this, ${i})" title="Hapus foto ini">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                preview.appendChild(div);
            };
            
            reader.readAsDataURL(file);
            uploadedImagesCount++;
        }

        // Update upload area text if files are selected
        updateUploadAreaText(files.length);
    };

    const updateUploadAreaText = (fileCount) => {
        const uploadArea = document.querySelector('.file-upload-area');
        const uploadText = uploadArea.querySelector('.file-upload-text');
        const uploadSubtext = uploadArea.querySelector('.file-upload-subtext');
        
        if (fileCount > 0) {
            uploadText.textContent = `${fileCount} foto dipilih`;
            uploadSubtext.textContent = 'Klik untuk mengganti foto';
            uploadArea.style.borderColor = '#28B96C';
            uploadArea.style.backgroundColor = '#f0f9f4';
        } else {
            uploadText.textContent = 'Pilih atau seret foto ke sini';
            uploadSubtext.textContent = 'Klik untuk memilih file';
            uploadArea.style.borderColor = '#ccc';
            uploadArea.style.backgroundColor = '#f8f9fa';
        }
    };

    const removePreview = (btn, index) => {
        // Remove the preview element
        const previewItem = btn.parentNode;
        previewItem.parentNode.removeChild(previewItem);
        
        // Create a new FileList without the removed file
        const input = document.getElementById('dokumentasi');
        const dt = new DataTransfer();
        
        const { files } = input;
        for (let i = 0; i < files.length; i++) {
            if (i !== index) {
                dt.items.add(files[i]);
            }
        }
        
        input.files = dt.files;
        uploadedImagesCount--;
        
        // Re-preview remaining images
        previewImages(input);
    };

    const removeExistingImage = (index) => {
        const imageElement = document.getElementById(`existing_image_${index}`);
        const hiddenInput = imageElement.querySelector('input[type="hidden"]');
        
        // Add to removed images list
        removedExistingImages.push(hiddenInput.value);
        
        // Create hidden input to track removed images
        const form = document.querySelector('form');
        const removedInput = document.createElement('input');
        removedInput.type = 'hidden';
        removedInput.name = 'removed_images[]';
        removedInput.value = hiddenInput.value;
        form.appendChild(removedInput);
        
        // Remove the image element
        imageElement.remove();
        
        // Update existing images count
        existingImagesCount--;
    };

    // Add drag and drop functionality
    document.addEventListener('DOMContentLoaded', function() {
        const uploadArea = document.querySelector('.file-upload-area');
        const fileInput = document.getElementById('dokumentasi');

        // Prevent default drag behaviors
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, preventDefaults, false);
            document.body.addEventListener(eventName, preventDefaults, false);
        });

        // Highlight drop area when item is dragged over it
        ['dragenter', 'dragover'].forEach(eventName => {
            uploadArea.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, unhighlight, false);
        });

        // Handle dropped files
        uploadArea.addEventListener('drop', handleDrop, false);

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        function highlight(e) {
            uploadArea.classList.add('dragover');
        }

        function unhighlight(e) {
            uploadArea.classList.remove('dragover');
        }

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            fileInput.files = files;
            previewImages(fileInput);
        }

        // Main form fields validation
        document.getElementById('ip2sip_id').addEventListener('change', validateForm);
        document.getElementById('luas_sip').addEventListener('input', validateForm);
        document.getElementById('jumlah_sdm').addEventListener('input', validateForm);
        document.getElementById('agro_ekosistem').addEventListener('input', validateForm);

        // Table inputs - use event delegation
        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('diseminasi-name') || e.target.classList.contains('diseminasi-luas')) {
                validateForm();
            }
        });

        // Form submission
        document.getElementById('edit-form').addEventListener('submit', function(e) {
            if (!validateForm()) {
                e.preventDefault();
                // Scroll to first error field
                const firstError = document.querySelector('.has-error, .error');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        });

        // Initial validation
        setTimeout(validateForm, 100);
    });
</script>
@endsection