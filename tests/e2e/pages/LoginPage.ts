const { expect } = require('@playwright/test');

class LoginPage {
    constructor(page) {
        this.page = page;
    }

    async goto() {
        await this.page.goto('/login');
    }

    async login(email, password = 'password123') {
        await this.page.fill('input[name="email"]', email);
        await this.page.fill('input[name="password"]', password);
        await this.page.click('button[type="submit"]');
        
        await this.page.waitForURL('**/dashboard**', { timeout: 10000 }).catch(() => {});
        if (!this.page.url().includes('dashboard')) {
             await this.page.waitForURL('**/seller/products**', { timeout: 10000 }).catch(() => {});
        }
    }
}

module.exports = { LoginPage };
