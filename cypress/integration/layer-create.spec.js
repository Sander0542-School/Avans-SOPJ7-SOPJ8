describe('Layer', () => {
    it('createLayer', () => {

        cy.visit('/login');
        cy.get('input[name=email]').type('admin@expeditiekaart.nl');
        cy.get('input[name=password]').type('password');
        cy.get('button').click();

        cy.visit('/admin/layers/create');
        cy.get('#inputName').should('be.visible').type('Test Titel');
        cy.get('button[data-id=inputParent]').click();
        cy.get('input[type=search]').type('koude kant');
        cy.get('#bs-select-1-3').should('be.visible').click();
        cy.get('button[type="submit"]').should('be.visible').click();
    });
});
