

window.Admin = {
    ManagerEdit: {
        initAdmin: () => {
            let roleSelect = document.querySelector('#inputRole');
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
                if (document.querySelector('#selectPermissions').style.display === "block") {
                    window.Admin.ManagerEdit.hidePermissionInterface();
                }
            }
        },

        showAllLayers: () => {
            let dropdown = document.querySelector('#allLayers');
            dropdown.style.display = "block";
            if (document.querySelector('#allLayersSelect').value === "false") {
                window.Admin.ManagerEdit.showPermissionInterface();
            }
            dropdown.addEventListener('change', () => {
                if (document.querySelector('#allLayersSelect').value === "false") {
                    window.Admin.ManagerEdit.showPermissionInterface();
                } else {
                    window.Admin.ManagerEdit.hidePermissionInterface();
                }
            });
        },

        hideAllLayers:() => {
            document.querySelector('#allLayers').style.display = "none";
        },

        showPermissionInterface:() => {
            let selectPermissions = document.querySelector('#selectPermissions');
            selectPermissions.style.display = "block";
        },

        hidePermissionInterface:() => {
            document.querySelector('#selectPermissions').style.display = "none";
        }

    }
}
