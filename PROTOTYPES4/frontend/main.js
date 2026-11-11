const API_URL="http://localhost:8000/backend/api/Controller.php";
const tbody=document.getElementById("table-categories-body")
const form=document.getElementById("form-categorie")
const nameF=document.getElementById("cat-nom")
const descriptionF=document.getElementById("cat-desc")
const btnshowform=document.getElementById("btn-show-form")
const formSection=document.getElementById("section-form")
const btnSubmit=document.getElementById("btn-submit")
const btnTxt=document.getElementById("btn-text")
const spinner=document.getElementById("spinner")






function showrecipes(){
fetch(API_URL)
.then(parseResponse)
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
.catch(error => showToast(error.message, "error"))
}

function parseResponse(response) {
    return response.text().then(text => {
        let data;
        try {
            data = JSON.parse(text);
        } catch {
            throw new Error("Le serveur a renvoyé une réponse invalide.");
        }
        if (!response.ok) {
            throw new Error(data.error || "La requête a échoué.");
        }
        return data;
    });
}


function showToast(message,type="success"){
    const container=document.getElementById("toast-container")
    const toast=document.createElement("div")
    toast.classList="p-5 m-4 rounded "


    if(type=="success"){
        toast.classList.add("bg-green-500")

    }else{
          toast.classList.add("bg-red-500")
    }
    toast.textContent=message;
    container.appendChild(toast)
    setTimeout(()=>{
        toast.remove()

    },3000)
}

form.addEventListener("submit",function(e){
    e.preventDefault();
    const data={
        name:nameF.value,
        description:descriptionF.value
    }
    spinner.classList.remove("hidden")
    btnTxt.textContent="Enregistrer en cours..."
    btnSubmit.disabled=true

    fetch(API_URL,{
        method:"POST",
        headers:{
            "Content-Type":"application/json"

        },
        body:JSON.stringify(data)   
    })
    .then(parseResponse)
    .then(()=>{
        showToast("added success","success")
        form.reset()
        showrecipes()
    }).catch(error=>{
        showToast(error.message,"error")
    }).finally(()=>{
        spinner.classList.add("hidden")
    })

})

btnshowform.addEventListener("click",function(){
    formSection.classList.remove("hidden")
    btnTxt.textContent="Enregistrer"
    btnSubmit.disabled=false

})

document.getElementById("btn-cancel-form").addEventListener("click", function(){
    formSection.classList.add("hidden")
    form.reset()
})

document.addEventListener("DOMContentLoaded", showrecipes)