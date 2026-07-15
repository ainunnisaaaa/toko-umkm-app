# Instructions

- Following Playwright test failed.
- Explain why, be concise, respect Playwright best practices.
- Provide a snippet of code with the fix, if possible.

# Test info

- Name: report-excel.spec.ts >> Report Excel Downloads >> Seller should be able to download Products Stock Excel
- Location: tests\e2e\report-excel.spec.ts:64:5

# Error details

```
Test timeout of 30000ms exceeded.
```

```
Error: page.waitForEvent: Target page, context or browser has been closed
=========================== logs ===========================
waiting for event "download"
============================================================
```

# Page snapshot

```yaml
- generic [ref=e2]:
  - link "TokoKita" [ref=e4] [cursor=pointer]:
    - /url: /
    - generic [ref=e5]:
      - img [ref=e7]
      - generic [ref=e9]: TokoKita
  - generic [ref=e10]:
    - generic [ref=e12]:
      - heading "Welcome Back!" [level=2] [ref=e13]
      - paragraph [ref=e14]: Please sign in to your account to continue
    - generic [ref=e15]:
      - generic [ref=e16]:
        - generic [ref=e17]: Email Address
        - generic [ref=e18]:
          - generic:
            - img
          - textbox "Email Address" [active] [ref=e19]:
            - /placeholder: you@example.com
      - generic [ref=e20]:
        - generic [ref=e21]:
          - generic [ref=e22]: Password
          - link "Forgot password?" [ref=e23] [cursor=pointer]:
            - /url: http://localhost:8000/forgot-password
        - generic [ref=e24]:
          - generic:
            - img
          - textbox "Password" [ref=e25]:
            - /placeholder: ••••••••
      - generic [ref=e26]:
        - checkbox "Remember me" [ref=e27] [cursor=pointer]
        - generic [ref=e28] [cursor=pointer]: Remember me
      - button "Sign In" [ref=e30] [cursor=pointer]
      - generic [ref=e31]:
        - text: Don't have an account?
        - link "Sign up now" [ref=e32] [cursor=pointer]:
          - /url: http://localhost:8000/register
  - generic [ref=e33]: © 2026 TokoKita. All rights reserved.
```

# Test source

```ts
  1  | const { test, expect } = require('./utils/fixtures');
  2  | const fs = require('fs');
  3  | const path = require('path');
  4  | 
  5  | test.describe('Report Excel Downloads', () => {
  6  |     
  7  |     // Ensure output directory exists before tests run
  8  |     test.beforeAll(() => {
  9  |         const outputDir = path.resolve(__dirname, '../../docs/testing/spreadsheet-output');
  10 |         if (!fs.existsSync(outputDir)) {
  11 |             fs.mkdirSync(outputDir, { recursive: true });
  12 |         }
  13 |     });
  14 | 
  15 |     test('Admin should be able to download Excel reports from Dashboard', async ({ adminPage }) => {
  16 |         const outputDir = path.resolve(__dirname, '../../docs/testing/spreadsheet-output');
  17 | 
  18 |         await test.step('Download Transaksi Excel', async () => {
  19 |             await adminPage.goto('/dashboard');
  20 |             
  21 |             const [download] = await Promise.all([
  22 |                 adminPage.waitForEvent('download'),
  23 |                 adminPage.locator('a[href*="transactions-excel"]').click()
  24 |             ]);
  25 |             
  26 |             const fileName = download.suggestedFilename();
  27 |             expect(fileName).toMatch(/^laporan-detail-transaksi\.xlsx$/);
  28 |             await download.saveAs(path.join(outputDir, fileName));
  29 |             
  30 |             expect(fs.existsSync(path.join(outputDir, fileName))).toBeTruthy();
  31 |         });
  32 | 
  33 |         await test.step('Download Kinerja Toko Excel', async () => {
  34 |             await adminPage.goto('/dashboard');
  35 |             
  36 |             const [download] = await Promise.all([
  37 |                 adminPage.waitForEvent('download'),
  38 |                 adminPage.locator('a[href*="store-performance-excel"]').click()
  39 |             ]);
  40 |             
  41 |             const fileName = download.suggestedFilename();
  42 |             expect(fileName).toMatch(/^laporan-kinerja-toko\.xlsx$/);
  43 |             await download.saveAs(path.join(outputDir, fileName));
  44 |             
  45 |             expect(fs.existsSync(path.join(outputDir, fileName))).toBeTruthy();
  46 |         });
  47 | 
  48 |         await test.step('Download Komisi Platform Excel', async () => {
  49 |             await adminPage.goto('/dashboard');
  50 |             
  51 |             const [download] = await Promise.all([
  52 |                 adminPage.waitForEvent('download'),
  53 |                 adminPage.locator('a[href*="platform-commissions-excel"]').click()
  54 |             ]);
  55 |             
  56 |             const fileName = download.suggestedFilename();
  57 |             expect(fileName).toMatch(/^laporan-komisi-platform\.xlsx$/);
  58 |             await download.saveAs(path.join(outputDir, fileName));
  59 |             
  60 |             expect(fs.existsSync(path.join(outputDir, fileName))).toBeTruthy();
  61 |         });
  62 |     });
  63 | 
  64 |     test('Seller should be able to download Products Stock Excel', async ({ sellerPage }) => {
  65 |         const outputDir = path.resolve(__dirname, '../../docs/testing/spreadsheet-output');
  66 | 
  67 |         await test.step('Download Products Stock Excel', async () => {
  68 |             await sellerPage.goto('/seller/products');
  69 |             
  70 |             const [download] = await Promise.all([
> 71 |                 sellerPage.waitForEvent('download'),
     |                            ^ Error: page.waitForEvent: Target page, context or browser has been closed
  72 |                 sellerPage.locator('a[href*="products/excel"]').click()
  73 |             ]);
  74 |             
  75 |             const fileName = download.suggestedFilename();
  76 |             expect(fileName).toMatch(/^laporan-stok-produk\.xlsx$/);
  77 |             await download.saveAs(path.join(outputDir, fileName));
  78 |             
  79 |             expect(fs.existsSync(path.join(outputDir, fileName))).toBeTruthy();
  80 |         });
  81 |     });
  82 | });
  83 | 
```