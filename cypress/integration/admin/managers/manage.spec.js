describe('Manage Managers', () => {
    beforeEach(() => {
        cy.refreshDatabase();

        cy.loginAdmin();
    });

    it('Create Manager', () => {
        cy.create('App\\Models\\Domain');
        cy.create('App\\Models\\Subject', 3);
        cy.create('App\\Models\\Layer', 5);

        cy.visit('/admin/managers');

        cy.get('#newManager').should('be.visible').click();

        cy.fixture('admin/managers/create').then((manager) => {
            cy.get('#inputName').should('be.visible').type(manager.name);
            cy.get('#inputEmail').should('be.visible').type(manager.email);
            cy.get('#inputRole').invoke('selectpicker', 'val', manager.role);
            cy.get('#allLayersSelect').invoke('selectpicker', 'val', manager.custom_perm);
            cy.get('#subjectPermission').invoke('selectpicker', 'val', manager.subject);
            cy.get('#assignLayersButton').should('be.visible').click();
            cy.get('#layerPermission').invoke('selectpicker', 'val', manager.layer);

            cy.get('button[type="submit"]').should('be.visible').click();

            cy.get('#managerTable > tbody > tr').should('contain.text', manager.name);
            cy.get('#managerTable > tbody > tr').should('contain.text', manager.email);
        });
    });

    it('Edit Manager', () => {
        cy.tempAdmin();

        cy.create('App\\Models\\Domain');
        cy.create('App\\Models\\Subject', 3);
        cy.create('App\\Models\\Layer', 5);

        cy.visit('/admin/managers');

        cy.get('#managerTable > tbody > tr i.fa-edit').should('be.visible').click();

        cy.fixture('admin/managers/update').then((manager) => {
            cy.get('#inputName').should('be.visible').clear().type(manager.name);
            cy.get('#inputEmail').should('be.visible').clear().type(manager.email);
            cy.get('#inputRole').invoke('selectpicker', 'val', manager.role);
            cy.get('#allLayersSelect').invoke('selectpicker', 'val', manager.custom_perm);
            cy.get('#subjectPermission').invoke('selectpicker', 'val', manager.subject);
            cy.get('#assignLayersButton').should('be.visible').click();
            cy.get('#layerPermission').invoke('selectpicker', 'val', manager.layer);

            cy.get('button[type="submit"]').should('be.visible').click();

            cy.get('#managerTable > tbody > tr').should('contain.text', manager.name);
            cy.get('#managerTable > tbody > tr').should('contain.text', manager.email);
        });
    });

    it('Delete Manager', () => {
        cy.tempAdmin();

        cy.visit('/admin/managers');

        cy.get('#managerTable > tbody > tr').then(($rows) => {
            cy.wrap($rows).its('length').then((length) => {
                cy.get('#managerTable > tbody > tr i.fa-trash').should('be.visible').click();

                cy.get('.modal form button[type="submit"]').should('be.visible').click();

                cy.get('#managerTable > tbody > tr').should('have.length', length - 1);
            })
        });
    });
});
