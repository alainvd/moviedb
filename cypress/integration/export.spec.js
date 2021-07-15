const faker = require('faker')
const fs = require('fs')
const path = require('path')

context('Export', () => {
    const downloadsFolder = Cypress.config('downloadsFolder')

    before(() => {
      cy.impersonate('editor')
    })

    beforeEach(() => {
      cy.task('deleteFolder', downloadsFolder)
      cy.visit('/dashboard/export')
    })

    it('should display the export page', () => {
      cy.get('body').should('contain', 'EXPORT')
    })

    it('should download file when clicking export', () => {
      cy.intercept('**/export').as('export')

      cy.get('button').contains('Export').click()
        .wait(500)

      cy.wait('@export')
        .its('response')
        .then((res) => {
            const { download } = res.body.effects

            assert.isNotNull(download)

            const { name, content } = download

            expect(name).to.contain('dossiers-')
            expect(name).to.contain('.xlsx')
        })
    })

    it('should download fiche export when selecting fiches', () => {
      cy.intercept('**/export').as('export')

      cy.get('[data-cy=export-fiches]').click().wait(250)
      cy.get('button').contains('Export').click()
        .wait(500)

      cy.wait('@export')
        .its('response')
        .then((res) => {
            const { download } = res.body.effects

            if (download) {
              const { name, content } = download

              expect(name).to.contain('fiches-')
              expect(name).to.contain('.xlsx')
            }
        })
    })

    it.only('should export distributors with FILMOVE', () => {
      cy.intercept('**/export').as('export')

      const actionsSelect = cy.get('select#selected-actions')
      const actionsInput = actionsSelect.siblings('input')

      actionsInput.focus()
      cy.get('select#selected-actions').parent().siblings('.choices__list--dropdown')
        .contains('FILMOVE').click().wait(250)
      cy.get('select#selected-actions').siblings('input').blur().wait(250)

      cy.get('button').contains('Export').click()
        .wait(500)

      cy.wait(['@export', '@export'])
        .then((reqs) => {
          if (reqs.length > 1) {
            const res = reqs[1].response
            const { download } = res.body.effects
            const { name } = download

            cy.task('readExcelFile', {filename: path.join(downloadsFolder, name), sheet: 2})
              .then(list => {
                expect(list[0]).to.deep.equal([
                  'SEP-ID', 'Movie ID', 'Original Title', 'Company', 'Role', 'Country', 'Forecast Release Date', 'Forecast Grant', 'P&A Costs', 'Added by', 'Added at'
                ])
              })
          }
        })
    })
})
