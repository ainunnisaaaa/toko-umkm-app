const { expect } = require('@playwright/test');

class ProductPage {
    constructor(page) {
        this.page = page;
    }

    async goto() {
        await this.page.goto('/seller/products');
    }

    async createProduct(data) {
        await this.page.click('text="Tambah Produk"'); 
        await this.page.waitForURL('**/seller/products/create');
        
        await this.page.fill('input[name="name"]', data.name);
        
        const categorySelect = this.page.locator('select[name="category_id"]');
        const firstOption = await categorySelect.locator('option').nth(1).getAttribute('value');
        if (firstOption) {
            await categorySelect.selectOption(firstOption);
        }
        
        await this.page.fill('input[name="stock"]', data.stock);
        await this.page.fill('input[name="base_price"]', data.base_price);
        await this.page.fill('textarea[name="description"]', data.description);
        
        const fs = require('fs');
        const path = require('path');
        const dummyPath = path.resolve(__dirname, '../utils/dummy.png');
        if (!fs.existsSync(dummyPath)) fs.writeFileSync(dummyPath, 'dummy image data');
        await this.page.setInputFiles('input[name="image"]', dummyPath);
        
        await this.page.click('button:has-text("Simpan")');
        await this.page.waitForURL('**/seller/products');
    }

    async verifyProductInList(name) {
        const row = this.page.locator('tr', { hasText: name });
        await expect(row).toBeVisible();
    }

    async updateProduct(oldName, newData) {
        const row = this.page.locator('tr', { hasText: oldName });
        await row.locator('a:has-text("Edit")').click(); 
        await this.page.waitForURL('**/edit');
        
        await this.page.fill('input[name="name"]', newData.name);
        await this.page.fill('input[name="base_price"]', newData.base_price);
        
        await this.page.click('button:has-text("Simpan")'); 
        await this.page.waitForURL('**/seller/products');
    }

    async deleteProduct(name) {
        const row = this.page.locator('tr', { hasText: name });
        
        this.page.on('dialog', dialog => dialog.accept());
        await row.locator('button:has-text("Hapus")').click(); 
        
        await expect(row).not.toBeVisible();
    }
}

module.exports = { ProductPage };
