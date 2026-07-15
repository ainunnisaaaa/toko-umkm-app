import { test, expect } from '@playwright/test';

test('take screenshots', async ({ page }) => {
  const baseUrl = 'http://toko-umkm-app.test/public';

  // Home page
  await page.goto(`${baseUrl}/`);
  await page.screenshot({ path: 'docs/screenshots/01-home.png' });

  // Login page
  await page.goto(`${baseUrl}/login`);
  await page.screenshot({ path: 'docs/screenshots/02-login.png' });

  // Register page
  await page.goto(`${baseUrl}/register`);
  await page.screenshot({ path: 'docs/screenshots/03-register.png' });
  
  // Try to login as Seller (if DB has seller)
  try {
    await page.fill('input[name="email"]', 'seller@example.com'); 
    await page.fill('input[name="password"]', 'password');
    await page.click('button[type="submit"]');
    
    // Dashboard
    await page.goto(`${baseUrl}/dashboard`);
    await page.waitForTimeout(2000); // Wait for load
    await page.screenshot({ path: 'docs/screenshots/04-dashboard.png' });
  } catch(e) {
      console.log('Login failed or not available');
  }
});
