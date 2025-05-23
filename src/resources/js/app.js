import './bootstrap';
import * as bootstrap from 'bootstrap'
import Alert from 'bootstrap/js/dist/alert';

// or, specify which plugins you need:
import { Tooltip, Toast, Popover } from 'bootstrap';

const catalog_menu = document.querySelector('.catalog-mob');
const open_mob = document.querySelector('.open-mob-menu');
const open_mob_close = document.querySelector('.catalog-mob--close');
const category_open_mob = document.querySelector('#menu_categeryMob-open'); 
const categor_mob = document.querySelector('#categor_mob'); 

const button_submenu_mob = document.querySelectorAll('.button-submenu_click');



//const quantity = document.querySelector('.quantity');



const search_block = document.querySelector('.search_block');
const search_descktop = document.querySelector('#search_descktop');


const search_mob = document.querySelector('#search_mob');
const search_block_mob = document.querySelector('.search_block_mob');

if(open_mob) {
    open_mob.addEventListener('click',  function() {
        catalog_menu.classList.add("open");
    })
}
if(open_mob_close) {
    open_mob_close.addEventListener('click',  function() {
        catalog_menu.classList.remove("open");
    })
}
if(category_open_mob) {
    category_open_mob.addEventListener('click',  function() {
        categor_mob.style.display = categor_mob.style.display === "block" ? "none" : "block";
        
    })
}

button_submenu_mob.forEach(button => {
    button.addEventListener('click', function(event) {
        // Получаем data-id нажатой кнопки
        const dataId = this.getAttribute('data-id');
        const submenu_mob = document.querySelector('#submenu_mob'+dataId);
        submenu_mob.style.display = submenu_mob.style.display === "block" ? "none" : "block";
        this.classList.toggle("active_icon_sub");
        
    });
});
//Fixed desctop navbar

/*if(quantity) {
    //Увеличить количество товара
    quantity.onclick = function(event) {
        if (event.target.closest('.minus')) {
            const qty = event.target.closest('.quantity').querySelector('.qty');
        
            let quantity = parseInt(qty.value);
            
            if (quantity > 1) { // Предотвращаем уменьшение ниже 1
                quantity--;
                qty.value = quantity;
            }
            document.querySelector('#quantity-input').value =qty.value;
        }
        if (event.target.closest('.plus')) {
            const qty = event.target.closest('.quantity').querySelector('.qty');
        
            let quantity = parseInt(qty.value);
        
            quantity++;
            qty.value = quantity;
            document.querySelector('#quantity-input').value =qty.value;
        }
    }
}*/
document.addEventListener('DOMContentLoaded', function() {
    const display = document.querySelector('.quantity-controls__display');
    if(display) {
        const incrementBtn = document.querySelector('.quantity-controls__controls .increment');
        const decrementBtn = document.querySelector('.quantity-controls__controls .decrement');
        let count = 1;
        
        incrementBtn.addEventListener('click', function() {
            count++;
            display.value = count;
        });
        
        decrementBtn.addEventListener('click', function() {
            if (count > 1) {
                count--;
                display.value = count;
            }
        });
    }
});   
if(search_mob) {
    search_mob.addEventListener('input', function() {
        const asyncSearchProductMob = async () => {
            try {
                const lang = document.documentElement.getAttribute('lang') === 'ru' ? '/ru' : '';
                const response = await axios.post(lang + '/search_ajax', {
                    query: this.value,
                });
                if(response['data'].length != 0) {
                    renderProductSearchMob(response)
                }
                
                
               
            } catch (error) {
                console.log(error);
            }
        };
        if(this.value.length > 1) {
            asyncSearchProductMob()
        }
        
    })
    function renderProductSearchMob(response = []) {
        document.querySelector('.search_block_mob').classList.remove('d-none');
        const html = Array.isArray(response['data']) ? response['data'].map(toHtmlProductMob).join('') : '';
        search_block_mob.innerHTML = html;
        
    }
    document.addEventListener('click', function(event) {
        const search_block_mob = document.querySelector('.search_block_mob'); // Находим элемент resusltCityNp
    
        // Проверяем, произошел ли клик вне блока resusltCityNp
        if (!search_block_mob.contains(event.target) && !search_block_mob.contains(event.target)) {
            search_block_mob.classList.add('d-none'); // Скрываем элемент, если клик был вне блока и вне поля ввода
        }
    });
    function toHtmlProductMob(pr) {
        return `<div class="search-item py-3 px-4">
            <a href="/product/${pr.slug}" class="d-flex">
                <div>
                    <img src="${pr.image}" width="60px">
                </div>
                <div class="px-3 py-1">
                    ${pr.name}
                    <div class="py-1">
                        <span class="fw-bold">${pr.price} грн.</span>
                    </div>
                </div>
              
            </a>
        </div>`
    }
}   



