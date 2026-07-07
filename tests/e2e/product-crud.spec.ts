const { test, expect } = require('./utils/fixtures');
const { ProductPage } = require('./pages/ProductPage');

test.describe('Seller Product CRUD Operations', () => {
    const productName = `Product ${Date.now()}`;
    const updatedProductName = `${productName} Updated`;

    test('should be able to create, read, update, and delete a product', async ({ sellerPage }) => {
        const productPage = new ProductPage(sellerPage);
        
        // 1. Create (Tambah Produk)
        await test.step('Create Product', async () => {
            await productPage.goto();
            await productPage.createProduct({
                name: productName,
                stock: '10',
                base_price: '50000',
                description: 'This is a test product description.'
            });
        });

        // 2. Read (Lihat di List)
        await test.step('Read Product', async () => {
            await productPage.verifyProductInList(productName);
        });

        // 3. Update (Edit Produk)
        await test.step('Update Product', async () => {
            await productPage.updateProduct(productName, {
                name: updatedProductName,
                base_price: '75000'
            });
            await productPage.verifyProductInList(updatedProductName);
        });

        // 4. Delete (Hapus Produk)
        await test.step('Delete Product', async () => {
            await productPage.deleteProduct(updatedProductName);
        });
    });
});
