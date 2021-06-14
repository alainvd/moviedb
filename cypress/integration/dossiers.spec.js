context('Dossiers', () => {
    beforeEach(() => {
        // Act as random user
        const maxUserId = 33
        const randUserId = Math.floor(Math.random() * (maxUserId - 4)) + 4

        cy.visit(`http://moviedb.test/impersonate/${randUserId}`)
    })

    it('should create a dossier from homepage and show it in dossiers table', () => {
        const sepId = 'SEP-' + Math.floor(Math.random() * 1000000)

        cy.createDossier('', sepId)

        cy.visit('http://moviedb.test/dossiers')
        cy.get('.dossiers-list > table')
            .should('contain', sepId)
    })

    it('clicking edit should redirect the user to dossier', () => {
        const sepId = 'SEP-' + Math.floor(Math.random() * 1000000)

        cy.createDossier('', sepId)
        cy.visit('http://moviedb.test/dossiers')
        cy.get('.dossiers-list > table tr')
            .contains(sepId)
            .get('a')
            .contains('Edit')
            .click()
        cy.url().should('contain', `/dossiers/${sepId}`)
    })

    // Dossier current / previous / short validation tests

})
