
// let roleSelect = document.querySelector('#inputRole');
// console.log(roleSelect);
// roleSelect.addEventListener('changed.bs.select',()=>{
//     checkDropdown();
// });

function checkDropdown() {
    let roleSelect = document.querySelector('#inputRole');
    if (roleSelect.innerText === 'admin') {
        createDropdown();
    } else {
        if (document.querySelector('#adminAuthContainer')!=null) {
            document.querySelector('#adminAuthContainer').innerHTML = "";
        }
        //verwijder permission interface
    }
}

function createDropdown() {
    let container = document.createElement('div');
    container.id = 'adminAuthContainer';
    let label = document.createElement('label');
    label.innerText = "Heeft de beheerder het recht om alle lagen te beheren?";
    let dropdown = document.createElement('select');
    dropdown.className = "selectpicker";
    let optionYes = document.createElement('option');
    optionYes.selected = true;
    optionYes.value = true;
    let optionNo = document.createElement('option');
    optionNo.value = false;
    dropdown.addEventListener('change',()=>{
        if (!dropdown.value) {
            createPermissionInterface();
        } else {
            //verwijder permission interface
        }
    });
    dropdown.appendChild(optionYes, optionNo);
    container.appendChild(label,dropdown);
    document.querySelector('#roleForm').appendChild(container);
}

function createPermissionInterface() {

}
