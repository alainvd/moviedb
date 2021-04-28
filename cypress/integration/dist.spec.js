const faker = require('faker')

context('DIST dossiers', () => {
    const sepId = 'SEP-' + Math.floor(Math.random() * 1000000)
    const company = faker.company.companyName()
    const newCompany = company + ' - edit - ' + Date.now()

    before(() => {
        cy.impersonate()
        cy.createDossier('DIST', sepId)
    })

    it('should not show distributor modal if no movie selected', () => {
        cy.visit(`/dossiers/${sepId}`)

        cy.get('button#add-distributor').click().wait(1000)

        cy.get('body').contains('Movie not selected').should('be.visible')
    })

    it('should add movie from wizard', () => {
        const searchTerms = ['qui', 'aut', 'dolores', 'quo', 'et']

        cy.visit(`/dossiers/${sepId}`)

        cy.get('input#film-title').should('not.have.value')

        cy.get('a').contains('Search and Select').click().wait(500)

        cy.url().should('contain', 'movie-wizard')

        cy.get('input#original-title').type(faker.random.arrayElement(searchTerms), {delay: 300})

        cy.get('button').contains('Next').click().wait(500)

        cy.get('table tr').eq(1).find('input[type="radio"]').click()

        cy.get('table tr').eq(1).find('td').eq(1)
            .invoke('text')
            .then((title) => {
                cy.get('button').contains('Next').click().wait(500)

                cy.get('button').contains('Yes, I confirm').click().wait(500)

                cy.get('input#film-title').invoke('val').should('eq', title.trim())
            })

    })

    it('should show distributor modal', () => {
        cy.visit(`/dossiers/${sepId}`)

        cy.get('button#add-distributor').click().wait(1000)

        cy.get('body').contains('Add / Edit Distributor').should('be.visible')
    })

    it('should add a distributor', () => {
        let country = faker.datatype.number(30)
        const companyRole = faker.random.arrayElement(['Participant', 'Coordinator'])
        const releaseDate = faker.date.future().toLocaleDateString()
        const paCosts = Math.floor(faker.finance.amount())
        const forecastGrant = Math.floor(faker.finance.amount())

        cy.visit(`/dossiers/${sepId}`)

        cy.get('body').find('button').contains('Add').click().wait(500)

        cy.get('body').contains('Add / Edit Distributor').should('be.visible')

        cy.get('select#distribution-country option')
            .eq(country)
            .then((option) => {
                country = option.val()
                cy.get('select#distribution-country').select(option.val())
            })
            .wait(500)
        cy.get('input#distributor-company').type(company)
        cy.get('select#company-role').select(companyRole)
        cy.get('input#release-date').type(releaseDate).blur()
        cy.get('input#pa-costs').type(paCosts)
        cy.get('input#forecast-grant').type(forecastGrant)

        cy.get('button').contains('Save').click().wait(500)

        cy.get('.distributors-list > table')
            .should('contain', company)
    })

    it('should edit a distributor', () => {
        cy.visit(`/dossiers/${sepId}`)

        cy.get('.distributors-list > table tr')
            .contains(company)
            .parent()
            .find('a.edit-distributor')
            .click()
            .wait(500)

        cy.get('input#distributor-company')
            .invoke('val')
            .should('eq', company)

        cy.get('input#distributor-company').clear().type(newCompany)

        cy.get('button').contains('Save').click().wait(500)

        cy.get('.distributors-list > table').should('contain', newCompany)
    })

    it('should remove a distributor', () => {
        cy.visit(`/dossiers/${sepId}`)

        cy.get('.distributors-list > table tr')
            .contains(newCompany)
            .parent()
            .find('a.remove-distributor')
            .click()

        cy.get('.remove-distributor-confirmation').should('be.visible')

        cy.get('.confirm-remove-distributor').click().wait(500)

        cy.get('.distributors-list > table').should('not.contain', newCompany)
    })
})
