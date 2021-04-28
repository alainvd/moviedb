// ***********************************************
// This example commands.js shows you how to
// create various custom commands and overwrite
// existing commands.
//
// For more comprehensive examples of custom
// commands please read more here:
// https://on.cypress.io/custom-commands
// ***********************************************
//
//
// -- This is a parent command --
// Cypress.Commands.add('login', (email, password) => { ... })
//
//
// -- This is a child command --
// Cypress.Commands.add('drag', { prevSubject: 'element'}, (subject, options) => { ... })
//
//
// -- This is a dual command --
// Cypress.Commands.add('dismiss', { prevSubject: 'optional'}, (subject, options) => { ... })
//
//
// -- This will overwrite an existing command --
// Cypress.Commands.overwrite('visit', (originalFn, url, options) => { ... })

Cypress.Commands.add('createDossier', (type, id) => {
    cy.visit('/homepage')

    const sepId = id || 'SEP-' + Math.floor(Math.random() * 1000000)

    if (type) {
        cy.get('select[name="call_id"] > option')
            .contains(`-${type}`)
            .then((option) => cy.get('select[name="call_id"]').select(option.val()))
            .wait(1000)
    } else {
        cy.get('select[name="call_id"] > option')
            .eq(1)
            .then((option) => cy.get('select[name="call_id"]').select(option.val()))
            .wait(1000)
    }

    cy.get('input[name="project_ref_id"]')
        .type(sepId)
        .wait(1000)

    cy.get('button#create-dossier')
        .click()
        .wait(1000)
})

Cypress.Commands.add('impersonate', (id, role) => {
    const minUserId = 4
    const maxUserId = 33

    if (role === 'applicant') {
        maxUserId = 23
    } else if (role === 'editor') {
        minUserId = 24
    }

    const userId = id || Math.floor(Math.random() * (maxUserId - minUserId)) + minUserId

    cy.visit(`http://moviedb.test/impersonate/${userId}`).wait(500)
})
