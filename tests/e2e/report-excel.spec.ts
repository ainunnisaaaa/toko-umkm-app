const { test, expect } = require('./utils/fixtures');
const fs = require('fs');
const path = require('path');

test.describe('Report Excel Downloads', () => {
    
    // Ensure output directory exists before tests run
    test.beforeAll(() => {
        const outputDir = path.resolve(__dirname, '../../docs/testing/spreadsheet-output');
        if (!fs.existsSync(outputDir)) {
            fs.mkdirSync(outputDir, { recursive: true });
        }
    });

    test('Admin should be able to download Excel reports from Dashboard', async ({ adminPage }) => {
        const outputDir = path.resolve(__dirname, '../../docs/testing/spreadsheet-output');

        await test.step('Download Transaksi Excel', async () => {
            await adminPage.goto('/dashboard');
            
            const [download] = await Promise.all([
                adminPage.waitForEvent('download'),
                adminPage.locator('a[href*="transactions-excel"]').click()
            ]);
            
            const fileName = download.suggestedFilename();
            expect(fileName).toMatch(/^laporan-detail-transaksi\.xlsx$/);
            await download.saveAs(path.join(outputDir, fileName));
            
            expect(fs.existsSync(path.join(outputDir, fileName))).toBeTruthy();
        });

        await test.step('Download Kinerja Toko Excel', async () => {
            await adminPage.goto('/dashboard');
            
            const [download] = await Promise.all([
                adminPage.waitForEvent('download'),
                adminPage.locator('a[href*="store-performance-excel"]').click()
            ]);
            
            const fileName = download.suggestedFilename();
            expect(fileName).toMatch(/^laporan-kinerja-toko\.xlsx$/);
            await download.saveAs(path.join(outputDir, fileName));
            
            expect(fs.existsSync(path.join(outputDir, fileName))).toBeTruthy();
        });

        await test.step('Download Komisi Platform Excel', async () => {
            await adminPage.goto('/dashboard');
            
            const [download] = await Promise.all([
                adminPage.waitForEvent('download'),
                adminPage.locator('a[href*="platform-commissions-excel"]').click()
            ]);
            
            const fileName = download.suggestedFilename();
            expect(fileName).toMatch(/^laporan-komisi-platform\.xlsx$/);
            await download.saveAs(path.join(outputDir, fileName));
            
            expect(fs.existsSync(path.join(outputDir, fileName))).toBeTruthy();
        });
    });

    test('Seller should be able to download Products Stock Excel', async ({ sellerPage }) => {
        const outputDir = path.resolve(__dirname, '../../docs/testing/spreadsheet-output');

        await test.step('Download Products Stock Excel', async () => {
            await sellerPage.goto('/seller/products');
            
            const [download] = await Promise.all([
                sellerPage.waitForEvent('download'),
                sellerPage.locator('a[href*="products/excel"]').click()
            ]);
            
            const fileName = download.suggestedFilename();
            expect(fileName).toMatch(/^laporan-stok-produk\.xlsx$/);
            await download.saveAs(path.join(outputDir, fileName));
            
            expect(fs.existsSync(path.join(outputDir, fileName))).toBeTruthy();
        });
    });
});
