if (formConfig.length > 0) {
    for (let i = 0; i < formConfig.length; i++) {
        const {formId, initialStep, totalSteps} = formConfig[i];

        let currentStep = initialStep;

        const form = document.querySelector(formId);
        const formSteps = form.querySelectorAll('.single-step');

        const formActionBar = form.parentElement.querySelector('.action-bar-wrap');

        const formCurrStep = formActionBar.querySelector('.form-index .start');

        const goNextBtn = formActionBar.querySelector('button[data-action="next"]');
        const goBackBtn = formActionBar.querySelector('button[data-action="back"]');

        goBackBtn.setAttribute('disabled', true);

        goNextBtn.addEventListener('click', e => {
            if (currentStep < totalSteps) {
                currentStep++;
            }

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