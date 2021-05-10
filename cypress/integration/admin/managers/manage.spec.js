describe('Manage Managers', () => {
    beforeEach(() => {
        cy.refreshDatabase();

        cy.loginAdmin();
    });

    it('Create Manager', () => {
        cy.visit('/admin/managers');

        cy.get('#newManager').should('be.visible').click();

        cy.fixture('admin/managers/create').then((manager) => {
            cy.get('#inputName').should('be.visible').type(manager.name);
            cy.get('#inputEmail').should('be.visible').type(manager.email);
            cy.get('#inputRole').invoke('selectpicker', 'val', manager.role);

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
