<!DOCTYPE html>
<html>
<head>
    <title>Service Finder</title>
</head>
<body>

<h2>🔍 Enter Pincode or City</h2>

<input type="text" id="search" placeholder="Enter pincode or city">
<button onclick="checkService()">Search</button>

<h3 id="result"></h3>

<script>
function checkService() {
    let search = document.getElementById('search').value;

    fetch(`/check-services?search=${search}`)
        .then(res => res.json())
        .then(data => {
            let result = document.getElementById('result');

            if (data.available) {
                result.innerHTML = "✅ Services: " + data.services.join(', ');
            } else {
                result.innerHTML = data.message;
            }
        });
}
</script>

</body>
</html>