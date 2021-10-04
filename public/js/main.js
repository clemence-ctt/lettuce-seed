console.log('%cmain.js loaded', 'color: #f00; font-size: 2rem');


let userTheme = 'default';
const stylesheet = document.createElement('link');
stylesheet.setAttribute('rel', 'stylesheet');
stylesheet.setAttribute('href', 'http://localhost/lettuce-seed/public/css/themes/_' + userTheme + '.css');
document.querySelector('head').appendChild(stylesheet);


function createPictureForm()
{
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
        const onPlantsList = document.querySelector('#plants-list-container');
        if(onPlantsList) {
            $('#plants-list-container').DataTable({
                "order": [[ 0, "desc" ]]
            });
        }
        

        const createPictureFormElement = document.querySelector('#picture_plants');
        if(createPictureFormElement) {
            createPictureForm();
        }

    });
})



(function(){
 
    function removeAccents ( data ) {
        if ( data.normalize ) {
            // Use I18n API if avaiable to split characters and accents, then remove
            // the accents wholesale. Note that we use the original data as well as
            // the new to allow for searching of either form.
            return data +' '+ data
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '');
        }
     
        return data;
    }
     
    var searchType = jQuery.fn.DataTable.ext.type.search;
     
    searchType.string = function ( data ) {
        return ! data ?
            '' :
            typeof data === 'string' ?
                removeAccents( data ) :
                data;
    };
     
    searchType.html = function ( data ) {
        return ! data ?
            '' :
            typeof data === 'string' ?
                removeAccents( data.replace( /<.*?>/g, '' ) ) :
                data;
    };
     
    }());