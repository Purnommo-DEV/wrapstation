@extends('layouts.app')
@section('title', 'Wizard')

@section('content')
<style>
    /* Area Tab Container */
    .nav-tabs {
        border-bottom: none !important;
        background-color: #f0f2f5; /* abu-abu lembut */
        border-radius: 8px 8px 0 0;
        padding: 0.3rem;
        box-shadow: inset 0 -1px 3px rgba(0, 0, 0, 0.05);
    }

    /* Tombol Tab */
    .nav-tabs .nav-link {
        border: 1px solid transparent;
        border-radius: 8px;
        background-color: rgba(255, 255, 255, 0.8);
        color: #6c757d;
        margin: 0 2px;
        transition: all 0.3s ease;
    }

    /* Hover Effect */
    .nav-tabs .nav-link:hover {
        color: #0d6efd;
        background-color: #e8ebf0;
        border-color: rgba(0, 0, 0, 0.05);
    }

    /* Active Tab */
    .nav-tabs .nav-link.active {
        color: white !important;
        background: linear-gradient(135deg, #0d6efd, #004bba);
        border-color: #0d6efd;
        box-shadow: 0 3px 6px rgba(13, 110, 253, 0.3);
        transform: translateY(-1px);
    }

    /* Ikon agar rapi */
    .nav-tabs .nav-link i {
        font-size: 1.3rem;
    }

    /* Card Container */
    .card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
    }
</style>

<div class="card border-0 shadow-lg rounded-4 overflow-hidden">
    <div class="card-body p-0">
        <!-- NAV TABS -->
        <ul class="nav nav-tabs justify-content-center" id="wizardTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active px-4 py-3" id="tab1" data-bs-toggle="tab" data-bs-target="#step1" type="button" title="Data">
                    <i class="fa-solid fa-car"></i>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link px-4 py-3" id="tab2" data-bs-toggle="tab" data-bs-target="#step2" type="button" title="Inspeksi">
                    <i class="fa-solid fa-file-lines"></i>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link px-4 py-3" id="tab3" data-bs-toggle="tab" data-bs-target="#step3" type="button" title="Foto">
                    <i class="fa-solid fa-camera"></i>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link px-4 py-3" id="tab4" data-bs-toggle="tab" data-bs-target="#step4" type="button" title="Submit">
                    <i class="fa-solid fa-check"></i>
                </button>
            </li>
        </ul>

        <!-- TAB CONTENT -->
        <div class="tab-content p-4 bg-white">
            <div class="tab-pane fade show active" id="step1">@include('wizard.steps.step1')</div>
            <div class="tab-pane fade" id="step2">@include('wizard.steps.step2')</div>
            <div class="tab-pane fade" id="step3">@include('wizard.steps.step3')</div>
            <div class="tab-pane fade" id="step4">@include('wizard.steps.step4')</div>
        </div>
    </div>
</div>

@endsection