console.log('%cmain.js loaded', 'color: #f00; font-size: 2rem');


let userTheme = 'default';
const stylesheet = document.createElement('link');
stylesheet.setAttribute('rel', 'stylesheet');
stylesheet.setAttribute('href', 'http://localhost/lettuce-seed/public/css/themes/_' + userTheme + '.css');
document.querySelector('head').appendChild(stylesheet);

    
    // TIPS JS GLOBAL micro regex ; g=global sinon il s'arrête à la première occurence ; en gros on encapsule la tickbox et son label dans une div "choice" pour les css-er
function createPictureForm()
{
    console.log('%c' + 'FORM', 'color: #0bf; font-size: 1rem; background-color:#fff');
    
    let list = document.querySelector('#picture_plants');
    let content = list.innerHTML;
    content = content.replace(/<input/g, '<div class="choice"><input');
    content = content.replace(/<\/label>/g, '</label></div>' + "\n");
    
    list.innerHTML = content;

    console.log("Initliaze list");

    document.querySelectorAll('.choice').forEach((element, index) => {
        const checkbox = element.querySelector('input');
        const label =  element.querySelector('label');

        if(checkbox.checked) {
            label.classList.add('checked');
        }


        element.addEventListener('click', (event) => {

            event.preventDefault();

            const element = event.currentTarget;
            let button = null;
            button = element.closest('.choice');
            
            const checkbox = button.querySelector('input');
            const label = button.querySelector('label');

            if(checkbox.checked) {
                checkbox.checked = false;
                label.classList.remove('checked');
                console.log("uncheck");
            }
            else {
                checkbox.checked = true;
                label.classList.add('checked');
            }

        });
    });


}





document.addEventListener('DOMContentLoaded', function() {
    // TIPS DATATABLE initializing datatable on element
    $(document).ready( function () {
        const onPlantsList = document.querySelector('#plants-list');
        if(onPlantsList) {
            $('#plants-list').DataTable();
        }
        

        const createPictureFormElement = document.querySelector('#picture_plants');
        if(createPictureFormElement) {
            createPictureForm();
        }

    });
})