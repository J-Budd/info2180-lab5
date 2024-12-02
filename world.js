window.onload = function() {
    const lookupCounButton = document.getElementById('lookup_country');
    const lookupCiButton = document.getElementById('lookup_city');
    const resultDiv = document.getElementById('result');
    
    // Lookup Country button
    lookupCounButton.addEventListener('click', function() {
        const country = document.getElementById('country').value.trim();
        resultDiv.innerHTML = 'Loading...';
        const xhr = new XMLHttpRequest();

        xhr.open('GET', 'world.php?country=' + encodeURIComponent(country), true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                resultDiv.innerHTML = xhr.responseText;
            } else {
                resultDiv.innerHTML = 'Error: Unable to fetch data.';
            }
        };
        xhr.send();
    });

    // Lookup Cities button
    lookupCiButton.addEventListener('click', function() {
        const country = document.getElementById('country').value.trim();
        if (!country) {
            resultDiv.innerHTML = 'Please enter a country name.';
            return;
        }
        resultDiv.innerHTML = 'Loading...';
        const xhs = new XMLHttpRequest();

        xhs.open('GET', 'world.php?country=' + encodeURIComponent(country) + '&lookup=cities', true);
        xhs.onload = function() {
            if (xhs.status === 200) {
                resultDiv.innerHTML = xhs.responseText;
            } else {
                resultDiv.innerHTML = 'Error: Unable to fetch data.';
            }
        };
        xhs.send();
    });
};
