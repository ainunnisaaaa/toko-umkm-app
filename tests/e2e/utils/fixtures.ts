const { test: base, expect } = require('@playwright/test');
const fs = require('fs');
const path = require('path');
const { LoginPage } = require('../pages/LoginPage');

const test = base.extend({
    sellerPage: async ({ browser }, use) => {
        const authFile = path.resolve(__dirname, '../auth/seller.json');
        let context;
        
        if (fs.existsSync(authFile)) {
            context = await browser.newContext({ storageState: authFile });
        } else {
            context = await browser.newContext();
            const page = await context.newPage();
            const loginPage = new LoginPage(page);
            await loginPage.goto();
            await loginPage.login('budi@penjual.com', 'password123');
            await context.storageState({ path: authFile });
            await page.close();
        }
        
        const page = await context.newPage();
        await use(page);
        await context.close();
    },
    adminPage: async ({ browser }, use) => {
        const authFile = path.resolve(__dirname, '../auth/admin.json');
        let context;
        if (fs.existsSync(authFile)) {
            context = await browser.newContext({ storageState: authFile });
        } else {
            context = await browser.newContext();
            const page = await context.newPage();
            const loginPage = new LoginPage(page);
            await loginPage.goto();
            await loginPage.login('admin@tokokita.com', 'password123');
            await context.storageState({ path: authFile });
            await page.close();
        }
        const page = await context.newPage();
        await use(page);
        await context.close();
    },
    buyerPage: async ({ browser }, use) => {
        const authFile = path.resolve(__dirname, '../auth/buyer.json');
        let context;
        if (fs.existsSync(authFile)) {
            context = await browser.newContext({ storageState: authFile });
        } else {
            context = await browser.newContext();
            const page = await context.newPage();
            const loginPage = new LoginPage(page);
            await loginPage.goto();
            await loginPage.login('pembeli1@example.com', 'password123');
            await context.storageState({ path: authFile });
            await page.close();
        }
        const page = await context.newPage();
        await use(page);
        await context.close();
    },
});

module.exports = { test, expect };
