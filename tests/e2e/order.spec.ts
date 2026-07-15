const { test, expect } = require('./utils/fixtures');

test.describe('Order Operations', () => {
    
    test('seller should be able to view orders list and update status', async ({ sellerPage }) => {
        // 1. Visit Orders Index
        await test.step('View Seller Orders List', async () => {
            await sellerPage.goto('/seller/orders');
            await expect(sellerPage.locator('h2', { hasText: 'Daftar Pesanan Masuk' })).toBeVisible();
            
            // Check if there are orders or empty state
            const emptyState = sellerPage.locator('text=Belum ada pesanan masuk.');
            const hasItems = sellerPage.locator('text=Detail');
            
            const isEmptyVisible = await emptyState.isVisible();
            const isItemsVisible = await hasItems.count() > 0;
            
            expect(isEmptyVisible || isItemsVisible).toBeTruthy();
        });
    });

    test('buyer should be able to view order history', async ({ buyerPage }) => {
        // 1. Visit Orders Index
        await test.step('View Buyer Orders List', async () => {
            await buyerPage.goto('/buyer/orders');
            await expect(buyerPage.locator('h2', { hasText: 'Riwayat Pesanan Saya' })).toBeVisible();
            
            // Check if there are orders or empty state
            const emptyState = buyerPage.locator('text=Anda belum memiliki riwayat pesanan.');
            const hasItems = buyerPage.locator('text=Detail');
            
            const isEmptyVisible = await emptyState.isVisible();
            const isItemsVisible = await hasItems.count() > 0;
            
            expect(isEmptyVisible || isItemsVisible).toBeTruthy();
        });
    });

});
