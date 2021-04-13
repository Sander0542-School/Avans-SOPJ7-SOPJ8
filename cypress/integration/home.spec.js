describe('Homepage', () => {
    it('Side Menu', () => {
        cy.visit('/');

        cy.get('.sidemenu-control button').should('be.visible');
        cy.get('nav.sidemenu').should('not.have.class', 'active');
        cy.get('.sidemenu-control button').click();
        cy.get('nav.sidemenu').should('be.visible').should('have.class', 'active');

        cy.get('nav.sidemenu > ul > li:first > .menu-item a[data-toggle="collapse"]').should('be.visible').click();
        cy.get('nav.sidemenu > ul > li:first > ul.show').should('be.visible');

        cy.get('.sidemenu-control button').click();
        cy.get('nav.sidemenu').should('not.have.class', 'active');
    });

    it('Subject Map', () => {
        cy.visit('/');

        cy.get('.leaflet-container').should('be.visible');
        cy.get('.leaflet-marker-icon').should('be.visible');
    });
})
