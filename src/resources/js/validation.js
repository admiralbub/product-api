import Swal from 'sweetalert2'
import Lang from './lang/lang'


Lang();


function showErr(field, errText) {
    const parent = field.parentNode;
    
    field.classList.add("field-error");
    const err = document.createElement('span');
    err.textContent = errText;
    parent.append(err);
    err.classList.add('error-title');
    

}

function hideErr(field) {
    const parent = field.parentNode;
    if(field.classList.contains('field-error')) {
        field.classList.remove('field-error');
        parent.querySelector('.error-title').remove();
    }
    
}



function validateEmail(email) {
    // Regular expression for a basic email pattern
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}
function validatePhoneNumber(phone) {
    const regex = /^\+38\(\d{3}\)\d{3}-\d{2}-\d{2}$/;
    return regex.test(phone);
}
function validField(input) {
    hideErr(input)
    let result = true;
    let pass = document.getElementById('password');
    if (input.classList.contains("d-none")) {
        return true; // Если у поля есть этот класс, игнорируем валидацию
    }
    if(input.dataset.require == "true") {
        if (input.tagName === 'INPUT') {
            if(input.value == "") {
                showErr(input, window.lang.validator.empty);
                result = false;
            } else if(input.name=="email") {
                if (!validateEmail(input.value)) {
                    showErr(input, window.lang.validator.email);
                    result = false;
                }
            } else if(input.dataset.max) {
                if(input.value.length >  input.dataset.max) {
                    showErr(input, window.lang.validator.maxlength);
                    result = false;
                }
            } else if(input.name=="password_confirmation") {
                if(pass.value != input.value) {
                    showErr(input, window.lang.validator.confirm_pass);
                    result = false;
                }
            } else if(input.name=="phone") {
                if (!validatePhoneNumber(input.value)) {
                    showErr(input, window.lang.validator.phone);
                    result = false;
                }
            } else if(input.dataset.min) {
                if(input.value.length < input.dataset.min) {
                    showErr(input, window.lang.validator.minlength);
                    result =false;
                }
            }
        } else if (input.tagName === 'SELECT') {
            if (input.value == "" || input.value == "default") { // Проверка на значение по умолчанию
                showErr(input, window.lang.validator.select_required);
                result = false;
            }
        }
        
            
    }
    return result;
}

function validation(form) {
    const AllInput = form.querySelectorAll('input, select');
    let result = true;
    for(let input of AllInput) {
        if (!validField(input)) {
            result = false; // Установить флаг в false, если хоть одно поле не валидно
        }
       
    }
    return result;
}

//Валидация при нажатие на кнопку

const forms = document.querySelectorAll('.form');

if (forms.length) {
    forms.forEach(form => {
        const inputs = form.querySelectorAll('input, select');

        // Обработчик отправки формы
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            if (validation(this) === true) {
                submitForm(this);
            } else {
                Swal.fire({
                    title: window.lang.validator.error,
                    text: window.lang.validator.error_valid,
                    icon: "error"
                });
            }
        });

        // Обработчик ввода для каждого поля
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                validField(input);
            });
        });
    });

    // Функция отправки данных формы через AJAX
    async function submitForm(form) {
        const formData = new FormData(form);
        
        try {
            
            const response = await fetch(form.action, {
                method: form.method,
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });

            if (response.ok) {
                const result = await response.json();

                if (result.error) {
                    Swal.fire({
                        title: window.lang.validator.error,
                        text: result.error,
                        icon: "error"
                    });
                } else {
                    Swal.fire({
                        title: '',
                        text: result.success,
                        icon: "success"
                    });
                    setTimeout(() => {
                        document.location.href = result.redirect;
                    }, 2000);
                }

            } else {
                const errors = await response.json();

                if (errors.errors) {
                    Swal.fire({
                        title: window.lang.validator.error,
                        text: window.lang.validator.error_valid,
                        icon: "error"
                    });
                }
            }

        } catch (error) {
            console.error(error);
        }
    }
}