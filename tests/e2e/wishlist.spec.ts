const { test, expect } = require('./utils/fixtures');

test.describe('Buyer Wishlist Operations', () => {
    test('should be able to view wishlist', async ({ buyerPage }) => {
        // 1. Visit Wishlist Index
        await test.step('View Wishlist List', async () => {
            await buyerPage.goto('/buyer/wishlists');
            await expect(buyerPage.locator('h2', { hasText: 'Daftar Keinginan (Wishlist)' })).toBeVisible();
            
            // Just check if the page loads correctly (either empty or has items)
            const emptyState = buyerPage.locator('text=Wishlist Anda masih kosong');
            const hasItems = buyerPage.locator('text=Lihat Detail'); // Detail link inside item card
            
            // One of them must be visible
            const isEmptyVisible = await emptyState.isVisible();
            const isItemsVisible = await hasItems.count() > 0;
            
            expect(isEmptyVisible || isItemsVisible).toBeTruthy();
        });
    });
});
