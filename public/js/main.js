console.log('%cmain.js loaded', 'color: #f00; font-size: 2rem');


function createPictureForm() {
    //JK console.log('%c' + 'FORM', 'color: #f00; font-size: 1rem;'); 

    // TIPS JS GLOBAL - micro regex ; g=global to carry on after the first match ; 
    // encapsulating the checkbox & its label in a "choice" div to apply CSS
    let list = document.querySelector('#picture_plants');
    let content = list.innerHTML;
    content = content.replace(/<input/g, '<div class="choice"><input');
    content = content.replace(/<\/label>/g, '</label></div>' + "\n");

    list.innerHTML = content;

    console.log("Initliaze list");

    document.querySelectorAll('.choice').forEach((element, index) => {
        const checkbox = element.querySelector('input');
        const label = element.querySelector('label');

        if (checkbox.checked) {
            label.classList.add('checked');
        }


        element.addEventListener('click', (event) => {

            event.preventDefault();

            const element = event.currentTarget;
            let button = null;
            button = element.closest('.choice');

            const checkbox = button.querySelector('input');
            const label = button.querySelector('label');

            if (checkbox.checked) {
                checkbox.checked = false;
                label.classList.remove('checked');
                console.log("uncheck");
            } else {
                checkbox.checked = true;
                label.classList.add('checked');
            }

        });
    });


}


document.addEventListener('DOMContentLoaded', function () {
    // STEP DATATABLE initializing datatable on element
    $(document).ready(function () {
        const onPlantsList = document.querySelector('#plants-list-container');
        if (onPlantsList) {
            $('#plants-list-container').DataTable({
                "order": [
                    [0, "desc"]
                ]
            });
        }

        const createPictureFormElement = document.querySelector('#picture_plants');
        if (createPictureFormElement) {
            createPictureForm();
        }

    });
})

