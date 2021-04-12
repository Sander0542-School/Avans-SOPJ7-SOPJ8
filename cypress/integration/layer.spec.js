describe('Layer', () => {
    it('Side Menu', () => {
        cy.visit('/');

        cy.get('.sidemenu-control button').should('be.visible').click();
        cy.get('nav.sidemenu > ul > li:first > .menu-item a[data-toggle="collapse"]').should('be.visible').click();

        cy.get('nav.sidemenu > ul > li:first > ul.show > li > .menu-item > a[onclick]').should('be.visible').click().then(($elem) => {
            const title = $elem.text();

            cy.get('nav.sidemenu').should('not.have.class', 'active');

            cy.get('.layer-content h1').should('be.visible').should('contain.text', title);
        })
    });

    // it('Map', () => {
    //     cy.visit('/');
    //
    //     cy.get('.leaflet-marker-icon button').should('be.visible').first().click();
    //     cy.get('.layer-content h1').should('be.visible');
    // });

    it('URL', () => {
        cy.visit('/');

        cy.get('nav.sidemenu > ul > li:first > ul > li > .menu-item > a[onclick]').then(($elem) => {
            const title = $elem.text();
            const href = $elem.attr('href');

            cy.visit(href);
            cy.reload();

            cy.get('.layer-content h1').should('be.visible').should('contain.text', title);
        });
    });
});
