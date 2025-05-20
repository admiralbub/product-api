document.body.addEventListener('click', function(e) {
    if (e.target && e.target.id === 'LoadProduct') {
        const loadButton = e.target;
        const url = loadButton.getAttribute('data-url');

        fetch(url + "&ajax=1")
            .then(response => response.json())
            .then(data => {
                document.querySelector('.getProductAjax').insertAdjacentHTML('beforeend', data.success);
                loadButton.setAttribute('data-url', data.page_next);
                document.getElementById('pagination_products').innerHTML = data.pagination;

                if (data.page_next) {
                    loadButton.style.display = 'inline-block';
                } else {
                    loadButton.style.display = 'none';
                }
            })
            .catch(error => {
                console.error('Ошибка при загрузке продуктов:', error);
            });
    }
});