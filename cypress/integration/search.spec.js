const faker = require('faker')

context('Search page', () => {
    before(() => {
        cy.impersonate()
    })

    it('should display create work if nothing found', () => {
        cy.visit('/search')
        cy.get('input[data-cy="query"]').type('gibberish123', { delay: 250 })
            .type('{enter}')
            .wait(500)

        cy.get('body').should('contain', 'Could not find the Movie you are looking for?')
    })

    it('should redirect me to search page if search form submitted on welcome page', () => {
        cy.visit('/welcome')
        cy.get('input[name="q"]').type('aut', {delay: 250})
            .type('{enter}')
            .wait(500)

        cy.url().should('contain', '/search')
    })

    it('should show results for search term if found', () => {
        cy.visit('/welcome')
        cy.get('input[name="q"]').type('expedita', { delay: 250 })
            .type('{enter}')
            .wait(1000)

        cy.get('.search-list table')
            .should('contain', 'expedita')
    })

    it('should filter by year', () => {
        const year = '2010'
        cy.visit('/search').wait(500)

        cy.get('select#year').select(year).type('{enter}').wait(500)

        cy.get('.search-list table tbody > tr').each((row) => {
            cy.wrap(row).contains('td', year)
        })
    })

    it('should filter by nationality', () => {
        cy.visit('/search').wait(500)

        cy.get('select#nationality option').eq(Math.floor(Math.random() * 10) + 1)
            .then(option => {
                const nationality = option.val()

                cy.get('select#nationality').select(nationality)
                    .type('{enter}')
                    .wait(250)

                cy.get('.search-list table tbody').each((row) => {
                    cy.wrap(row).contains('td', nationality)
                })
            })
    })

    it('should filter by status', () => {
        cy.visit('/search').wait(500)
        cy.get('select#status').select('Draft')
            .type('{enter}')

        cy.get('.search-list table tbody').each((row) => {
            cy.wrap(row).contains('td', 'Draft')
        })
    })
})
