if (formConditionals?.length > 0) {
    for (let i = 0; i < formConditionals.length; i++) {
        // Prepare a switches object for each condition.
        const switches = {};

        // Get conditions.
        const conditions = formConditionals[i];

        console.log(formConditionals)

        // Get major info.
        const {targetFieldSel, relation, formId} = conditions;

        // Delete non-numeric keys.
        delete conditions.targetFieldSel;
        delete conditions.relation;
        delete conditions.formId;
        delete conditions.position;

        // Select the form
        const formContainer = document.querySelector(formId);

        // Target field.
        const targetField = document.querySelector(targetFieldSel);

        // Do we have any "reset" buttons inside the form?
        const resetBtn = formContainer?.querySelector('input[type="reset"]') ?? null;
 
        // Get each condition.
        Object.keys(conditions).forEach((key) => {
            // let compare = null;
            
            const {compare, field, value} = conditions[key];
            switches[key] = false;

            const controllerField = (() => {
                switch (true) {
                    case Boolean(document.querySelector(`input[name=${field}]`)):
                        return document.querySelectorAll(`input[name=${field}]`);
                    case Boolean(document.querySelector(`input[name='${field}[]']`)):
                        return document.querySelectorAll(`input[name="${field}[]"]`);
                    case Boolean(document.querySelector(`textarea[name=${field}]`)):
                        return document.querySelectorAll(`textarea[name=${field}]`);
                    case Boolean(document.querySelector(`select[name=${field}]`)):
                        return document.querySelectorAll(`select[name=${field}]`);
                }
            })()

            console.log(controllerField);

            controllerField.forEach(field => {
                const fieldType = field.getAttribute('type');
                const tagName = field.tagName

                // console.log(field)

                field.addEventListener('input', e => {
                    switch(true) {
                        case 'checkbox' === fieldType:
                            if (value === e.target.value || 'boolean' === typeof value) {
                                switches[key] = e.target.checked;
                            }
                            break;
                        case 'radio' === fieldType:
                            switches[key] = (e.target.checked && value === e.target.value)
                            break;
                        case 'SELECT' === tagName:
                        case 'TEXTAREA' === tagName:
                        case 'text' === fieldType:
                        case 'number' === fieldType:
                        case 'color' === fieldType:
                            switch(compare) {
                                case '=':
                                    switches[key] = (e.target.value == value);
                                    break;
                                case '>':
                                    switches[key] = (Number(e.target.value) > Number(value));
                                    break;
                                case '<':
                                    switches[key] = (Number(e.target.value) < Number(value));
                                    break;
                                case '>=':
                                    switches[key] = (Number(e.target.value) >= Number(value));
                                    break;
                                case '<=':
                                    switches[key] = (Number(e.target.value) <= Number(value));
                                    break;
                            }
                            break;
                    }

                })
            })

            // console.log(compare, field, value, controllerField)
        })

        // Check if switches are all true.
        formContainer.addEventListener('input', () => {
            const booleans = Object.values(switches);
            let status = false;

            switch(relation) {
                case 'AND':
                    // All booleans must be true.
                    if (booleans.includes(false)) {
                        status = false;
                    } else {
                        status = true;
                    }
                    break;
                case 'OR': 
                    // At the first TRUE condition (status) passes.
                    booleans.forEach(bool => {
                        if (bool) {
                            status = bool;
                        }
                    })
                    break;
            }

            // console.log(status, switches, targetField, relation)

            // console.log(targetField, status, switches)

            // Reveal the field based on "status"
            if (status) {
                targetField.classList.remove('hidden')
            } else {
                targetField.classList.add('hidden')
            }
        })

        // Listen to the reset button.
        resetBtn?.addEventListener('click', () => {
            targetField.classList.add('hidden');
        });
    }
}