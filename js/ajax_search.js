function draw_result_ajax_search(field_name,id, text) {
    var container = document.getElementById('results_ajax_search');
    container.innerHTML = '';

    // Create an h4 element
    var h4Element = document.createElement('h4');
    h4Element.id = 'result_ajax_search';
    h4Element.textContent = text;

    // Create a button for deletion
    var deleteButton = document.createElement('button');
    deleteButton.className = 'btn btn-danger btn-sm flex-end'; // Bootstrap button styling
    deleteButton.innerHTML = 'X'; // Bootstrap trash icon

    deleteButton.addEventListener('click', function () {
        delete_selection();
    });

    // Create a container div to hold both h4 and button
    var resultContainer = document.createElement('div');
    resultContainer.classList.add('result_container');
    resultContainer.appendChild(deleteButton);
    resultContainer.appendChild(h4Element);

    // Create a hidden input
    var inputElement = document.createElement('input');
    inputElement.type = 'hidden';
    inputElement.name = field_name;
    inputElement.id = field_name;
    inputElement.value = id;

    // Add the input and container to the main container
    container.appendChild(inputElement);
    container.appendChild(resultContainer);
    document.querySelector('.vertical-buttons').innerHTML = '';
}


function delete_selection() {
    document.getElementById('results_ajax_search').innerHTML = '';
}

function cerrar_modals() {
    document.querySelectorAll(".modal-dialog").forEach(
        item => {
            item.parentNode.innerHTML = "";
        }
    );
}