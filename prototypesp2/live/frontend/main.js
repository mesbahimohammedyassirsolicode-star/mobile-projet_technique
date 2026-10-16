const apiUrl = 'http://localhost:8000/backend/api/api.php';
const form = document.getElementById('form-categorie');
const tbody = document.getElementById('table-categories-body');
const name = document.getElementById('cat-nom');
const categories = document.getElementById('cat-cate');

function loadCategories() {
    fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
            tbody.innerHTML = '';

            data.forEach(category => {
                tbody.innerHTML += `
                    <tr>
                        <td>${category.id}</td>
                        <td>${category.name}</td>
                        <td>${category.categorie}</td>
                    </tr>
                `;
            });
        })
}


form.addEventListener('submit', function(event) {
    event.preventDefault();

    fetch(apiUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        
        body: JSON.stringify({
            name: name.value,
            categorie: categories.value
        })
    })
    .then(response => response.json())
    .then(result => {
        console.log(result);

        form.reset();
        loadCategories();
    })
});

loadCategories();