if(search_descktop) {
    console.log(document.documentElement.getAttribute('lang'))
    search_descktop.addEventListener('input', function() {
        const asyncSearchProductDescktop = async () => {
            try {
                const lang = document.documentElement.getAttribute('lang') === 'ru' ? '/ru' : '';
                const response = await axios.post(lang + '/search_ajax', {
                    query: this.value,
                });
                if(response['data'].length != 0) {
                    renderProductSearch(response)
                }
                
                
               
            } catch (error) {
                console.log(error);
            }
        };
        if(this.value.length > 1) {
            asyncSearchProductDescktop()
        }
        
    })
    function renderProductSearch(response = []) {
        document.querySelector('.search_block').classList.remove('d-none');
        const html = Array.isArray(response['data']) ? response['data'].map(toHtmlProduct).join('') : '';
        search_block.innerHTML = html;
        
    }
    document.addEventListener('click', function(event) {
        const search_block = document.querySelector('.search_block'); // Находим элемент resusltCityNp
    
        // Проверяем, произошел ли клик вне блока resusltCityNp
        if (!search_block.contains(event.target) && !search_descktop.contains(event.target)) {
            search_block.classList.add('d-none'); // Скрываем элемент, если клик был вне блока и вне поля ввода
        }
    });
    function toHtmlProduct(pr) {
        return `<div class="search-item py-3 px-4">
            <a href="/product/${pr.slug}" class="d-flex">
                <div>
                    <img src="${pr.image}" width="60px">
                </div>
                <div class="px-3 py-1">
                    ${pr.name}
                    <div class="py-1">
                        <span class="fw-bold">${pr.price} грн.</span>
                    </div>
                </div>
                
            </a>
        </div>`
    }
}

document.addEventListener("DOMContentLoaded", function () { 
    const navbar = document.querySelector(".navbar-menu-fixed");
    const header_mob_fixed= document.querySelector(".header-mob-fixed");
    window.addEventListener("scroll", function () {
        if (window.scrollY > 200) {
            navbar.classList.add("sticky-header");
            header_mob_fixed.classList.add("mob_fixed");

            
        } else {
            navbar.classList.remove("sticky-header");
            header_mob_fixed.classList.remove("mob_fixed");
        }
    });
});

//////
// Обработчик событий для всех чекбоксов с классом filter_attr_check
document.querySelectorAll('.filter_attr_check').forEach(checkbox => {
    checkbox.addEventListener('click', function () {
        // Получаем значение URL из атрибута value
        const url = this.value;
        // Перенаправляем пользователя по указанному URL
        window.location.href = url;
    });
});

// Обработчик событий для всех чекбоксов с классом filter_attr_check
document.querySelectorAll('.filter_brand_check').forEach(checkbox => {
    checkbox.addEventListener('click', function () {
        // Получаем значение URL из атрибута value
        const url = this.value;
        // Перенаправляем пользователя по указанному URL
        window.location.href = url;
    });
});

import './order.js'
import './field.js'
import './catalog.js'
import './basket.js'
import './credit.js'
import './filter.js'
import './slider.js'
import './mask.js'
import './wislist.js'
import './compare.js'
import './rateInf.js'
import './dunamic_load.js'
import './validation.js'

