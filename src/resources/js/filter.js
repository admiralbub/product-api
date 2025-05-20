document.addEventListener('DOMContentLoaded', function () {
    const minThumb = document.getElementById('min-thumb');
    const maxThumb = document.getElementById('max-thumb');
    const trackHighlight = document.getElementById('track-highlight');
    const minPriceDisplay = document.getElementById('min-price');
    const maxPriceDisplay = document.getElementById('max-price');
    const track = document.querySelector('.slider-track');
    if(minPriceDisplay || maxPriceDisplay) {
        // Price range configuration
        const minPrice = parseInt(minPriceDisplay.dataset.min, 10) || 0;
        const maxPrice = parseInt(maxPriceDisplay.dataset.max, 10) || 1000;
        let currentMinPrice = minPrice;
        let currentMaxPrice = maxPrice;

        // Initial positioning
        setThumbPositionFromValue(minThumb, minPrice, minPrice, maxPrice);
        setThumbPositionFromValue(maxThumb, maxPrice, minPrice, maxPrice);
        updateTrackHighlight();
        updateInputs();

        // Thumb drag
        minThumb.addEventListener('mousedown', function (e) {
            e.preventDefault();
            document.addEventListener('mousemove', moveMinThumb);
            document.addEventListener('mouseup', stopDrag);
        });

        maxThumb.addEventListener('mousedown', function (e) {
            e.preventDefault();
            document.addEventListener('mousemove', moveMaxThumb);
            document.addEventListener('mouseup', stopDrag);
        });

        function moveMinThumb(e) {
            const trackRect = track.getBoundingClientRect();
            let position = (e.clientX - trackRect.left) / trackRect.width;
            position = Math.max(0, Math.min(parseFloat(maxThumb.style.left) / 100, position));

            minThumb.style.left = position * 100 + '%';
            currentMinPrice = Math.round(minPrice + position * (maxPrice - minPrice));
            updateInputs();
            updateTrackHighlight();
        }

        function moveMaxThumb(e) {
            const trackRect = track.getBoundingClientRect();
            let position = (e.clientX - trackRect.left) / trackRect.width;
            position = Math.max(parseFloat(minThumb.style.left) / 100, Math.min(1, position));

            maxThumb.style.left = position * 100 + '%';
            currentMaxPrice = Math.round(minPrice + position * (maxPrice - minPrice));
            updateInputs();
            updateTrackHighlight();
        }

        function stopDrag() {
            document.removeEventListener('mousemove', moveMinThumb);
            document.removeEventListener('mousemove', moveMaxThumb);
        }

        function updateTrackHighlight() {
            const minPosition = parseFloat(minThumb.style.left);
            const maxPosition = parseFloat(maxThumb.style.left);

            trackHighlight.style.left = minPosition + '%';
            trackHighlight.style.width = (maxPosition - minPosition) + '%';
        }

        function updateInputs() {
            minPriceDisplay.value = '' + currentMinPrice;
            maxPriceDisplay.value = '' + currentMaxPrice;
        }

        function setThumbPositionFromValue(thumb, value, min, max) {
            let percentage = ((value - min) / (max - min)) * 100;
            thumb.style.left = percentage + '%';
        }

        function sanitizeInput(value) {
            return parseInt(value.replace(/[^0-9]/g, '')) || minPrice;
        }

        // Listen for input field changes
        minPriceDisplay.addEventListener('change', function () {
            let val = sanitizeInput(minPriceDisplay.value);
            val = Math.max(minPrice, Math.min(val, currentMaxPrice - 1)); // нельзя больше max
            currentMinPrice = val;
            setThumbPositionFromValue(minThumb, val, minPrice, maxPrice);
            updateTrackHighlight();
            updateInputs();
        });

        maxPriceDisplay.addEventListener('change', function () {
            let val = sanitizeInput(maxPriceDisplay.value);
            val = Math.min(maxPrice, Math.max(val, currentMinPrice + 1)); // нельзя меньше min
            currentMaxPrice = val;
            setThumbPositionFromValue(maxThumb, val, minPrice, maxPrice);
            updateTrackHighlight();
            updateInputs();
        });
    }
    
});