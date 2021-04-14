describe('Subjects Map', () => {
    beforeEach(() => {
        cy.refreshDatabase();

        cy.create('App\\Models\\Domain');
        cy.create('App\\Models\\Subject', 1);

        cy.loginAdmin();
    });

    it('Relocate subjects', () => {
        cy.visit('/admin/map');

        cy.get('.leaflet-container').should('be.visible');
        cy.get('.leaflet-marker-icon').should('be.visible');

        cy.get('#saveLocations').should('be.visible').click();

        cy.get('.leaflet-container').should('be.visible');
        cy.get('.leaflet-marker-icon').should('be.visible');
    });
});
