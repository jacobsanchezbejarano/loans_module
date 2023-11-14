//Ruta por default
const ruta_staff = "php/ajax/staff.php";
var method = "POST"; 

function search_pers(term) {
    var selector_dest = "#show_result_pers";
    var params = {
        buscar_term: true,
        term: term
    };
    postAjax(method,ruta_staff,params,selector_dest);
}