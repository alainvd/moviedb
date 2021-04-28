context('Homepage', () => {
    beforeEach(() => {
        cy.visit('http://moviedb.test/homepage')
    })

    it('should display the homepage', () => {
        cy.get('body')
        .should('contain', 'Welcome to MediaDB')
    })

    it('requires a call and SEP id to create a dossier', () => {
        cy.get('button#create-dossier')
            .click()
            .wait(1000)

        cy.url()
            .should('not.contain', /dossiers/)
            .should('contain', 'homepage')
    })

    it('creates new dossier from inputs and redirects', () => {
        const sepId = 'SEP-' + Math.floor(Math.random() * 1000000)

        cy.get('select[name="call_id"] > option')
            .eq(1)
            .then((option) => cy.get('select[name="call_id"]').select(option.val()))
            .wait(1000)

        cy.get('input[name="project_ref_id"]')
            .type(sepId)
            .wait(1000)

        cy.get('button#create-dossier')
            .click()
            .url()
            .should('contain', `/dossiers/${sepId}`)
    })

    it('should create a DEVSLATE dossier for DEVSLATE call', () => {
        fillFields('DEVSLATE')

        cy.get('button#create-dossier').click()

        // Assert title is as expected and contains all three tables:
        // previous work, current work, short films
        cy.get('body')
            .should('contain', 'European Slate Development')
            .should('contain', 'Development - Recent work / previous experience')
            .should('contain', 'Development - For grant request')
            .should('contain', 'Short film - for grant request (optional)')
    })

    it('should create a DIST dossier for DIST call', () => {
        fillFields('DIST')

        cy.get('button#create-dossier').click()

        // Assert title, wizard section, distributors present
        cy.get('body')
        .should('contain', 'Film selection')
        .should('contain', 'Distributors Participating in the Grouping')
    })

    it('should create a TV dossier for TV call', () => {
        fillFields('TV')

        cy.get('button#create-dossier').click()

        cy.get('body')
            .should('contain', 'TV and Online Content')
            .should('contain', 'Production - For grant request')
    })
})

const fillFields = (callSuffix) => {
    const sepId = 'SEP-' + Math.floor(Math.random() * 1000000)

    cy.get('select[name="call_id"] > option')
        .contains(`-${callSuffix}`)
        .then((option) => cy.get('select[name="call_id"]').select(option.val()))
        .wait(2000)

    cy.get('input[name="project_ref_id"]')
        .type(sepId)
        .wait(1000)
}
