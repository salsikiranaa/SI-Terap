@extends('layouts.admin_layout')
@section('content')
<style>
    /* Toast/Notification Styling */
    .toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
    }
    
    .toast {
        display: flex;
        align-items: center;
        background: white;
        color: #333;
        padding: 15px 20px;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 10px;
        transform: translateX(120%);
        transition: transform 0.3s ease;
        max-width: 350px;
        border-left: 4px solid #28B96C;
    }
    
    .toast.show {
        transform: translateX(0);
    }
    
    .toast.error {
        border-left-color: #D32F2F;
    }
    
    .toast-icon {
        margin-right: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background-color: #28B96C;
        color: white;
    }
    
    .toast.error .toast-icon {
        background-color: #D32F2F;
    }
    
    .toast-content {
        flex: 1;
    }
    
    .toast-title {
        font-weight: 600;
        margin-bottom: 5px;
    }
    
    .toast-message {
        font-size: 14px;
        opacity: 0.9;
    }
    
    .toast-close {
        cursor: pointer;
        opacity: 0.7;
        transition: opacity 0.2s;
    }
    
    .toast-close:hover {
        opacity: 1;
    }
    
    /* Base Styling */
    :root {
        --primary: #00452C;
        --primary-hover: #005737;
        --secondary: #28B96C;
        --warning: #FFB300;
        --warning-hover: #FFC739;
        --danger: #D32F2F;
        --danger-hover: #E53935;
        --light-bg: #f5f5f5;
        --border-color: #e0e0e0;
        --text-dark: #333333;
        --text-light: #757575;
        --radius: 8px;
        --shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        --transition: all 0.3s ease;
    }
    
    .container {
        padding: 25px;
        background-color: white;
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        margin-bottom: 30px;
    }
    
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        border-bottom: 2px solid var(--primary);
        padding-bottom: 15px;
    }
    
    .page-title {
        font-size: 24px;
        font-weight: 600;
        color: var(--primary);
        margin: 0;
    }
    
    /* Table Styling */
    .data-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        margin-top: 20px;
        border-radius: var(--radius);
        overflow: hidden;
        box-shadow: var(--shadow);
    }

    .data-table th, 
    .data-table td {
        padding: 12px 15px;
        border: 1px solid var(--border-color);
        text-align: left;
    }

    .data-table th {
        background-color: var(--primary);
        color: white;
        font-weight: 500;
        text-transform: uppercase;
        font-size: 14px;
        letter-spacing: 0.5px;
    }
    
    .data-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    
    .data-table tr:hover {
        background-color: #f1f1f1;
    }
    
    .number {
        width: 50px;
        text-align: center;
    }
    
    /* Pagination Styling */
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 20px 0;
        gap: 8px;
    }

    .paginate-item, .paginate-button {
        padding: 8px 12px;
        border-radius: var(--radius);
        text-decoration: none;
        transition: var(--transition);
        font-weight: 500;
    }

    .paginate-item {
        color: var(--text-dark);
        border: 1px solid var(--border-color);
    }

    .paginate-item:hover {
        background-color: #f1f1f1;
    }
    
    .paginate-button {
        background-color: var(--primary);
        color: white;
        border: none;
    }

    .paginate-button:hover {
        background-color: var(--primary-hover);
    }
    
    .disabled-paginate {
        pointer-events: none;
        background-color: #e0e0e0;
        color: #9e9e9e;
    }
    
    .active-paginate {
        pointer-events: none;
        background-color: var(--primary);
        color: white;
        border: none;
    }

    /* Button Styling */
    .btn {
        display: inline-block;
        font-weight: 500;
        text-align: center;
        vertical-align: middle;
        cursor: pointer;
        border: 1px solid transparent;
        padding: 10px 15px;
        font-size: 14px;
        line-height: 1.5;
        border-radius: var(--radius);
        transition: var(--transition);
    }

    .btn-primary {
        background-color: var(--primary);
        color: white;
    }

    .btn-primary:hover {
        background-color: var(--primary-hover);
    }
    
    .btn-warning {
        background-color: var(--warning);
        color: var(--text-dark);
    }

    .btn-warning:hover {
        background-color: var(--warning-hover);
    }
    
    .btn-danger {
        background-color: var(--danger);
        color: white;
    }

    .btn-danger:hover {
        background-color: var(--danger-hover);
    }
    
    .btn-sm {
        padding: 6px 10px;
        font-size: 13px;
    }
    
    /* Form Styling */
    .search-form {
        display: flex;
        margin-bottom: 20px;
        max-width: 500px;
    }
    
    .search-input {
        flex: 1;
        height: 40px;
        padding: 0 15px;
        border: 1px solid var(--border-color);
        border-right: none;
        border-radius: var(--radius) 0 0 var(--radius);
        transition: var(--transition);
    }
    
    .search-input:focus {
        outline: none;
        border-color: var(--primary);
    }
    
    .search-btn {
        height: 40px;
        padding: 0 20px;
        background-color: var(--primary);
        color: white;
        border: none;
        border-radius: 0 var(--radius) var(--radius) 0;
        cursor: pointer;
        transition: var(--transition);
    }
    
    .search-btn:hover {
        background-color: var(--primary-hover);
    }
    
    .form-group {
        margin-bottom: 15px;
    }
    
    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: var(--text-dark);
    }
    
    .form-control {
        display: block;
        width: 100%;
        padding: 10px 15px;
        font-size: 14px;
        line-height: 1.5;
        color: var(--text-dark);
        background-color: #fff;
        border: 1px solid var(--border-color);
        border-radius: var(--radius);
        transition: var(--transition);
    }
    
    .form-control:focus {
        outline: none;
        border-color: var(--primary);
    }
    
    select.form-control {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23333333' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 10px center;
        padding-right: 35px;
    }
    
    textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }
    
    /* Card Styling */
    .card {
        background-color: white;
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        margin-bottom: 20px;
        overflow: hidden;
    }
    
    .card-header {
        padding: 15px 20px;
        background-color: #f5f5f5;
        border-bottom: 1px solid var(--border-color);
        font-weight: 600;
    }
    
    .card-body {
        padding: 20px;
    }
    
    /* Actions & Modals */
    .action-buttons {
        display: flex;
        gap: 8px;
        justify-content: center;
    }
    
    .confirm-delete {
        background-color: #fff5f5;
        border: 1px solid #ffcdd2;
        border-radius: var(--radius);
        padding: 15px;
        margin-top: 10px;
    }
    
    .confirm-delete div:first-child {
        margin-bottom: 10px;
    }
    
    .image-preview a {
        color: var(--primary);
        text-decoration: none;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
    }
    
    .image-preview a:hover {
        text-decoration: underline;
    }
    
    .image-preview a:after {
        content: "→";
        margin-left: 5px;
    }
