describe('Manage Layers', () => {
    beforeEach(() => {
        cy.refreshDatabase();

        cy.loginAdmin();

        cy.artisan('db:seed --class=TestAdminSeeder')
    });

    it('Update Admin to Super Admin', () => {
        cy.visit('/admin/managers/');

        cy.get(':nth-child(2) > .text-right > .btn-warning').click();
        cy.get('.filter-option-inner-inner').click();
        cy.get('#bs-select-1-1 > .text').click();
        cy.get('.btn-success').click();

        cy.get('tbody > :nth-child(2) > :nth-child(3)').contains('Super Admin');
    });

    it('Update Super Admin to Admin', () => {
        cy.visit('/admin/managers/');

        cy.get(':nth-child(3) > .text-right > .btn-warning').click();
        cy.get('.filter-option-inner-inner').click();
        cy.get('#bs-select-1-2 > .text').click();
        cy.get('.btn-success').click();

        cy.get('tbody > :nth-child(3) > :nth-child(3)').contains('Admin');
    });

    it('Update manager name', () => {
        cy.visit('/admin/managers/');

        cy.get(':nth-child(2) > .text-right > .btn-warning').click();
        cy.get('#inputName').clear().type('testname')
        cy.get('.btn-success').click();

        cy.get('tbody > :nth-child(2) > :nth-child(1)').contains('testname');
    });

    it('Update manager email', () => {
        cy.visit('/admin/managers/');

        cy.get(':nth-child(2) > .text-right > .btn-warning').click();
        cy.get('#inputEmail').clear().type('test@test.nl')
        cy.get('.btn-success').click();

        cy.get('tbody > :nth-child(2) > :nth-child(2)').contains('test@test.nl');
    });
});
