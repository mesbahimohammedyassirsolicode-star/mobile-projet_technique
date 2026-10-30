const API_URL="http://localhost:8000/backend/api/Controller.php";
const tbody=document.getElementById("table-categories-body")
const form=document.getElementById("form-categorie")
const nameF=document.getElementById("cat-nom")
const descriptionF=document.getElementById("cat-desc")
const btnshowform=document.getElementById("btn-show-form")
const formSection=document.getElementById("section-form")
const btnSubmit=document.getElementById("btn-submit")
const btnTxt=document.getElementById("btn-text")


function showrecipes(){
fetch(API_URL)
.then(response=>response.json())
.then(recipes=>{
    tbody.innerHTML=""
    recipes.forEach(recipe => {
        tbody.innerHTML+=`
        <tr>
            <td class="p-4 text-sm font-semibold text-gray-500">${recipe.name}</td>
            <td class="p-4 text-sm font-semibold text-gray-500">${recipe.description}</td>
        
        </tr>`
        
    });
})
}
function showtoast(message, type="success")
{
    const container=document.getElementById("toast-container");
    const toast=document.createElement('div');
    toast.classname='toast toast-${type}';
    toast.textContent=message;
    container.appendChild(toast);
    setTimeout(()=>{
        toast.remove();
    },3000)
    
}
form.addEventListener("submit",function(e){
    e.preventDefault();
    const data={
        name:nameF.value,
        description:descriptionF.value,
        
    }
    fetch(API_URL,{
        method:"POST",
        headers:{"Content-Type": "application/json"},
        body:JSON.stringify(data)

    }
)
.then(response=>response.json())
.then(()=>{
    form.reset()
    showrecipes();
    showtoast("added","success")
})
})
document.addEventListener('DOMContentLoaded',showrecipes())
