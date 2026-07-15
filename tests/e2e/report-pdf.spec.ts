const { test, expect } = require('./utils/fixtures');
const fs = require('fs');
const path = require('path');

test.describe('Report PDF Downloads', () => {
    
    // Ensure output directory exists before tests run
    test.beforeAll(() => {
        const outputDir = path.resolve(__dirname, '../../docs/testing/pdf-output');
        if (!fs.existsSync(outputDir)) {
            fs.mkdirSync(outputDir, { recursive: true });
        }
    });

    test('Admin should be able to download Top Products and Sales Summaries PDF', async ({ adminPage }) => {
        const outputDir = path.resolve(__dirname, '../../docs/testing/pdf-output');

        await test.step('Download Top 10 Products PDF', async () => {
            await adminPage.goto('/dashboard');
            
            const [download] = await Promise.all([
                adminPage.waitForEvent('download'),
                adminPage.click('text=Cetak Top 10 Produk (PDF)')
            ]);
            
            const fileName = download.suggestedFilename();
            expect(fileName).toMatch(/^laporan-top-10-produk-terlaris\.pdf$/);
            await download.saveAs(path.join(outputDir, fileName));
            
            expect(fs.existsSync(path.join(outputDir, fileName))).toBeTruthy();
        });

        await test.step('Download Sales Summaries PDF', async () => {
            await adminPage.goto('/admin/sales-summaries');
            
            const [download] = await Promise.all([
                adminPage.waitForEvent('download'),
                adminPage.click('text=Cetak Laporan (PDF)')
            ]);
            
            const fileName = download.suggestedFilename();
            expect(fileName).toMatch(/^laporan-rekap-penjualan\.pdf$/);
            await download.saveAs(path.join(outputDir, fileName));
            
            expect(fs.existsSync(path.join(outputDir, fileName))).toBeTruthy();
        });
    });

    test('Seller should be able to download Products Stock and Order Invoice PDF', async ({ sellerPage }) => {
        const outputDir = path.resolve(__dirname, '../../docs/testing/pdf-output');

        await test.step('Download Products Stock PDF', async () => {
            await sellerPage.goto('/seller/products');
            
            const [download] = await Promise.all([
                sellerPage.waitForEvent('download'),
                sellerPage.locator('a[href*="products/pdf"]').click()
            ]);
            
            const fileName = download.suggestedFilename();
            expect(fileName).toMatch(/^laporan-stok-produk\.pdf$/);
            await download.saveAs(path.join(outputDir, fileName));
            
            expect(fs.existsSync(path.join(outputDir, fileName))).toBeTruthy();
        });

        await test.step('Download Seller Order Invoice PDF', async () => {
            await sellerPage.goto('/seller/orders');
            
            // Check if there are orders
            const invoiceLink = sellerPage.locator('a[href*="/invoice"]').first();
            if (await invoiceLink.isVisible()) {
                const [download] = await Promise.all([
                    sellerPage.waitForEvent('download'),
                    invoiceLink.click()
                ]);
                
                const fileName = download.suggestedFilename();
                expect(fileName).toMatch(/^invoice-.*\.pdf$/);
                await download.saveAs(path.join(outputDir, fileName));
                
                expect(fs.existsSync(path.join(outputDir, fileName))).toBeTruthy();
            }
        });
    });

    test('Buyer should be able to download Order History and Order Invoice PDF', async ({ buyerPage }) => {
        const outputDir = path.resolve(__dirname, '../../docs/testing/pdf-output');

        await test.step('Download Order History PDF', async () => {
            await buyerPage.goto('/buyer/orders');
            
            const [download] = await Promise.all([
                buyerPage.waitForEvent('download'),
                buyerPage.click('text=Cetak Riwayat (PDF)')
            ]);
            
            const fileName = download.suggestedFilename();
            expect(fileName).toMatch(/^laporan-riwayat-pembelian\.pdf$/);
            await download.saveAs(path.join(outputDir, fileName));
            
            expect(fs.existsSync(path.join(outputDir, fileName))).toBeTruthy();
        });

        await test.step('Download Buyer Order Invoice PDF', async () => {
            await buyerPage.goto('/buyer/orders');
            
            // Check if there are orders
            const invoiceLink = buyerPage.locator('a[href*="/invoice"]').first();
            if (await invoiceLink.isVisible()) {
                const [download] = await Promise.all([
                    buyerPage.waitForEvent('download'),
                    invoiceLink.click()
                ]);
                
                const fileName = download.suggestedFilename();
                expect(fileName).toMatch(/^invoice-.*\.pdf$/);
                await download.saveAs(path.join(outputDir, fileName));
                
                expect(fs.existsSync(path.join(outputDir, fileName))).toBeTruthy();
            }
        });
    });
});
