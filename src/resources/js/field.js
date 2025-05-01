document.addEventListener("DOMContentLoaded", function() {
    const deliver = document.querySelector('#deliver');
    const np_city_input = document.querySelector('#np_city_input');

    const ukr_post_city = document.querySelector('#ukr_post_city');
    const ukr_post_id_city = document.querySelector('#ukr_post_id_city');


    const resusltCityNp = document.querySelector('#resusltCityNp');
    const resusltWarehouseUkrPost = document.querySelector('#resusltWarehouseUkrPost');
    
    const resusltCityUkrPost = document.querySelector('#resusltCityUkrPost');
    
    
    const warehouse_input = document.querySelector('#warehouse_input');
    const resusltWarehouseNp = document.querySelector('#resusltWarehouseNp');

    const clear_city_np = document.querySelector('#clear_city_np');
    const clear_warehouse_np = document.querySelector('#clear_warehouse_np');

    const city_ref_np = document.querySelector('#city_ref_np');
    const warehouse_ref_np = document.querySelector('#warehouse_ref_np');

    const ukr_post_warehouse_input = document.querySelector('#ukr_post_warehouse_input');
    const ukr_post_post_code = document.querySelector('#ukr_post_post_code');

    


    if(deliver) {
        deliver.addEventListener("change", () => {
            const deliverValue = deliver.value;
            switch(deliverValue) {
                //Вкоючаем, и выключаем поля при выборе доставки через НП 
                case "NP":
                    document.querySelector('#ukr_post_warehouse_block').classList.add('d-none');
                    document.querySelector('#ukr_post_city_block').classList.add('d-none');
                    document.querySelector('#np_city_block').classList.remove('d-none');
                    document.querySelector('#np_warehouse_block').classList.remove('d-none');

                    document.querySelector('#np_self_address_block').classList.add('d-none');
                    document.querySelector('#np_courier_warehouse_block').classList.add('d-none');


                    //Активируем вадидация для поля города НП
                    document.querySelector('#np_city_input').setAttribute("data-require", "true");
                    document.querySelector('#np_city_input').setAttribute("data-max", "255");

                    //Активируем вадидация для поля Отделений НП
                    document.querySelector('#warehouse_input').setAttribute("data-require", "true");
                    document.querySelector('#warehouse_input').setAttribute("data-max", "255");

                    //Деактивируем валидацию из других полей
                    document.querySelector('#np_self_address_input').removeAttribute("data-require", "true");
                    document.querySelector('#np_self_address_input').removeAttribute("data-max", "255");

                    document.querySelector('#np_courier_warehouse_block').removeAttribute("data-require", "true");
                    document.querySelector('#np_courier_warehouse_block').removeAttribute("data-max", "255");

                    
                    document.querySelector('#ukr_post_city').removeAttribute("data-require", "true");
                    document.querySelector('#ukr_post_city').removeAttribute("data-max", "255");
                    document.querySelector('#ukr_post_warehouse_input').removeAttribute("data-require", "true");
                    document.querySelector('#ukr_post_warehouse_input').removeAttribute("data-max", "255");


                    break;
                //Вкоючаем, и выключаем поля при выборе доставки через НП Курьер
                case "NP_COURIER":
                    document.querySelector('#ukr_post_warehouse_block').classList.add('d-none');
                    document.querySelector('#ukr_post_city_block').classList.add('d-none');
                    document.querySelector('#np_city_block').classList.remove('d-none');
                    document.querySelector('#np_courier_warehouse_block').classList.remove('d-none');
                    document.querySelector('#np_warehouse_block').classList.add('d-none');
                    document.querySelector('#np_self_address_block').classList.add('d-none');

                    //Активируем вадидация для поля города НП при выборе курьера
                    document.querySelector('#np_city_input').setAttribute("data-require", "true");
                    document.querySelector('#np_city_input').setAttribute("data-max", "255");

                    //Активируем вадидация для поля Адрес курьер НП
                    document.querySelector('#np_courier_address').setAttribute("data-require", "true");
                    document.querySelector('#np_courier_address').setAttribute("data-max", "255");

                    //Деактивируем валидацию из других полей
                    document.querySelector('#warehouse_input').removeAttribute("data-require", "true");
                    document.querySelector('#warehouse_input').removeAttribute("data-max", "255");

                    document.querySelector('#np_self_address_input').removeAttribute("data-require", "true");
                    document.querySelector('#np_self_address_input').removeAttribute("data-max", "255");
                    

                    
                    document.querySelector('#ukr_post_city').removeAttribute("data-require", "true");
                    document.querySelector('#ukr_post_city').removeAttribute("data-max", "255");
                    document.querySelector('#ukr_post_warehouse_input').removeAttribute("data-require", "true");
                    document.querySelector('#ukr_post_warehouse_input').removeAttribute("data-max", "255");


                    break;
                //Вкоючаем, и выключаем поля при выборе доставки через НП Отделения
                case "WAREHOUSE_REMOVAL":
                    document.querySelector('#ukr_post_warehouse_block').classList.add('d-none');
                    document.querySelector('#ukr_post_city_block').classList.add('d-none');
                    document.querySelector('#np_city_block').classList.add('d-none');
                    document.querySelector('#np_courier_warehouse_block').classList.add('d-none');
                    document.querySelector('#np_warehouse_block').classList.add('d-none');
                    document.querySelector('#np_self_address_block').classList.add('d-none');

                    //Деактивируем валидацию из других полей
                    document.querySelector('#warehouse_input').removeAttribute("data-require", "true");
                    document.querySelector('#warehouse_input').removeAttribute("data-max", "255");

                    document.querySelector('#np_self_address_input').removeAttribute("data-require", "true");
                    document.querySelector('#np_self_address_input').removeAttribute("data-max", "255");

                    document.querySelector('#np_city_input').removeAttribute("data-require", "true");
                    document.querySelector('#np_city_input').removeAttribute("data-max", "255");

                    document.querySelector('#np_courier_address').removeAttribute("data-require", "true");
                    document.querySelector('#np_courier_address').removeAttribute("data-max", "255");

                    
                    document.querySelector('#ukr_post_city').removeAttribute("data-require", "true");
                    document.querySelector('#ukr_post_city').removeAttribute("data-max", "255");
                    document.querySelector('#ukr_post_warehouse_input').removeAttribute("data-require", "true");
                    document.querySelector('#ukr_post_warehouse_input').removeAttribute("data-max", "255");

                    
                    break;
                case "SELF_DELIVERY":
                    document.querySelector('#ukr_post_warehouse_block').classList.add('d-none');
                    document.querySelector('#ukr_post_city_block').classList.add('d-none');

                    document.querySelector('#np_city_block').classList.add('d-none');
                    document.querySelector('#np_courier_warehouse_block').classList.add('d-none');
                    document.querySelector('#np_warehouse_block').classList.add('d-none');
                    document.querySelector('#np_self_address_block').classList.remove('d-none');
                    
                    
                    //Активируем валидацию для поле доставки адреса по городу

                    document.querySelector('#np_self_address_input').setAttribute("data-require", "true");
                    document.querySelector('#np_self_address_input').setAttribute("data-max", "255");

                     //Деактивируем валидацию из других полей
                    document.querySelector('#warehouse_input').removeAttribute("data-require", "true");
                    document.querySelector('#warehouse_input').removeAttribute("data-max", "255");
 
                    document.querySelector('#np_city_input').removeAttribute("data-require", "true");
                    document.querySelector('#np_city_input').removeAttribute("data-max", "255");
 
                    document.querySelector('#np_courier_address').removeAttribute("data-require", "true");
                    document.querySelector('#np_courier_address').removeAttribute("data-max", "255");

                    document.querySelector('#ukr_post_city').removeAttribute("data-require", "true");
                    document.querySelector('#ukr_post_city').removeAttribute("data-max", "255");
                    document.querySelector('#ukr_post_warehouse_input').removeAttribute("data-require", "true");
                    document.querySelector('#ukr_post_warehouse_input').removeAttribute("data-max", "255");
  

                    break;
                case "UKRPOSHTA": 
                    document.querySelector('#np_city_block').classList.add('d-none');
                    document.querySelector('#np_courier_warehouse_block').classList.add('d-none');
                    document.querySelector('#np_warehouse_block').classList.add('d-none');
                    document.querySelector('#np_self_address_block').classList.add('d-none');

                    document.querySelector('#ukr_post_city_block').classList.remove('d-none');
                    document.querySelector('#ukr_post_warehouse_block').classList.remove('d-none');
                

                    //Активируем вадидация для поля города  при выборе Укрпочты
                    document.querySelector('#ukr_post_city').setAttribute("data-require", "true");
                    document.querySelector('#ukr_post_city').setAttribute("data-max", "255");

                    //Активируем вадидация для поля отделения Укрпочты
                    document.querySelector('#ukr_post_warehouse_input').setAttribute("data-require", "true");
                    document.querySelector('#ukr_post_warehouse_input').setAttribute("data-max", "255");



                    //Деактивируем валидацию из других полей
                    document.querySelector('#np_city_input').removeAttribute("data-require", "true");
                    document.querySelector('#np_city_input').removeAttribute("data-max", "255");
                    document.querySelector('#warehouse_input').removeAttribute("data-require", "true");
                    document.querySelector('#warehouse_input').removeAttribute("data-max", "255");
 
                    document.querySelector('#np_self_address_input').removeAttribute("data-require", "true");
                    document.querySelector('#np_self_address_input').removeAttribute("data-max", "255");
 
                    document.querySelector('#np_courier_warehouse_block').removeAttribute("data-require", "true");
                    document.querySelector('#np_courier_warehouse_block').removeAttribute("data-max", "255");
                break;

                case "":
                    document.querySelector('#np_city_block').classList.add('d-none');
                    document.querySelector('#np_courier_warehouse_block').classList.add('d-none');
                    document.querySelector('#np_warehouse_block').classList.add('d-none');
                    document.querySelector('#np_self_address_block').classList.add('d-none');

                    document.querySelector('#ukr_post_city_block').classList.add('d-none');

                    document.querySelector('#ukr_post_city_block').classList.add('d-none');
                    document.querySelector('#ukr_post_warehouse_block').classList.add('d-none');
                    
                    break;
            }
        })
    }
    if(ukr_post_city) {
        resusltCityUkrPost.onclick =  function(event) {
        
            const fullText = event.target.textContent.trim(); // Получаем полный текст из <li> и удаляем лишние пробелы
            const idCity = event.target.dataset.id;
            ukr_post_city.value = fullText;
            ukr_post_id_city.value=idCity;
            ukr_post_warehouse_input.value = "";
            document.querySelector('.resusltCityUkrPost').classList.add('d-none');
            ukr_post_warehouse_input.removeAttribute("readonly");

           

        };

        ukr_post_city.addEventListener('input', function() {
            // warehouse_input.value = "";
            ukr_post_warehouse_input.value = "";
            ukr_post_post_code.value="";
            const asyncSearchCityUkrPost = setTimeout(async () => {
                try {
                    const response = await axios.post('/ukrpost/getCity', {
                        city: this.value,
                    });
                 
                    if(response['data'].length != 0) {
                        renderCityUkrPost(response)
                    }
                    
                    
                   
                } catch (error) {
                    console.log(error);
                }
            },500);
        })

        function toHtmlCityUkrPost(ukr) {
            return `<li class="py-2" data-id="${ukr.city_id}">${ukr.city_name}</li>`
        }
        function renderCityUkrPost(response = []) {
            document.querySelector('.resusltCityUkrPost').classList.remove('d-none');
            const html = Array.isArray(response['data']) ? response['data'].map(toHtmlCityUkrPost).join('') : '';
            resusltCityUkrPost.innerHTML = html;
            
        }
        
    }
    if(ukr_post_warehouse_input) { 
        ukr_post_warehouse_input.addEventListener('input', function() {
            ukr_post_post_code.value="";
            const asyncSearchWarehouseUkrPost = async () => {
                //console.log(ukr_post_id_city.value)
                try {
                    const response = await axios.post('/ukrpost/getWarehouse', {
                        city: ukr_post_id_city.value,
                        address: this.value,
                    });
                    //console.log(response);
                    if(response['data'].length != 0) {
                        console.log(response['data'])
                        renderWarehouseUkrPost(response)
                    }
                    
                   
                } catch (error) {
                    console.log(error);
                }
            };
            asyncSearchWarehouseUkrPost()
        })

        function toHtmlWarehouseUkrPost(ukr) {
            return `<li class="py-2" data-postindex="${ukr.postindex}">${ukr.address}</li>`
        }
        function renderWarehouseUkrPost(response = []) {
            document.querySelector('.resusWarehouseUkrPost').classList.remove('d-none');
            const html = Array.isArray(response['data']) ? response['data'].map(toHtmlWarehouseUkrPost).join('') : '';
            resusltWarehouseUkrPost.innerHTML = html;
            
        }  

        resusltWarehouseUkrPost.onclick =  function(event) {
        
            const fullText = event.target.textContent.trim(); // Получаем полный текст из <li> и удаляем лишние пробелы
            const postindex = event.target.dataset.postindex;
            ukr_post_warehouse_input.value = fullText;
            ukr_post_post_code.value=postindex;
           // warehouse_input.value = "";
            document.querySelector('.resusWarehouseUkrPost').classList.add('d-none');
            ukr_post_warehouse_input.setAttribute("readonly",true);
           

        };
    }



    if(np_city_input) {

        clear_city_np.onclick =  function() {
            np_city_input.value = "";
            warehouse_input.value = "";
            warehouse_input.setAttribute("readonly", true);
        }
        
        np_city_input.addEventListener('input', function() {
            warehouse_input.value = "";
            const asyncSearchCity = async () => {
                try {
                    const response = await axios.post('/novaposhta/getCity', {
                        city: this.value,
                    });
                 
                    if(response['data'].length != 0) {
                        renderCityNp(response)
                    }
                    
                    
                   
                } catch (error) {
                    console.log(error);
                }
            };
            asyncSearchCity()
        })
        function renderCityNp(response = []) {
            document.querySelector('.resusltCityNp').classList.remove('d-none');
            const html = Array.isArray(response['data']) ? response['data'].map(toHtmlCityNp).join('') : '';
            resusltCityNp.innerHTML = html;
            
        }   
        
        

        resusltCityNp.onclick =  function(event) {
        
            const fullText = event.target.textContent.trim(); // Получаем полный текст из <li> и удаляем лишние пробелы
            const ref = event.target.dataset.ref;
            np_city_input.value = fullText;
            city_ref_np.value=ref;
            warehouse_input.value = "";
            document.querySelector('.resusltCityNp').classList.add('d-none');
            warehouse_input.removeAttribute("readonly");

           

        };
        function toHtmlCityNp(np) {
            return `<li class="py-2" data-ref="${np.Ref}">${np.Description}</li>`
        }

        
        document.addEventListener('click', function(event) {
            const resusltCityNp = document.querySelector('.resusltCityNp'); // Находим элемент resusltCityNp
        
            // Проверяем, произошел ли клик вне блока resusltCityNp
            if (!resusltCityNp.contains(event.target) && !np_city_input.contains(event.target)) {
                resusltCityNp.classList.add('d-none'); // Скрываем элемент, если клик был вне блока и вне поля ввода
            }
        });
    }
    if(warehouse_input) {
       
        clear_warehouse_np.onclick =  function() {
            warehouse_input.value = "";
        }
        warehouse_input.addEventListener('input', function() {
            
            const asyncSearchWarehouse = async () => {
                try {
                    const response = await axios.post('/novaposhta/getWarehouse', {
                        city: city_ref_np.value,
                        warehouse: this.value,
                    });
                    //console.log(response);
                    if(response['data'].length != 0) {
                        renderWarehouseNp(response)
                    }
                    
                   
                } catch (error) {
                    console.log(error);
                }
            };
            asyncSearchWarehouse()
        })
        function renderWarehouseNp(response = []) {
            console.log(Array.isArray(response['data']))
            document.querySelector('.resusWarehouseNp').classList.remove('d-none');
            const html = Array.isArray(response['data']) ? response['data'].map(toHtmlWarehouse).join('') : '';
            resusltWarehouseNp.innerHTML = html;
            
            
        }
        function toHtmlWarehouse(np) {
            return `<li class="py-2" data-ref="${np.Ref}">${np.Description}</li>`
        }
        resusltWarehouseNp.onclick = async function(event) {
            const fullText = event.target.textContent.trim(); // Получаем полный текст из <li> и удаляем лишние пробелы
            const ref = event.target.dataset.ref;
            warehouse_input.value = fullText;
            //warehouse_input.setAttribute('data-ref', ref);
            warehouse_ref_np.value = ref;
            document.querySelector('.resusWarehouseNp').classList.add('d-none');
            warehouse_input.setAttribute("readonly",true);
       

        };

        document.addEventListener('click', function(event) {
            const resusWarehouseNp = document.querySelector('.resusWarehouseNp'); // Находим элемент resusltCityNp
        
            // Проверяем, произошел ли клик вне блока resusltCityNp
            if (!resusWarehouseNp.contains(event.target) && !warehouse_input.contains(event.target)) {
                resusWarehouseNp.classList.add('d-none'); // Скрываем элемент, если клик был вне блока и вне поля ввода
            }
        });
       
    }

    const pay_method = document.querySelector('#pay_method');
    if(pay_method) {
        pay_method.addEventListener("change", () => {
            const payMethodValue = pay_method.value;
            switch(payMethodValue) {
                //Включаем, и выключаем блок при выборе оплаты частями
                case "INSTALLMENT_PRIVATBANK":
                    document.querySelector('#privatbank_installment_block').classList.remove('d-none');
                    document.querySelector('#block_legal_acount').classList.add('d-none');
                    document.querySelector('#block_individual_acount').classList.add('d-none');


                    
                    document.querySelector('#edrpu_legal').removeAttribute("data-require", "true");
                    document.querySelector('#full_name_legal').removeAttribute("data-require", "true");
                    document.querySelector('#fullName_acount').removeAttribute("data-require", "true");
                    document.querySelector('#tin_acount').removeAttribute("data-require", "true");
                    
                    break;
                //Включаем, и выключаем блок при выборе оплаты при получение товара
                case "RECEIPT_OF_GOODS":
                    document.querySelector('#privatbank_installment_block').classList.add('d-none');
                    document.querySelector('#block_legal_acount').classList.add('d-none');
                    document.querySelector('#block_individual_acount').classList.add('d-none');

                    document.querySelector('#edrpu_legal').removeAttribute("data-require", "true");
                    document.querySelector('#full_name_legal').removeAttribute("data-require", "true");
                    document.querySelector('#fullName_acount').removeAttribute("data-require", "true");
                    document.querySelector('#tin_acount').removeAttribute("data-require", "true");

                    break;
                //Включаем, и выключаем блок при выборе оплаты Liqpay
                case "LIQPAY":
                    document.querySelector('#privatbank_installment_block').classList.add('d-none');
                    document.querySelector('#block_legal_acount').classList.add('d-none');
                    document.querySelector('#block_individual_acount').classList.add('d-none');

                    document.querySelector('#edrpu_legal').removeAttribute("data-require", "true");
                    document.querySelector('#full_name_legal').removeAttribute("data-require", "true");
                    document.querySelector('#fullName_acount').removeAttribute("data-require", "true");
                    document.querySelector('#tin_acount').removeAttribute("data-require", "true");

                    break;
                case "LEGAL_ACCOUNT_CURRENT":
                    document.querySelector('#block_legal_acount').classList.remove('d-none');
                    document.querySelector('#privatbank_installment_block').classList.add('d-none');
                    document.querySelector('#block_individual_acount').classList.add('d-none');

                    document.querySelector('#edrpu_legal').setAttribute("data-require", "true");
                    document.querySelector('#full_name_legal').setAttribute("data-require", "true");

                    document.querySelector('#fullName_acount').removeAttribute("data-require", "true");
                    document.querySelector('#tin_acount').removeAttribute("data-require", "true");


                    break;
                case "INDIVIDUALS_ACCOUNT_CURRENT":
                    document.querySelector('#block_individual_acount').classList.remove('d-none');
                    document.querySelector('#privatbank_installment_block').classList.add('d-none');
                    document.querySelector('#block_legal_acount').classList.add('d-none');


                    document.querySelector('#fullName_acount').setAttribute("data-require", "true");
                    document.querySelector('#tin_acount').setAttribute("data-require", "true");
                    document.querySelector('#edrpu_legal').removeAttribute("data-require", "true");
                    document.querySelector('#full_name_legal').removeAttribute("data-require", "true");



                    break;

            }
        })
    }
    document.querySelectorAll('input[type="radio"][data-group="credit"]').forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.checked) {
                document.querySelectorAll(`input[type="radio"][data-group="credit"]`).forEach(el => {
                    if (el !== this) el.checked = false;
                });
            }
        });
    });
})