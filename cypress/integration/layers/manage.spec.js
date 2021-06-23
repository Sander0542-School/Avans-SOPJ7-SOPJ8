describe('Manage Layers', () => {
    beforeEach(() => {
        cy.refreshDatabase();

        cy.create('App\\Models\\Domain');
        cy.create('App\\Models\\Subject', 3);

        cy.loginAdmin();
    });

    it('Create Layer', () => {
        cy.visit('/admin/layers');

        cy.get('#newLayer').should('be.visible').click();

        cy.fixture('layers/create').then((layer) => {
            cy.get('#inputName').should('be.visible').type(layer.name);

            cy.get('button[data-id="inputParent"]').should('be.visible').click();
            cy.get('.bootstrap-select a.opt[role="option"]').first().should('be.visible').click();

            cy.get('iframe.cke_wysiwyg_frame').then($frameWindow => {
                const win = cy.state('window');
                const ckEditor = win.CKEDITOR;
                const instances = ckEditor.instances;

                const myEditor = Object.values(instances).filter(instance => instance.id === 'cke_1')[0];

                myEditor.setData(layer.content);
            });

            cy.get('button[type="submit"]').should('be.visible').click();

            cy.get('#layerTable > tbody > tr').should('contain.text', layer.name);
        });
    });

    it('Update Layer', () => {
        cy.create('App\\Models\\Layer');

        cy.visit('/admin/layers');
        cy.get('#layerTable > tbody > tr > .text-right > .btn.layer-edit').should('be.visible').click();

        cy.fixture('layers/update').then((layer) => {
            cy.get('#inputName').should('be.visible').clear().type(layer.name);

            cy.get('button[data-id="inputParent"]').should('be.visible').click();
            cy.get('.bootstrap-select a.opt[role="option"]').first().should('be.visible').click();

            cy.get('iframe.cke_wysiwyg_frame').then($frameWindow => {
                const win = cy.state('window');
                const ckEditor = win.CKEDITOR;
                const instances = ckEditor.instances;

                const myEditor = Object.values(instances).filter(instance => instance.id === 'cke_1')[0];

                myEditor.setData(layer.content);
            });

            cy.get('button[type="submit"]').should('be.visible').click();

            cy.get('#layerTable > tbody > tr').should('contain.text', layer.name);
        });
    });

    it('Filter Layer', () => {
        cy.create('App\\Models\\Layer', 5);

        cy.visit('/admin/layers');

        cy.get('#layerTable > tbody > tr').then($rows => {
            cy.wrap($rows).should('have.length', 5);

            cy.wrap($rows).eq(0).should('be.visible');
            cy.wrap($rows).eq(1).should('be.visible');
            cy.wrap($rows).eq(2).should('be.visible');
            cy.wrap($rows).eq(3).should('be.visible');
            cy.wrap($rows).eq(4).should('be.visible');

            cy.wrap($rows).eq(2).find('td').first().then($column => cy.get('#inputFilter').type($column.text()));

            cy.wrap($rows).eq(0).should('not.be.visible');
            cy.wrap($rows).eq(1).should('not.be.visible');
            cy.wrap($rows).eq(2).should('be.visible');
            cy.wrap($rows).eq(3).should('not.be.visible');
            cy.wrap($rows).eq(4).should('not.be.visible');
        });
    });
});
