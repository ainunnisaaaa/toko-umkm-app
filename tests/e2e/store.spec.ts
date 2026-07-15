const { test, expect } = require('./utils/fixtures');

test.describe('Seller Store CRUD Operations', () => {
    const storeName = `Toko ${Date.now()}`;
    const updatedStoreName = `${storeName} Updated`;

    test('should be able to create, read, update, and delete a store', async ({ sellerPage }) => {
        
        // 1. Visit Stores Index
        await test.step('View Stores List', async () => {
            await sellerPage.goto('/seller/stores');
            await expect(sellerPage.locator('h2', { hasText: 'Toko Saya' })).toBeVisible();
        });

        // 2. Create Store
        await test.step('Create Store', async () => {
            await sellerPage.click('text=Tambah Toko');
            
            await sellerPage.fill('input[name="name"]', storeName);
            await sellerPage.fill('textarea[name="description"]', 'Deskripsi toko uji coba E2E.');
            await sellerPage.fill('textarea[name="address"]', 'Jalan Uji Coba No. 123');
            
            await sellerPage.click('button[type="submit"]');
            
            // Check success message
            await expect(sellerPage.locator('text=Toko berhasil ditambahkan.')).toBeVisible();
            await expect(sellerPage.locator('td', { hasText: storeName })).toBeVisible();
        });

        // 3. Read (Show Detail)
        await test.step('Read Store Details', async () => {
            const row = sellerPage.locator('tr', { hasText: storeName });
            await row.locator('text=Lihat').click();
            
            await expect(sellerPage.locator('h3', { hasText: storeName })).toBeVisible();
            await expect(sellerPage.locator('text=Deskripsi toko uji coba E2E.')).toBeVisible();
            
            await sellerPage.click('text=Kembali ke Daftar Toko');
        });

        // 4. Update Store
        await test.step('Update Store', async () => {
            const row = sellerPage.locator('tr', { hasText: storeName });
            await row.locator('text=Edit').click();
            
            await sellerPage.fill('input[name="name"]', updatedStoreName);
            await sellerPage.click('button[type="submit"]');
            
            await expect(sellerPage.locator('text=Toko berhasil diperbarui.')).toBeVisible();
            await expect(sellerPage.locator('td', { hasText: updatedStoreName })).toBeVisible();
        });

        // 5. Delete Store
        await test.step('Delete Store', async () => {
            sellerPage.on('dialog', dialog => dialog.accept());
            const row = sellerPage.locator('tr', { hasText: updatedStoreName });
            await row.locator('button', { hasText: 'Hapus' }).click();
            
            await expect(sellerPage.locator('text=Toko berhasil dihapus.')).toBeVisible();
            await expect(sellerPage.locator('td', { hasText: updatedStoreName })).toHaveCount(0);
        });
    });
});
