@extends('layouts.layoutIp2tp')

@section('content')
<style>
    .dokumentasi-container {
        background-color: #f8f9fa;
        padding: 30px 0;
        min-height: 100vh;
    }

    .page-title {
        color: #009144;
        font-weight: 600;
        margin-bottom: 15px;
        font-size: 1.75rem;
    }

    .breadcrumb-custom {
        background: none;
        padding: 0;
        margin-bottom: 20px;
    }

    .breadcrumb-custom .breadcrumb-item a {
        color: #009144;
        text-decoration: none;
    }

    .breadcrumb-custom .breadcrumb-item.active {
        color: #6c757d;
    }

    .dokumentasi-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .dokumentasi-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .dokumentasi-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .file-preview {
        height: 200px;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .file-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .file-icon {
        font-size: 4rem;
        color: #009144;
    }

    .file-info {
        padding: 15px;
    }

    .file-name {
        font-weight: 600;
        margin-bottom: 8px;
        color: #333;
        word-break: break-word;
    }

    .file-description {
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 10px;
    }

    .file-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.8rem;
        color: #6c757d;
        margin-bottom: 15px;
    }

    .file-actions {
        display: flex;
        gap: 10px;
    }

    .btn-download {
        background: #009144;
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .btn-download:hover {
        background: #007a3a;
        color: white;
        text-decoration: none;
    }

    .btn-view {
        background: #17a2b8;
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .btn-view:hover {
        background: #138496;
        color: white;
        text-decoration: none;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 20px;
        opacity: 0.5;
    }

    @media (max-width: 768px) {
        .dokumentasi-grid {
            grid-template-columns: 1fr;
        }
        
        .file-actions {
            flex-direction: column;
        }
    }
</style>

<section class="dokumentasi-container">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item">
                    <a href="{{ route('lp2tp.pemanfaatan_kp') }}">
                        <i class="fas fa-arrow-left me-1"></i>
                        Pemanfaatan KP
                    </a>
                </li>
                <li class="breadcrumb-item active">Dokumentasi</li>
            </ol>
        </nav>

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="page-title">Dokumentasi Pemanfaatan KP</h2>
                <p class="text-muted mb-0">
                    {{ $pemanfaatan_sip->ip2sip->bsip->name }}/KP. {{ $pemanfaatan_sip->ip2sip->name }}
                </p>
            </div>
            <div class="badge bg-success fs-6">
                {{ $pemanfaatan_sip->dokumentasi->count() }} File
            </div>
        </div>

        <!-- Dokumentasi Grid -->
        @if($pemanfaatan_sip->dokumentasi->isNotEmpty())
            <div class="dokumentasi-grid">
                @foreach($pemanfaatan_sip->dokumentasi as $doc)
                    <div class="dokumentasi-card">
                        <!-- File Preview -->
                        <div class="file-preview">
                            @if($doc->is_image)
                                <img src="{{ $doc->file_url }}" alt="{{ $doc->file_name }}" loading="lazy">
                            @elseif($doc->is_pdf)
                                <i class="fas fa-file-pdf file-icon" style="color: #dc3545;"></i>
                            @else
                                <i class="fas fa-file-alt file-icon"></i>
                            @endif
                        </div>

                        <!-- File Info -->
                        <div class="file-info">
                            <div class="file-name">{{ $doc->file_name }}</div>
                            
                            @if($doc->description)
                                <div class="file-description">{{ $doc->description }}</div>
                            @endif

                            <div class="file-meta">
                                <span>{{ $doc->file_size_human }}</span>
                                <span>{{ $doc->created_at->format('d M Y') }}</span>
                            </div>

                            <div class="file-actions">
                                @if($doc->is_image)
                                    <a href="{{ $doc->file_url }}" target="_blank" class="btn-view">
                                        <i class="fas fa-eye"></i>
                                        Lihat
                                    </a>
                                @endif
                                
                                <a href="{{ $doc->file_url }}" download="{{ $doc->file_name }}" class="btn-download">
                                    <i class="fas fa-download"></i>
                                    Download
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="empty-state">
                <i class="fas fa-folder-open"></i>
                <h4>Belum Ada Dokumentasi</h4>
                <p>Dokumentasi untuk pemanfaatan ini belum tersedia.</p>
                <a href="{{ route('lp2tp.pemanfaatan_kp.edit', $pemanfaatan_sip->id) }}" class="btn btn-success">
                    <i class="fas fa-plus me-1"></i>
                    Tambah Dokumentasi
                </a>
            </div>
        @endif
    </div>
</section>
@endsection