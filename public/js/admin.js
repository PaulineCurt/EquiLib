async function onSubmitUpdateSpecialityForm(event) {
    event.preventDefault()

    const formData = new FormData(form);
    //Récupère l'url
    const url = form.dataset.url;
    //Options de la requete
    const options = {
        method:'POST', // Methode HTTP Post
        body: formData // Stock les données du form dans le corps de la requête
    }
    
    // Envoie de la requete ajax
    const response = await fetch(url, options);
    // Recuperation des données de la réponse
    const data = await response.json();
    // Selection du td a modifier
    const td = document.getElementById('speciality-' + data.id);
    // Modification du td
    td.innerHTML= data.name;

    // Message flash
   // Si il trouve le message flash ça le supprime
    document.querySelector('.flash')?.remove();
     //Selection le main 
    //insertAdjacentHTML inserer dans un élément, afterbegin au début de l'élément
    document.querySelector('main').insertAdjacentHTML('afterbegin',`<div class="alert alert-success flash">La spécialité a été modifié avec succès.</div> `);
    
    // Ferme la pop-up 
    $('#editSpecialityModal').modal('hide');
}

// Code principal
const form = document.getElementById('updateSpecialityForm');
form.addEventListener('submit',onSubmitUpdateSpecialityForm);
