// resources/js/wizard.js
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        // Pastikan bootstrap sudah ada
        if (typeof window.bootstrap === 'undefined') {
            console.error('Bootstrap belum ter-load!');
            setTimeout(arguments.callee, 50);
            return;
        }

        const steps = ['step1', 'step2', 'step3', 'step4'];
        let currentStep = 0;

        // Ambil dari hash
        const hash = window.location.hash.substring(1) || 'step1';
        currentStep = steps.indexOf(hash);
        if (currentStep === -1) currentStep = 0;

        // Aktifkan tab
        const tabEl = document.getElementById(`tab${currentStep + 1}`);
        if (tabEl) {
            const tab = new window.bootstrap.Tab(tabEl);
            tab.show();
        }

        // Event tab berubah
        document.querySelectorAll('#wizardTabs .nav-link').forEach((tabEl, index) => {
            tabEl.addEventListener('shown.bs.tab', function (e) {
                const targetStep = index;

                if (targetStep > currentStep) {
                    if (!validateStep(currentStep)) {
                        e.preventDefault();
                        const prevTab = new window.bootstrap.Tab(e.relatedTarget);
                        prevTab.show();
                        return;
                    }
                }

                saveStep(currentStep);
                currentStep = targetStep;
                window.location.hash = steps[targetStep];
            });
        });

        // Load data
        loadAllSteps();
    });

    // Global functions
    window.validateStep = function (step) {
        if (step === 0 && typeof validateStep1 === 'function') return validateStep1();
        if (step === 1 && typeof validateStep2 === 'function') return validateStep2();
        if (step === 2 && typeof validateStep3 === 'function') return validateStep3();
        return true;
    };

    window.saveStep = function (step) {
        if (step === 0 && typeof saveStep1 === 'function') saveStep1();
        if (step === 1 && typeof saveStep2 === 'function') saveStep2();
        if (step === 2 && typeof saveStep3 === 'function') saveStep3();
    };

    window.showError = function (msg) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({ icon: 'error', title: 'Error', text: msg });
        } else {
            alert(msg);
        }
    };

    window.loadAllSteps = function () {
        if (typeof loadStep1 === 'function') loadStep1();
        if (typeof loadStep2 === 'function') loadStep2();
        if (typeof loadStep3 === 'function') loadStep3();
    };
})();