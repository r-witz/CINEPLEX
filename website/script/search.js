// Sélection de toutes les images dans la section des résultats
const images = document.querySelectorAll('#results img');

// Parcours de chaque image pour ajouter un écouteur d'événement de clic
images.forEach(image => {
    image.addEventListener('click', function() {
        // Si l'image cliquée n'a pas déjà la classe "selected"
        if (!this.classList.contains('selected')) {
            // Retirer la classe "selected" de l'image précédemment sélectionnée
            const previouslySelected = document.querySelector('#results .selected');
            if (previouslySelected) {
                previouslySelected.classList.remove('selected');
                previouslySelected.classList.add('not_selected');
            }

            // Ajouter la classe "selected" à l'image cliquée
            this.classList.add('selected');
            // Retirer la classe "not-selected" de l'image cliquée
            this.classList.remove('not_selected');
        }
    });
});
