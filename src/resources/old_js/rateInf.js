
import './rater.js'



//or for example
const ratingOptions = {
    max_value: 6,
    step_size: 0.5,
    readonly: true
};

// Инициализация при загрузке страницы
$(document).ready(function() {
    $(".rating").rate(ratingOptions);
    
    // Создаем наблюдатель за изменениями DOM
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            $(mutation.addedNodes).find('.rating').each(function() {
                $(this).rate(ratingOptions);
            });
        });
    });
    
    // Начинаем наблюдение
    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
});