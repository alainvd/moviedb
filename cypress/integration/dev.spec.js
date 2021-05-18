const faker = require('faker')

context('DEV dossiers', () => {
    const sepId = 'SEP-' + Math.floor(Math.random() * 1000000)
    const action = faker.random.arrayElement(['DEVSLATE', 'DEVMINISLATE'])
    const previousTitle = faker.lorem.sentence(3)
    const newPreviousTitle = previousTitle + ' - edited - ' + Date.now()
    const currentTitle = faker.lorem.sentence(3)
    const newCurrentTitle = currentTitle + ' - edited - ' + Date.now()
    const shortTitle = faker.lorem.sentence(3)
    const newShortTitle = shortTitle + ' - edited - ' + Date.now()

    before(() => {
        cy.impersonate()
        cy.createDossier(action, sepId)
    })

    beforeEach(() => {
        cy.visit(`/dossiers/${sepId}`)
    })

    it('should show validation errors if no work submitted', () => {
        cy.get('button').contains('Save').click().wait(500)

        cy.get('body').should('contain', 'The company field is required')
            .should('contain', 'The previous works must be')
            .should('contain', 'The current works must be')
    })

    it('should add a previous work', () => {
        cy.get('.previous-work-list').parent().find('a').contains('Add')
            .click().wait(500)

        cy.url().should('contain', 'fiche/dev-prev')

        cy.get('input#original_title').type(previousTitle, {delay: 150})

        cy.get('button#button-save').click().wait(500)

        cy.url().should('contain', `dossiers/${sepId}`)

        cy.get('.previous-work-list > table').should('contain', previousTitle)
    })

    it('should edit previous work', () => {
        cy.get('.previous-work-list > table tr').contains(previousTitle)
            .parent().find('a').contains('Edit').click().wait(500)

        cy.get('input#original_title').clear().type(newPreviousTitle)

        cy.get('button#button-save').click().wait(500)

        cy.get('.previous-work-list > table').should('contain', newPreviousTitle)
    })

    it('should delete previous work', () => {
        cy.get('.previous-work-list > table tr').contains(newPreviousTitle)
            .parent().find('a').contains('Remove').click().wait(500)

        cy.get('body').contains('Remove Previous Work').should('be.visible')

        cy.get('button.confirm-remove-previous-work').click().wait(500)

        cy.get('.previous-work-list > table').should('not.contain', newPreviousTitle)
    })

    it('should add a current work', () => {
        cy.get('.current-work-list').parent().find('a').contains('Add')
            .click().wait(500)

        cy.url().should('contain', 'fiche/dev-current')

        cy.get('input#original_title').type(currentTitle, { delay: 150 })

        cy.get('button#button-save').click().wait(500)

        cy.url().should('contain', `dossiers/${sepId}`)

        cy.get('.current-work-list > table').should('contain', currentTitle)
    })

    it('should edit current work', () => {
        cy.get('.current-work-list > table tr').contains(currentTitle)
            .parent().find('a').contains('Edit').click().wait(500)

        cy.get('input#original_title').clear().type(newCurrentTitle)

        cy.get('button#button-save').click().wait(500)

        cy.get('.current-work-list > table').should('contain', newCurrentTitle)
    })

    it('should delete current work', () => {
        cy.get('.current-work-list > table tr').contains(newCurrentTitle)
            .parent().find('a').contains('Remove').click().wait(500)

        cy.get('body').contains('Remove Current Work').should('be.visible')

        cy.get('button.confirm-remove-current-work').click().wait(500)

        cy.get('.current-work-list > table').should('not.contain', newCurrentTitle)
    })

    it('should add short film for selected actions', () => {
        cy.get('.short-film-list').parent().find('a').contains('Add')
            .click().wait(500)

        cy.url().should('contain', 'fiche/dev-current')

        cy.get('input#original_title').type(shortTitle, { delay: 150 })

        cy.get('button#button-save').click().wait(500)

        cy.url().should('contain', `dossiers/${sepId}`)

        cy.get('.short-film-list > table').should('contain', shortTitle)
    })

    it('should edit short work', () => {
        cy.get('.short-film-list > table tr').contains(shortTitle)
            .parent().find('a').contains('Edit').click().wait(500)

        cy.get('input#original_title').clear().type(newShortTitle)

        cy.get('button#button-save').click().wait(500)

        cy.get('.short-film-list > table').should('contain', newShortTitle)
    })

    it('should delete short work', () => {
        cy.get('.short-film-list > table tr').contains(newShortTitle)
            .parent().find('a').contains('Remove').click().wait(500)

        cy.get('button.confirm-remove-short-film').click().wait(500)

        cy.get('.short-film-list > table').should('not.contain', newShortTitle)
    })
})
