const APIURL= 'http://localhost:8000/backend/api/api.php';
const form = document.getElementById('form-categorie');
const tbody= document.getElementById('table-categories-body');
const nom=document.getElementById('cat-nom');
const categorie=document.getElementById('cat-cate');


function loadrecipe()
{
fetch(APIURL)
.then(Response=>Response.json() )
.then(recipe=>{
    tbody.innerHTML='';
    recipe.forEach(rec => {
        tbody.innerHTML+=`
        <tr>
        <td>${rec.id}</td>
        <td>${rec.nom}</td>
        <td>${rec.categorie}</td>
        </tr>
        
        `
        
    });

})}
form.addEventListener('submit',function(event){

event.preventDefault();
let data ={nom:nom.value,
categorie:categorie.value }

fetch(APIURL,{
    method:'POST',
    headers:{'Content-type':'application/json'},
    body:JSON.stringify(
        data
    )
}
)
.then(Response=>Response.json())
.then(resultat=>{
loadrecipe()
form.reset()

})

})
loadrecipe()
