const { test, expect } = require('./utils/fixtures');

test.describe('Buyer Cart Operations', () => {
    test('should be able to view cart', async ({ buyerPage }) => {
        // 1. Visit Carts Index
        await test.step('View Carts List', async () => {
            await buyerPage.goto('/buyer/carts');
            await expect(buyerPage.locator('h2', { hasText: 'Keranjang Belanja' })).toBeVisible();
            
            // Just check if the page loads correctly (either empty or has items)
            const emptyState = buyerPage.locator('text=Keranjang belanja Anda masih kosong');
            const hasItems = buyerPage.locator('text=Ringkasan Belanja');
            
            // One of them must be visible
            const isEmptyVisible = await emptyState.isVisible();
            const isItemsVisible = await hasItems.isVisible();
            
            expect(isEmptyVisible || isItemsVisible).toBeTruthy();
        });
    });
});