</style>

<div class="container">
    <div class="page-header">
        <h2 class="page-title">Manage BSIP Profile</h2>
        <button class="btn btn-primary" onclick="toggleCreate()">
            <i class="fas fa-plus"></i> Create New Profile
        </button>
    </div>

    <form id="create" action="{{ route('manage.profile_bsip.store') }}" method="POST" enctype="multipart/form-data" style="display: none;" class="card">
        <div class="card-header">Add New BSIP Profile</div>
        <div class="card-body">
            @csrf
            <div class="form-group">
                <label class="form-label" for="bsip">BSIP</label>
                <select name="m_bsip_id" id="bsip" class="form-control" required>
                    <option value="" selected disabled>-- Select One --</option>
                    @foreach ($m_bsip as $bs)
                        <option value="{{ $bs->id }}">{{ $bs->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label class="form-label" for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control" accept=".jpg,.jpeg,.png" required>
                <div id="imagePreview" style="margin-top: 10px; display: none;">
                    <img id="previewImg" src="#" alt="Preview" style="max-width: 100%; max-height: 200px; border-radius: 4px;">
                </div>
            </div>
            <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 20px;">
                <button type="button" class="btn btn-danger" onclick="toggleCreate()">Cancel</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>

    <div class="search-container">
        <form action="{{ route('manage.profile_bsip.index') }}" class="search-form">
            <input type="search" name="search" class="search-input" placeholder="Search profiles..." value="{{ request()->search }}">
            <button class="search-btn" type="submit">Search</button>
        </form>
    </div>

    <table class="data-table">
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
                                {{ Str::limit($prof->description, 100) }}
                            </div>
                            <textarea name="description" class="form-control description-input" rows="5" style="display: none" required>{{ $prof->description }}</textarea>
                        </td>
                        <td>
                            <div class="image-data image-preview" style="display: block;">
                                <a href="{{ $prof->image_url }}" target="_blank">View Image</a>
                            </div>
                            <input type="file" name="image" accept=".jpg,.jpeg,.png" class="form-control image-input" style="display: none">
                        </td>
                    </form>
                    <td>
                        <div class="actions action-buttons" style="display: block;">
                            <button class="btn btn-warning btn-sm" onclick="toggleEdit({{ $key }})">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="toggleDelete({{ $key }})">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </div>
                        <div class="edit-action action-buttons" style="display: none;">
                            <button class="btn btn-primary btn-sm" onclick="update({{ $key }})">
                                <i class="fas fa-save"></i> Save
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="toggleEdit({{ $key }})">
                                <i class="fas fa-times"></i> Cancel
                            </button>
                        </div>
                        <form action="{{ route('manage.profile_bsip.destroy', Crypt::encryptString($prof->id)) }}" method="POST" class="delete" style="display: none;">
                            @csrf
                            @method('DELETE')
                            <div class="confirm-delete">
                                <div>Are you sure you want to <span style="color: var(--danger); font-weight: 600;">delete</span> this profile?</div>
                                <div class="action-buttons">
                                    <button type="button" class="btn btn-sm btn-danger" onclick="toggleDelete({{ $key }})">Cancel</button>
                                    <button type="submit" class="btn btn-sm btn-primary">Yes, Delete</button>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination">
        <a href="{{ route('manage.profile_bsip.index', [...request()->all(), 'page' => 1]) }}" class="paginate-button {{ $profiles->currentPage() == 1 ? 'disabled-paginate' : '' }}">First</a>
        <a href="{{ route('manage.profile_bsip.index', [...request()->all(), 'page' => $profiles->currentPage() - 1]) }}" class="paginate-button {{ $profiles->currentPage() == 1 ? 'disabled-paginate' : '' }}">
            <i class="fas fa-chevron-left"></i>
        </a>
        @for ($i = 1; $i <= $profiles->lastPage(); $i++)
            <a href="{{ route('manage.profile_bsip.index', [...request()->all(), 'page' => $i]) }}" class="paginate-item {{ $profiles->currentPage() == $i ? 'active-paginate' : '' }}">{{ $i }}</a>
        @endfor
        <a href="{{ route('manage.profile_bsip.index', [...request()->all(), 'page' => $profiles->currentPage() + 1]) }}" class="paginate-button {{ $profiles->currentPage() == $profiles->lastPage() ? 'disabled-paginate' : '' }}">
            <i class="fas fa-chevron-right"></i>
        </a>
        <a href="{{ route('manage.profile_bsip.index', [...request()->all(), 'page' => $profiles->lastPage()]) }}" class="paginate-button {{ $profiles->currentPage() == $profiles->lastPage() ? 'disabled-paginate' : '' }}">Last</a>
    </div>
</div>

<!-- Toast Container -->
<div class="toast-container" id="toastContainer"></div>

<script>
    // Show notification toast
    function showToast(message, isError = false) {
        const toastContainer = document.getElementById('toastContainer');
        
        // Create toast element
        const toast = document.createElement('div');
        toast.className = `toast ${isError ? 'error' : ''}`;
        
        // Create toast content
        toast.innerHTML = `
            <div class="toast-icon">
                ${isError ? '✕' : '✓'}
            </div>
            <div class="toast-content">
                <div class="toast-title">${isError ? 'Error' : 'Success'}</div>
                <div class="toast-message">${message}</div>
            </div>
            <div class="toast-close" onclick="this.parentElement.remove()">✕</div>
        `;
        
        // Add toast to container
        toastContainer.appendChild(toast);
        
        // Trigger reflow for animation
        void toast.offsetWidth;
        
        // Show toast with animation
        toast.classList.add('show');
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => {
                toast.remove();
            }, 300);
        }, 5000);
    }
    
    // Check if there's a success or error message in the session
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('success'))
            showToast("{{ session('success') }}");
        @endif
        
        @if(session('error') || $errors->any())
            @if(session('error'))
                showToast("{{ session('error') }}", true);
            @else
                showToast("{{ $errors->first() }}", true);
            @endif
        @endif
    });
    
    const toggleCreate = () => {
        const form = document.getElementById('create')
        if (form.style.display === 'none') {
            form.style.display = 'block'
        } else {
            form.style.display = 'none'
        }
    }
    
    // Image preview functionality
    document.getElementById('image').addEventListener('change', function(e) {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            const preview = document.getElementById('imagePreview');
            const previewImg = document.getElementById('previewImg');
            
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.style.display = 'block';
            }
            
            reader.readAsDataURL(file);
        }
    });

    const toggleDelete = (index) => {
        const actions = document.getElementsByClassName('actions')[index]
        const form = document.getElementsByClassName('delete')[index]
        
        if (actions.style.display === 'block') {
            actions.style.display = 'none'
            form.style.display = 'block'
        } else {
            actions.style.display = 'block'
            form.style.display = 'none'
        }
    }
    
    const toggleEdit = (index) => {
        const actions = document.getElementsByClassName('actions')[index]
        const editAction = document.getElementsByClassName('edit-action')[index]
        const descriptionData = document.getElementsByClassName('description-data')[index]
        const descriptionInput = document.getElementsByClassName('description-input')[index]
        const imageData = document.getElementsByClassName('image-data')[index]
        const imageInput = document.getElementsByClassName('image-input')[index]
        
        if (actions.style.display === 'block') {
            actions.style.display = 'none'
            editAction.style.display = 'block'
            descriptionData.style.display = 'none'
            descriptionInput.style.display = 'block'
            imageData.style.display = 'none'
            imageInput.style.display = 'block'
        } else {
            actions.style.display = 'block'
            editAction.style.display = 'none'
            descriptionData.style.display = 'block'
            descriptionInput.style.display = 'none'
            imageData.style.display = 'block'
            imageInput.style.display = 'none'
        }
    }

    const update = (index) => {
        const form = document.getElementsByClassName('edit')[index]
        form.submit()
    }
</script>
@endsection