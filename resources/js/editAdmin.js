window.Admin = {
    ManagerEdit: {
        initAdmin: () => {
            window.Admin.ManagerEdit.checkDropdown();
            $('#inputRole').on('changed.bs.select', () => {
                window.Admin.ManagerEdit.checkDropdown();
            });

            let allPermissions = document.querySelectorAll('.allPermissions');
            let subjects = document.querySelector('#layerPermission').querySelectorAll('option');
            if (allPermissions[0] === 0) {
                return;
            } else {
                window.Admin.ManagerEdit.showAllLayers();
                window.Admin.ManagerEdit.showLayerPermissions();
                for (const permissionId of allPermissions) {
                    for (const subject of subjects) {
                        if (subject.value===permissionId.value) {
                            subject.selected = true;
                        }
                    }
                }
            }
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
            const allLayers = document.querySelector('#allLayersSelect');
            const allLayersDiv = document.querySelector('#allLayers');
            if (allLayers.value === "0") {
                window.Admin.ManagerEdit.showSubjectPermissions();
            }
            $('#allLayersSelect').on('changed.bs.select', () => {
                if (allLayers.value === "0") {
                    window.Admin.ManagerEdit.showSubjectPermissions();
                } else {
                    window.Admin.ManagerEdit.hidePermissionInterface();
                }
            });
            allLayersDiv.style.display = "block";
        },

        hideAllLayers: () => {
            document.querySelector('#allLayers').style.display = "none";
        },

        showSubjectPermissions: () => {
            document.querySelector('#subjectPermissionDiv').style.display = "block";
            document.querySelector('#assignLayersButton').style.display = "inline-block";
        },

        hidePermissionInterface: () => {
            document.querySelector('#subjectPermissionDiv').style.display = "none";
            document.querySelector('#layerPermissionDiv').style.display = "none";
        },

        showLayerPermissions: () => {
            window.Admin.ManagerEdit.selectLayerPermissions();
            document.querySelector('#layerPermissionDiv').style.display = "block";
            $('#subjectPermission').on('changed.bs.select', () => {
                window.window.Admin.ManagerEdit.selectLayerPermissions();
            });
            document.querySelector('#assignLayersButton').style.display = 'none';
        },

        selectLayerPermissions: () => {
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
