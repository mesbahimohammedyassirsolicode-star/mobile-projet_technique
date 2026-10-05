const apiUrl = '../backend/api/recipes.php';

const form = document.getElementById('recipe-form');
const recipeList = document.getElementById('recipe-list');
const message = document.getElementById('message');


// =========================
// GET : afficher les recettes
// =========================
function loadRecipes() {

    fetch(apiUrl)
        .then(response => response.json())
        .then(recipes => {

            recipeList.innerHTML = '';

            recipes.forEach(recipe => {

                recipeList.innerHTML += `
                    <tr>
                        <td>${recipe.id}</td>
                        <td>${recipe.titre}</td>
                        <td>${recipe.category_id}</td>
                    </tr>
                `;

            });

        })
        .catch(error => {
            message.textContent = 'Erreur de chargement';
            console.log(error);
        });
}


// =========================
// POST : ajouter une recette
// =========================
form.addEventListener('submit', function(event) {

    event.preventDefault();

    const titre = document.getElementById('titre').value;
    const category_id = document.getElementById('category_id').value;

    fetch(apiUrl, {

        method: 'POST',

        headers: {
            'Content-Type': 'application/json'
        },

        body: JSON.stringify({
            titre: titre,
            category_id: Number(category_id)
        })

    })

    .then(response => response.json())

    .then(result => {

        message.textContent = result.message;

        if (result.success) {

            form.reset();

            loadRecipes();
        }

    })

    .catch(error => {

        message.textContent = 'Erreur serveur';
        console.log(error);

    });

});


// Charger les recettes au démarrage
loadRecipes();