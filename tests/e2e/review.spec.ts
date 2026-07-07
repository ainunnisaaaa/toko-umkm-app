import { test, expect } from '@playwright/test';
import { execSync } from 'child_process';

test.describe('Buyer Review Flow', () => {
  test.beforeAll(() => {
    // Run migrations and specific seeder
    console.log('Running migrations and seeder...');
    execSync('php artisan migrate:fresh', { stdio: 'inherit' });
    execSync('php artisan db:seed --class=ReviewTestSeeder', { stdio: 'inherit' });
  });

  test('Buyer can give a review on a delivered order and see it on product page', async ({ page, baseURL }) => {
    // 1. Login
    await page.goto('/login');
    await page.fill('input[name="email"]', 'buyer.review@tokokita.com');
    await page.fill('input[name="password"]', 'password');
    await page.click('button[type="submit"]');

    // Make sure login is successful (redirected to dashboard)
    await expect(page).toHaveURL(/.*dashboard/);

    // 2. Go to Review Create page for Order ID 1, Product ID 1
    // (Since db was refreshed, these IDs should be 1)
    await page.goto('/buyer/reviews/create?order_id=1&product_id=1');
    
    // Check if the page loaded properly
    await expect(page.locator('h3', { hasText: 'Ulasan untuk Produk Review Test' })).toBeVisible();

    // 3. Fill out the review form
    await page.selectOption('select[name="rating"]', '5');
    await page.fill('textarea[name="comment"]', 'Barang sangat bagus, pengiriman cepat dan aman!');
    
    // Submit review
    await page.click('button#btn-submit-review');

    // 4. Verify redirected to product detail page and review is visible
    await expect(page).toHaveURL(/.*\/products\/1/);
    
    // Check success message
    await expect(page.locator('text=Ulasan berhasil ditambahkan')).toBeVisible();

    // Check product info
    await expect(page.locator('#product-name')).toHaveText('Produk Review Test');

    // Check review list
    const reviewAuthor = page.locator('.review-author').first();
    await expect(reviewAuthor).toHaveText('Buyer Review');

    const reviewComment = page.locator('.review-comment').first();
    await expect(reviewComment).toHaveText('Barang sangat bagus, pengiriman cepat dan aman!');
  });
});
