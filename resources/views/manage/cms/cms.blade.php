@extends('layouts.admin_layout')
@section('content')
<style>
    :root {
        --primary-color: #00452C;
        --primary-hover: #005737;
        --warning-color: #f59e0b;
        --warning-hover: #d97706;
        --danger-color: #dc2626;
        --danger-hover: #b91c1c;
        --success-color: #059669;
        --success-hover: #047857;
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-300: #d1d5db;
        --gray-500: #6b7280;
        --gray-700: #374151;
        --gray-800: #1f2937;
        --gray-900: #111827;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        --border-radius: 12px;
        --border-radius-sm: 8px;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    * {
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background-color: var(--gray-50);
        line-height: 1.6;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
    }

    .page-header {
        margin-bottom: 2rem;
    }

    .page-title {
        font-size: 2.25rem;
        font-weight: 700;
        color: var(--gray-900);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .page-title::before {
        content: '⚙️';
        font-size: 2rem;
    }

    .card {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-lg);
        margin-bottom: 2rem;
        overflow: hidden;
        border: 1px solid var(--gray-200);
        transition: var(--transition);
    }

    .card:hover {
        box-shadow: var(--shadow-xl);
        transform: translateY(-2px);
    }

    .card-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%);
        color: white;
        padding: 1.5rem 2rem;
        border-bottom: 1px solid var(--gray-200);
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .card-body {
        padding: 2rem;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .form-label {
        font-weight: 600;
        color: var(--gray-700);
        text-transform: capitalize;
        font-size: 0.875rem;
        letter-spacing: 0.025em;
    }

    .form-input, .form-textarea, .form-select {
        padding: 0.875rem 1rem;
        border: 2px solid var(--gray-200);
        border-radius: var(--border-radius-sm);
        font-size: 0.95rem;
        transition: var(--transition);
        background-color: white;
        width: 100%;
    }

    .form-input:focus, .form-textarea:focus, .form-select:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgb(0 69 44 / 0.1);
    }

    .form-textarea {
        resize: vertical;
        min-height: 120px;
        font-family: inherit;
    }

    .form-select {
        cursor: pointer;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 2.5rem;
    }

    .image-preview {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .image-preview img {
        max-width: 150px;
        height: auto;
        border-radius: var(--border-radius-sm);
        border: 2px solid var(--gray-200);
        padding: 0.5rem;
        background-color: var(--gray-100);
    }

    .file-input-wrapper {
        position: relative;
        display: inline-block;
        cursor: pointer;
        background-color: var(--gray-100);
        border: 2px dashed var(--gray-300);
        border-radius: var(--border-radius-sm);
        padding: 1rem;
        text-align: center;
        transition: var(--transition);
        width: 100%;
    }

    .file-input-wrapper:hover {
        border-color: var(--primary-color);
        background-color: rgb(0 69 44 / 0.05);
    }

    .file-input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .file-input-text {
        color: var(--gray-500);
        font-size: 0.875rem;
    }

    /* Buttons */
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: var(--border-radius-sm);
        font-size: 0.875rem;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: var(--transition);
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%);
        color: white;
        box-shadow: var(--shadow-md);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, var(--primary-hover) 0%, var(--primary-color) 100%);
        box-shadow: var(--shadow-lg);
        transform: translateY(-1px);
    }

    .btn-warning {
        background: linear-gradient(135deg, var(--warning-color) 0%, var(--warning-hover) 100%);
        color: white;
        box-shadow: var(--shadow-md);
    }

    .btn-warning:hover {
        background: linear-gradient(135deg, var(--warning-hover) 0%, var(--warning-color) 100%);
        box-shadow: var(--shadow-lg);
        transform: translateY(-1px);
    }

    .btn-danger {
        background: linear-gradient(135deg, var(--danger-color) 0%, var(--danger-hover) 100%);
        color: white;
        box-shadow: var(--shadow-md);
    }

    .btn-danger:hover {
        background: linear-gradient(135deg, var(--danger-hover) 0%, var(--danger-color) 100%);
        box-shadow: var(--shadow-lg);
        transform: translateY(-1px);
    }

    .btn-sm {
        padding: 0.5rem 1rem;
        font-size: 0.8rem;
    }

    .btn-lg {
        padding: 1rem 2rem;
        font-size: 1rem;
    }

    /* Table */
    .table-container {
        background: white;
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--gray-200);
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.875rem;
    }

    .table th,
    .table td {
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid var(--gray-200);
    }

    .table th {
        background: linear-gradient(135deg, var(--gray-800) 0%, var(--gray-700) 100%);
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-size: 0.8rem;
    }

    .table tbody tr {
        transition: var(--transition);
    }

    .table tbody tr:hover {
        background-color: var(--gray-50);
    }

    .table tbody tr:last-child td {
        border-bottom: none;
    }

    .table-input {
        border: none;
        background: transparent;
        padding: 0.5rem;
        width: 100%;
        border-radius: var(--border-radius-sm);
        transition: var(--transition);
    }

    .table-input:focus {
        background-color: var(--gray-50);
        outline: 2px solid var(--primary-color);
    }

    .table-select {
        border: none;
        background-color: var(--gray-100);
        padding: 0.5rem;
        border-radius: var(--border-radius-sm);
        cursor: pointer;
        transition: var(--transition);
    }

    .table-select:focus {
        background-color: var(--gray-200);
        outline: 2px solid var(--primary-color);
    }

    /* Action buttons in table */
    .action-buttons {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }

    .action-buttons .btn {
        padding: 0.375rem 0.75rem;
        font-size: 0.75rem;
    }

    /* Add social form */
    .add-social-form {
        background: var(--gray-50);
        border: 2px dashed var(--gray-300);
        border-radius: var(--border-radius);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        transition: var(--transition);
    }

    .add-social-form.show {
        border-color: var(--primary-color);
        background-color: rgb(0 69 44 / 0.05);
    }

    .section-actions {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 1rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .container {
            padding: 1rem;
        }
        
        .form-grid {
            grid-template-columns: 1fr;
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        .table-container {
            overflow-x: auto;
        }
        
        .action-buttons {
            flex-direction: column;
            gap: 0.25rem;
        }
        
        .btn {
            padding: 0.5rem 1rem;
            font-size: 0.8rem;
        }
    }

    @media (max-width: 480px) {
        .page-title {
            font-size: 1.75rem;
        }
        
        .card-title {
            font-size: 1.25rem;
        }
    }

    /* Animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .card {
        animation: fadeIn 0.5s ease-out;
    }

    .add-social-form {
        max-height: 0;
        overflow: hidden;
        opacity: 0;
        transition: all 0.3s ease-out;
        padding: 0 1.5rem;
    }

    .add-social-form.show {
        max-height: 500px;
        opacity: 1;
        padding: 1.5rem;
    }
</style>

<div class="container">
    <div class="page-header">
        <h1 class="page-title">App Management</h1>
    </div>

    <!-- App Settings Card -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">
                <span>🏢</span>
                App Settings
            </h2>
        </div>
        <div class="card-body">
            <form action="{{ route('manage.cms.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="institute" class="form-label">Institute</label>
                        <input type="text" id="institute" name="institute" value="{{ $cms->institute }}" class="form-input" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="app_name" class="form-label">App Name</label>
                        <input type="text" id="app_name" name="app_name" value="{{ $cms->app_name }}" class="form-input" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="contact_1" class="form-label">Contact 1</label>
                        <input type="text" id="contact_1" name="contact_1" value="{{ $cms->contact_1 }}" class="form-input" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="contact_2" class="form-label">Contact 2 (WhatsApp)</label>
                        <input type="text" id="contact_2" name="contact_2" value="{{ $cms->contact_2 }}" class="form-input" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" value="{{ $cms->email }}" class="form-input" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="website" class="form-label">Website</label>
                        <input type="text" id="website" name="website" value="{{ $cms->website }}" class="form-input" required>
                    </div>
                </div>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="description" class="form-label">App Description</label>
                        <textarea name="description" id="description" class="form-textarea" required>{{ $cms->description }}</textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="address" class="form-label">Address</label>
                        <textarea name="address" id="address" class="form-textarea" required>{{ $cms->address }}</textarea>
                    </div>
                </div>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label for="logo_light" class="form-label">Logo Light</label>
                        <div class="image-preview">
                            <img src="/storage/cms/logo_light.png" alt="logo light">
                            <div class="file-input-wrapper">
                                <input type="file" id="logo_light" name="logo_light" class="file-input" accept="image/*">
                                <div class="file-input-text">Click to upload new logo</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="logo_green" class="form-label">Logo Colored</label>
                        <div class="image-preview">
                            <img src="/storage/cms/logo_green.png" alt="logo colored">
                            <div class="file-input-wrapper">
                                <input type="file" id="logo_green" name="logo_green" class="file-input" accept="image/*">
                                <div class="file-input-text">Click to upload new logo</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="display: flex; justify-content: flex-end; margin-top: 2rem;">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <span>💾</span>
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Social Media Card -->
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">
                <span>📱</span>
                Social Media
            </h2>
        </div>
        <div class="card-body">
            <div class="section-actions">
                <button onclick="toggleAddSocial()" class="btn btn-primary" id="addSocialBtn">
                    <span>➕</span>
                    Add Social Media
                </button>
            </div>

            <div id="add-social" class="add-social-form">
                <form action="{{ route('manage.social.store') }}" method="POST">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="name" class="form-label">Platform</label>
                            <select name="name" class="form-select" required>
                                <option value="" disabled selected>Choose Platform</option>
                                <option value="facebook">Facebook</option>
                                <option value="youtube">YouTube</option>
                                <option value="instagram">Instagram</option>
                                <option value="x-twitter">X (Twitter)</option>
                                <option value="tiktok">TikTok</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="url" class="form-label">URL</label>
                            <input type="url" id="url" name="url" class="form-input" placeholder="https://..." required>
                        </div>
                    </div>
                    
                    <div style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 1rem;">
                        <button type="button" onclick="toggleAddSocial()" class="btn btn-warning">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <span>➕</span>
                            Add Social Media
                        </button>
                    </div>
                </form>
            </div>

            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 60px;">#</th>
                            <th>Platform</th>
                            <th>URL</th>
                            <th style="width: 200px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($social as $key => $sc)
                            <tr>
                                <form action="{{ route('manage.social.update', Crypt::encryptString($sc->id)) }}" method="POST" id="social-update-{{ $key }}">
                                    @csrf
                                    @method('PUT')
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <select name="name" class="table-select" required>
                                            <option value="facebook" {{ $sc->name == 'facebook' ? 'selected' : '' }}>Facebook</option>
                                            <option value="youtube" {{ $sc->name == 'youtube' ? 'selected' : '' }}>YouTube</option>
                                            <option value="instagram" {{ $sc->name == 'instagram' ? 'selected' : '' }}>Instagram</option>
                                            <option value="x-twitter" {{ $sc->name == 'x-twitter' ? 'selected' : '' }}>X (Twitter)</option>
                                            <option value="tiktok" {{ $sc->name == 'tiktok' ? 'selected' : '' }}>TikTok</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="url" name="url" value="{{ $sc->url }}" class="table-input" required>
                                    </td>
                                </form>
                                <td>
                                    <div class="action-buttons">
                                        <button type="button" onclick="socialUpdate('social-update-{{ $key }}')" class="btn btn-warning btn-sm">
                                            <span>✏️</span>
                                            Update
                                        </button>
                                        <form action="{{ route('manage.social.destroy', Crypt::encryptString($sc->id)) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this social media?')">
                                                <span>🗑️</span>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    const socialUpdate = (formId) => {
        if (confirm('Are you sure you want to update this social media?')) {
            document.getElementById(formId).submit();
        }
    }

    const toggleAddSocial = () => {
        const form = document.getElementById('add-social');
        const btn = document.getElementById('addSocialBtn');
        
        if (form.classList.contains('show')) {
            form.classList.remove('show');
            btn.innerHTML = '<span>➕</span> Add Social Media';
        } else {
            form.classList.add('show');
            btn.innerHTML = '<span>❌</span> Cancel';
        }
    }

    // Enhanced file input interactions
    document.querySelectorAll('.file-input-wrapper').forEach(wrapper => {
        const input = wrapper.querySelector('.file-input');
        const text = wrapper.querySelector('.file-input-text');
        
        wrapper.addEventListener('click', () => input.click());
        
        input.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                text.textContent = `Selected: ${e.target.files[0].name}`;
                wrapper.style.borderColor = 'var(--success-color)';
                wrapper.style.backgroundColor = 'rgb(5 150 105 / 0.05)';
            }
        });
    });

    // Add smooth scrolling and focus management
    document.addEventListener('DOMContentLoaded', () => {
        // Auto-focus first input when add social form is shown
        const addSocialForm = document.getElementById('add-social');
        const observer = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                    if (addSocialForm.classList.contains('show')) {
                        setTimeout(() => {
                            const firstInput = addSocialForm.querySelector('select');
                            if (firstInput) firstInput.focus();
                        }, 300);
                    }
                }
            });
        });
        observer.observe(addSocialForm, { attributes: true });
    });
</script>
@endsection