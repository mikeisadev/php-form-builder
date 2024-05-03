if (formConfig.length > 0) {
    for (let i = 0; i < formConfig.length; i++) {
        const {formId, initialStep, totalSteps, showPercentage} = formConfig[i];

        let currentStep = initialStep;
        let progressBar = null;

        const form = document.querySelector(formId);
        const formBody = form.parentElement;
        const formSteps = form.querySelectorAll('.single-step');

        if (formBody.querySelector('.progress-bar-wrap')) {
            progressBar = formBody.querySelector('.progress-bar-wrap .progress-bar');
        }

        const formActionBar = formBody.querySelector('.action-bar-wrap');

        const formCurrStep = formActionBar.querySelector('.form-index .start');

        const goNextBtn = formActionBar.querySelector('button[data-action="next"]');
        const goBackBtn = formActionBar.querySelector('button[data-action="back"]');

        goBackBtn.setAttribute('disabled', true);

        setTimeout(() => updateProgressBar(progressBar, currentStep, totalSteps, showPercentage), 500)

        goNextBtn.addEventListener('click', e => {
            if (currentStep < totalSteps) {
                currentStep++;
            }

            updateProgressBar(progressBar, currentStep, totalSteps, showPercentage);
            showOneStep(formSteps, currentStep);
            updateFormCurrentStep(formCurrStep, currentStep);

            if (currentStep === totalSteps) {
                goNextBtn.setAttribute('disabled', true);
            } else {
                goBackBtn.removeAttribute('disabled');
            }

            console.log(currentStep)
        })

        goBackBtn.addEventListener('click', e => {
            if (currentStep > 1) {
                currentStep--;
            }

            updateProgressBar(progressBar, currentStep, totalSteps, showPercentage);
            showOneStep(formSteps, currentStep);
            updateFormCurrentStep(formCurrStep, currentStep);

            if (currentStep === 1) {
                goBackBtn.setAttribute('disabled', true);
            } else {
                goNextBtn.removeAttribute('disabled');
            }

            console.log(currentStep)
        })

        // console.log(form, formSteps, goNextBtn, goBackBtn);
        // console.log(initialStep, totalSteps, formId);
    }

    // Update progress bar.
    function updateProgressBar(progressBar, currentStep, totalSteps, showPercentage = false) {
        const percentage = (currentStep / totalSteps) * 100;

        if (progressBar) {
            progressBar.style.width = `${percentage}%`;
        }

        if (showPercentage) {
            progressBar.querySelector('.indicator').innerText = `${Math.trunc(percentage)}%`;
        }
    }

    // Hide all other steps and show the selected one!
    function showOneStep(formSteps, showStep) {
        formSteps.forEach((step, index) => {
            step.classList.add('hidden-step')

            if ((index+1) === showStep) {
                step.classList.remove('hidden-step')
            }
        })
    }

    // Visually update the current step of the form.
    function updateFormCurrentStep(formCurrStepEl, currStep) {
        formCurrStepEl.innerText = currStep;
    }
}