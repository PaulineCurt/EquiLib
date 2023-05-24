    // Menu burger 
      // Récupération de l'élément du bouton de bascule du menu
      const menuBtn = document.querySelector('.navbar-toggler');
      // Récupération de l'élément du menu
      const menu = document.querySelector('.navbar-collapse');
      // Fonction qui ouvre ou ferme le menu en ajoutant ou supprimant la classe 'show'
      function toggleMenu() {
        menu.classList.toggle('show');
      }
      // Ajout d'un écouteur d'événements pour le clic sur le bouton de bascule
      menuBtn.addEventListener('click', toggleMenu);

    // ***
    // Affichage de la pop up create horse qui réapparait si il y a erreur dans la saisi du formulaire//
    
    const addHorseModal = document.getElementById('addHorseModal');
    const addHorseButton = document.getElementById('buttonAddHorse');
    if (addHorseButton.classList.contains('visible')) {
        $("#addHorseModal").modal({
          show: true
        });
        }