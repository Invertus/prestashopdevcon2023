describe('Home page specs', () => {
  it('home page loads', () => {
    cy.request({
      url: '/',
    }).then((resp) => {
      // redirect status code is 302
      expect(resp.status).to.eq(200)
    })
  })
})