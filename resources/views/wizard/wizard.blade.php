@extends('layouts.app')
@section('title', 'Wizard')

@section('content')
<div class="card border-0 shadow">
    <div class="card-body p-0">
        <!-- NAV TABS -->
        <ul class="nav nav-tabs" id="wizardTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="tab1" data-bs-toggle="tab" data-bs-target="#step1" type="button">
                    1. Data
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab2" data-bs-toggle="tab" data-bs-target="#step2" type="button">
                    2. Inspeksi
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab3" data-bs-toggle="tab" data-bs-target="#step3" type="button">
                    3. Foto
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab4" data-bs-toggle="tab" data-bs-target="#step4" type="button">
                    4. Submit
                </button>
            </li>
        </ul>

        <!-- TAB CONTENT -->
        <div class="tab-content p-4">
            <div class="tab-pane fade show active" id="step1">@include('wizard.steps.step1')</div>
            <div class="tab-pane fade" id="step2">@include('wizard.steps.step2')</div>
            <div class="tab-pane fade" id="step3">@include('wizard.steps.step3')</div>
            <div class="tab-pane fade" id="step4">@include('wizard.steps.step4')</div>
        </div>
    </div>
</div>
@endsection