describe('Home page specs', () => {
  beforeEach(function () {
    cy.fixture('products').then((products) => {
      this.products = products
    })
  })

  it('cart page displays module information', function () {
    cy.visit(this.products[0].url)
    cy.get('.add-to-cart').click()
    cy.get('#blockcart-modal').should('exist')
    cy.visit('/cart')
    cy.get('[data-cy="card-list"] li').should('exist')
  })
})