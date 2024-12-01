window.onload = function() {
    const lookupButton = document.getElementById('lookup');
    const resultDiv = document.getElementById('result');
    lookupButton.addEventListener('click', function() {
        // Get the country name from the input field
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
};
