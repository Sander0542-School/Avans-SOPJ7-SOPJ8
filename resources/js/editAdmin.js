

window.Admin = {
    ManagerEdit: {
        initAdmin: () => {
            let roleSelect = document.querySelector('#inputRole');
            window.Admin.ManagerEdit.checkDropdown();
            roleSelect.addEventListener('change', () => {
                window.Admin.ManagerEdit.checkDropdown();
            });
        },

        checkDropdown: () => {
            let roleSelect = document.querySelector('#inputRole');
            if (roleSelect.value === "2") {
                window.Admin.ManagerEdit.showAllLayers();
            } else {
                if (document.querySelector('#allLayers').style.display === "block") {
                    window.Admin.ManagerEdit.hideAllLayers();
                }
                if (document.querySelector('#subjectPermissionDiv').style.display === "block") {
                    window.Admin.ManagerEdit.hidePermissionInterface();
                }
            }
        },

        showAllLayers: () => {
            let dropdown = document.querySelector('#allLayers');
            dropdown.style.display = "block";
            if (document.querySelector('#allLayersSelect').value === "0") {
                window.Admin.ManagerEdit.showSubjectPermissions();
            }
            dropdown.addEventListener('change', () => {
                if (document.querySelector('#allLayersSelect').value === "0") {
                    window.Admin.ManagerEdit.showSubjectPermissions();
                } else {
                    window.Admin.ManagerEdit.hidePermissionInterface();
                }
            });
        },

        hideAllLayers:() => {
            document.querySelector('#allLayers').style.display = "none";
        },

        showSubjectPermissions:() => {
            document.querySelector('#subjectPermissionDiv').style.display = "block";
            document.querySelector('#assignLayersButton').style.display = "inline-block";
        },

        hidePermissionInterface:() => {
            document.querySelector('#subjectPermissionDiv').style.display = "none";
            document.querySelector('#layerPermissionDiv').style.display = "none";
        },

        showLayerPermissions:() => {
            window.Admin.ManagerEdit.selectLayerPermissions();
            document.querySelector('#layerPermissionDiv').style.display = "block";
            document.querySelector('#subjectPermission').addEventListener('change',()=>{
                window.window.Admin.ManagerEdit.selectLayerPermissions();
            });
            document.querySelector('#assignLayersButton').style.display = 'none';
        },

        selectLayerPermissions:() => {
            let subjectIds = [];
            let subjects = document.querySelector('#subjectPermission').querySelectorAll('option')
            for (const subject of subjects) {
                if (subject.selected) {
                    subjectIds.push(`subject-${subject.value}`);
                }
            }
            for (const layer of document.querySelector('#layerPermission').querySelectorAll('option')) {
                layer.selected = subjectIds.includes(layer.getAttribute('data-parent'));
            }
        }
    }
}
