console.log('%cmain.js loaded', 'color: #f00; font-size: 2rem');

document.addEventListener('DOMContentLoaded', function() {
    // TIPS DATATABLE initializing datatable on element
    $(document).ready( function () {
        const onPlantsList = document.querySelector('#plants-list');
        if(onPlantsList) {
            $('#plants-list').DataTable();
        }
        
    });
})