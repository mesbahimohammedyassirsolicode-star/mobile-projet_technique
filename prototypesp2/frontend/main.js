// This file controls the page without reloading it (single-page app behavior).
const apiUrl = '../backend/api/recipes.php';
const categoryNames = { 1: 'Entrée', 2: 'Plat principal', 3: 'Dessert' };

const form = document.getElementById('recipe-form');
const message = document.getElementById('message');
const recipeList = document.getElementById('recipe-list');

function showMessage(text, success) {
    message.textContent = text;
    message.className = `rounded-md px-3 py-2 text-sm ${success ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700'}`;
}

// Get recipes from the PHP API and update the table without reloading the page.
async function loadRecipes() {
    try {
        const response = await fetch(apiUrl);
        if (!response.ok) throw new Error('Chargement impossible.');

        const recipes = await response.json();
        recipeList.replaceChildren();

        if (recipes.length === 0) {
            const row = document.createElement('tr');
            const cell = document.createElement('td');
            cell.colSpan = 3;
            cell.className = 'px-3 py-4 text-center text-slate-500';
            cell.textContent = 'Aucune recette pour le moment.';
            row.appendChild(cell);
            recipeList.appendChild(row);
            return;
        }

        recipes.forEach((recipe) => {
            const row = document.createElement('tr');
            row.className = 'border-b border-slate-100';
            [recipe.id, recipe.titre, categoryNames[recipe.category_id] || 'Inconnue'].forEach((value) => {
                const cell = document.createElement('td');
                cell.className = 'px-3 py-2';
                cell.textContent = value;
                row.appendChild(cell);
            });
            recipeList.appendChild(row);
        });
    } catch (error) {
        showMessage(error.message, false);
    }
}

// Submit the form to the API and refresh the table without leaving this page.
form.addEventListener('submit', async (event) => {
    event.preventDefault();
    const formData = new FormData(form);

    try {
        const response = await fetch(apiUrl, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                titre: formData.get('titre'),
                category_id: Number(formData.get('category_id'))
            })
        });
        const result = await response.json();
        showMessage(result.message, response.ok && result.success);

        if (response.ok && result.success) {
            form.reset();
            await loadRecipes();
        }
    } catch (error) {
        showMessage('Impossible de contacter le serveur PHP.', false);
    }
});

// Fill the table when the page first opens.
loadRecipes();
