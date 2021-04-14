describe('Manage Menu', () => {
    beforeEach(() => {
        cy.refreshDatabase();

        cy.create('App\\Models\\Domain');

        cy.loginAdmin();
    });

    it('Reorder subjects', () => {
        cy.create('App\\Models\\Subject', 5);

        cy.visit('/admin/menu');

        cy.get('.sortable .sortable-item').then($items => {
            cy.wrap($items).should('have.length', 5);

            cy.wrap($items).eq(2).then($item => {
                cy.wrap($item).find('input[data-name="order"]').should('have.value', 3);

                cy.wrap($item).find('i.fa-sort')
                    .trigger('mousedown', {which: 1})
                    .trigger('mousemove', {which: 1, pageY: 200})
                    .trigger('mouseup')

                cy.wrap($item).find('input[data-name="order"]').should('have.value', 1);

                cy.wrap($item).find('input[data-name="name"]').invoke('val').should('not.be.empty').then($input => {
                    const title = $input.trim();
                    cy.log(title);

                    cy.get('button[type="submit"]').click();

                    cy.get('.sortable .sortable-item').first().find('input[data-name="name"]').should('have.value', title);
                });
            });
        })
    });
});
