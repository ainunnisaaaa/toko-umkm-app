const { test, expect } = require('./utils/fixtures');

test.describe('Admin Sales Summary Operations', () => {
    test('should be able to view sales summaries list and details', async ({ adminPage }) => {
        // 1. Visit Sales Summaries Index
        await test.step('View Sales Summaries List', async () => {
            await adminPage.goto('/admin/sales-summaries');
            
            // Check if page title exists
            await expect(adminPage.locator('h2', { hasText: 'Laporan Penjualan' })).toBeVisible();
            
            // Check if table exists
            const table = adminPage.locator('table');
            await expect(table).toBeVisible();
        });

        // 2. View Details (if there's data, otherwise skip or check empty state)
        await test.step('View Sales Summary Details', async () => {
            // Check if there is data
            const viewDetailLink = adminPage.locator('text=Lihat Detail').first();
            
            if (await viewDetailLink.isVisible()) {
                await viewDetailLink.click();
                await expect(adminPage.locator('h2', { hasText: 'Detail Laporan Penjualan' })).toBeVisible();
                await expect(adminPage.locator('text=Informasi Laporan')).toBeVisible();
                
                // Go back
                await adminPage.click('text=Kembali ke Daftar Laporan');
            }
        });
    });
});
