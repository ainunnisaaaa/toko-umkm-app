# Instructions

- Following Playwright test failed.
- Explain why, be concise, respect Playwright best practices.
- Provide a snippet of code with the fix, if possible.

# Test info

- Name: product-crud.spec.ts >> Seller Product CRUD Operations >> should be able to create, read, update, and delete a product
- Location: tests\e2e\product-crud.spec.ts:8:5

# Error details

```
Error: expect(locator).toBeVisible() failed

Locator: locator('tr').filter({ hasText: 'Product 1783442837071' })
Expected: visible
Timeout: 5000ms
Error: element(s) not found

Call log:
  - Expect "toBeVisible" with timeout 5000ms
  - waiting for locator('tr').filter({ hasText: 'Product 1783442837071' })

```

```yaml
- navigation:
  - list:
    - listitem:
      - link "Stack":
        - /url: "#stack"
        - button "Stack"
    - listitem:
      - link "Context":
        - /url: "#context"
        - button "Context"
    - listitem:
      - link "Debug":
        - /url: "#debug"
        - button "Debug"
    - listitem:
      - link "Flare":
        - /url: https://flareapp.io/?utm_campaign=ignition&utm_source=ignition
        - button "Flare":
          - img
          - text: Flare
  - list:
    - listitem:
      - link "Share":
        - /url: "#share"
        - button "Share"
      - heading "Share with Flare" [level=4]
      - link "Docs":
        - /url: https://flareapp.io/docs/ignition/introducing-ignition/sharing-errors?utm_campaign=ignition&utm_source=ignition
        - text: Docs
        - img
      - list:
        - listitem:
          - checkbox "Stack" [checked]
          - text: Stack
        - listitem:
          - checkbox "Context" [checked]
          - text: Context
        - listitem:
          - checkbox "Debug" [checked]
          - text: Debug
      - button "Create Share"
    - listitem:
      - link "Docs":
        - /url: https://laravel.com/docs/10.x/eloquent
        - button "Docs"
    - listitem:
      - link:
        - /url: "#settings"
        - button
      - heading "Ignition Settings" [level=4]
      - link "Docs":
        - /url: https://flareapp.io/ignition?utm_campaign=ignition&utm_source=ignition
        - text: Docs
        - img
      - text: Editor
      - combobox "Editor":
        - option "Clipboard"
        - option "Sublime"
        - option "TextMate"
        - option "Emacs"
        - option "MacVim"
        - option "PhpStorm" [selected]
        - option "PHPStorm Remote"
        - option "Idea"
        - option "VS Code"
        - option "VS Code Insiders"
        - option "VS Code Remote"
        - option "VS Code Insiders Remote"
        - option "VS Codium"
        - option "Cursor"
        - option "Atom"
        - option "Nova"
        - option "NetBeans"
        - option "Zed"
        - option "Windsurf"
        - option "Xdebug"
      - text: Theme
      - button "auto"
      - button "Save settings"
      - paragraph:
        - text: Settings will be saved locally in
        - code: ~/.ignition.json
        - text: .
  - 'link "SQLSTATE[HY000]: General error: 1364 Field ''rating'' doesn''t have a default value (Connection: mysql, SQL: insert into `products` (`name`, `category_id`, `base_price`, `stock`, `description`, `image`, `is_active`, `store_id`, `updated_at`, `created_at`) values (Product 1783442837071, 1, 50000, 10, This is a test product description., products/Rff0UgCZJvlTULS0IjpuUDd3ukYf5zaHqgFbZAyo.txt, 1, 1, 2026-07-07 16:47:27, 2026-07-07 16:47:27))"':
    - /url: "#top"
- main:
  - main:
    - text: "Illuminate \\ Database \\ QueryException PHP 8.1.10 10.50.2 SQLSTATE[HY000]: General error: 1364 Field 'rating' doesn't have a default value"
    - code:
      - code: "insert into `products` (`name`, `category_id`, `base_price`, `stock`, `description`, `image`, `is_active`, `store_id`, `updated_at`, `created_at`) values (Product 1783442837071, 1, 50000, 10, This is a test product description., products/Rff0UgCZJvlTULS0IjpuUDd3ukYf5zaHqgFbZAyo.txt, 1, 1, 2026-07-07 16:47:27, 2026-07-07 16:47:27)"
    - button "Copy to clipboard"
    - button
  - complementary:
    - button "Expand vendor frames"
    - list:
      - listitem: 15 vendor frames
      - listitem: "App \\ Http \\ Controllers \\ Seller \\ ProductController : 45 store"
      - listitem
      - listitem: 6 vendor frames
      - listitem: "App \\ Http \\ Middleware \\ RoleMiddleware : 23 handle"
      - listitem: 40 vendor frames
      - listitem: "C:\\laragon\\www\\toko-umkm-app\\public\\index .php : 52 require_once"
      - listitem: 1 vendor frame
  - 'link "C:\\laragon\\www\\toko-umkm-app\\app\\Http\\Controllers\\Seller\\ProductController .php : 45"':
    - /url: phpstorm://open?file=C%3A%5Claragon%5Cwww%5Ctoko-umkm-app%5Capp%5CHttp%5CControllers%5CSeller%5CProductController.php&line=45
  - main:
    - navigation:
      - paragraph: "30"
      - paragraph: "31"
      - paragraph: "32"
      - paragraph: "33"
      - paragraph: "34"
      - paragraph: "35"
      - paragraph: "36"
      - paragraph: "37"
      - paragraph: "38"
      - paragraph: "39"
      - paragraph: "40"
      - paragraph: "41"
      - paragraph: "42"
      - paragraph: "43"
      - paragraph: "44"
      - paragraph: "45"
      - paragraph: "46"
      - paragraph: "47"
      - paragraph: "48"
      - paragraph: "49"
      - paragraph: "50"
      - paragraph: "51"
      - paragraph: "52"
      - paragraph: "53"
      - paragraph: "54"
      - paragraph: "55"
      - paragraph: "56"
      - paragraph: "57"
      - paragraph: "58"
      - paragraph: "59"
    - code:
      - link:
        - /url: phpstorm://open?file=C%3A%5Claragon%5Cwww%5Ctoko-umkm-app%5Capp%5CHttp%5CControllers%5CSeller%5CProductController.php&line=30
        - button
      - text: "}"
      - link:
        - /url: phpstorm://open?file=C%3A%5Claragon%5Cwww%5Ctoko-umkm-app%5Capp%5CHttp%5CControllers%5CSeller%5CProductController.php&line=31
        - button
      - link:
        - /url: phpstorm://open?file=C%3A%5Claragon%5Cwww%5Ctoko-umkm-app%5Capp%5CHttp%5CControllers%5CSeller%5CProductController.php&line=32
        - button
      - text: /**
      - link:
        - /url: phpstorm://open?file=C%3A%5Claragon%5Cwww%5Ctoko-umkm-app%5Capp%5CHttp%5CControllers%5CSeller%5CProductController.php&line=33
        - button
      - text: "* Store a newly created resource in storage."
      - link:
        - /url: phpstorm://open?file=C%3A%5Claragon%5Cwww%5Ctoko-umkm-app%5Capp%5CHttp%5CControllers%5CSeller%5CProductController.php&line=34
        - button
      - text: "*/"
      - link:
        - /url: phpstorm://open?file=C%3A%5Claragon%5Cwww%5Ctoko-umkm-app%5Capp%5CHttp%5CControllers%5CSeller%5CProductController.php&line=35
        - button
      - text: public function store(StoreProductRequest $request)
      - link:
        - /url: phpstorm://open?file=C%3A%5Claragon%5Cwww%5Ctoko-umkm-app%5Capp%5CHttp%5CControllers%5CSeller%5CProductController.php&line=36
        - button
      - text: "{"
      - link:
        - /url: phpstorm://open?file=C%3A%5Claragon%5Cwww%5Ctoko-umkm-app%5Capp%5CHttp%5CControllers%5CSeller%5CProductController.php&line=37
        - button
      - text: $validated = $request->validated();
      - link:
        - /url: phpstorm://open?file=C%3A%5Claragon%5Cwww%5Ctoko-umkm-app%5Capp%5CHttp%5CControllers%5CSeller%5CProductController.php&line=38
        - button
      - text: "if ($request->hasFile('image')) {"
      - link:
        - /url: phpstorm://open?file=C%3A%5Claragon%5Cwww%5Ctoko-umkm-app%5Capp%5CHttp%5CControllers%5CSeller%5CProductController.php&line=39
        - button
      - text: $validated['image'] = $request->file('image')->store('products', 'public');
      - link:
        - /url: phpstorm://open?file=C%3A%5Claragon%5Cwww%5Ctoko-umkm-app%5Capp%5CHttp%5CControllers%5CSeller%5CProductController.php&line=40
        - button
      - text: "}"
      - link:
        - /url: phpstorm://open?file=C%3A%5Claragon%5Cwww%5Ctoko-umkm-app%5Capp%5CHttp%5CControllers%5CSeller%5CProductController.php&line=41
        - button
      - text: $validated['is_active'] = $request->has('is_active');
      - link:
        - /url: phpstorm://open?file=C%3A%5Claragon%5Cwww%5Ctoko-umkm-app%5Capp%5CHttp%5CControllers%5CSeller%5CProductController.php&line=42
        - button
      - text: // $validated['store_id'] = auth()->user()->store->id; // to be implemented
      - link:
        - /url: phpstorm://open?file=C%3A%5Claragon%5Cwww%5Ctoko-umkm-app%5Capp%5CHttp%5CControllers%5CSeller%5CProductController.php&line=43
        - button
      - text: $validated['store_id'] = 1; // dummy for now
      - link:
        - /url: phpstorm://open?file=C%3A%5Claragon%5Cwww%5Ctoko-umkm-app%5Capp%5CHttp%5CControllers%5CSeller%5CProductController.php&line=44
        - button
      - link:
        - /url: phpstorm://open?file=C%3A%5Claragon%5Cwww%5Ctoko-umkm-app%5Capp%5CHttp%5CControllers%5CSeller%5CProductController.php&line=45
        - button
      - text: Product::create($validated);
      - link:
        - /url: phpstorm://open?file=C%3A%5Claragon%5Cwww%5Ctoko-umkm-app%5Capp%5CHttp%5CControllers%5CSeller%5CProductController.php&line=46
        - button
      - text: return redirect()->route('seller.products.index')->with('success', 'Produk berhasil ditambahkan.');
      - link:
        - /url: phpstorm://open?file=C%3A%5Claragon%5Cwww%5Ctoko-umkm-app%5Capp%5CHttp%5CControllers%5CSeller%5CProductController.php&line=47
        - button
      - text: "}"
      - link:
        - /url: phpstorm://open?file=C%3A%5Claragon%5Cwww%5Ctoko-umkm-app%5Capp%5CHttp%5CControllers%5CSeller%5CProductController.php&line=48
        - button
      - link:
        - /url: phpstorm://open?file=C%3A%5Claragon%5Cwww%5Ctoko-umkm-app%5Capp%5CHttp%5CControllers%5CSeller%5CProductController.php&line=49
        - button
      - text: /**
      - link:
        - /url: phpstorm://open?file=C%3A%5Claragon%5Cwww%5Ctoko-umkm-app%5Capp%5CHttp%5CControllers%5CSeller%5CProductController.php&line=50
        - button
      - text: "* Display the specified resource."
      - link:
        - /url: phpstorm://open?file=C%3A%5Claragon%5Cwww%5Ctoko-umkm-app%5Capp%5CHttp%5CControllers%5CSeller%5CProductController.php&line=51
        - button
      - text: "*/"
      - link:
        - /url: phpstorm://open?file=C%3A%5Claragon%5Cwww%5Ctoko-umkm-app%5Capp%5CHttp%5CControllers%5CSeller%5CProductController.php&line=52
        - button
      - text: public function show(Product $product)
      - link:
        - /url: phpstorm://open?file=C%3A%5Claragon%5Cwww%5Ctoko-umkm-app%5Capp%5CHttp%5CControllers%5CSeller%5CProductController.php&line=53
        - button
      - text: "{"
      - link:
        - /url: phpstorm://open?file=C%3A%5Claragon%5Cwww%5Ctoko-umkm-app%5Capp%5CHttp%5CControllers%5CSeller%5CProductController.php&line=54
        - button
      - text: return view('seller.products.show', compact('product'));
      - link:
        - /url: phpstorm://open?file=C%3A%5Claragon%5Cwww%5Ctoko-umkm-app%5Capp%5CHttp%5CControllers%5CSeller%5CProductController.php&line=55
        - button
      - text: "}"
      - link:
        - /url: phpstorm://open?file=C%3A%5Claragon%5Cwww%5Ctoko-umkm-app%5Capp%5CHttp%5CControllers%5CSeller%5CProductController.php&line=56
        - button
      - link:
        - /url: phpstorm://open?file=C%3A%5Claragon%5Cwww%5Ctoko-umkm-app%5Capp%5CHttp%5CControllers%5CSeller%5CProductController.php&line=57
        - button
      - text: /**
      - link:
        - /url: phpstorm://open?file=C%3A%5Claragon%5Cwww%5Ctoko-umkm-app%5Capp%5CHttp%5CControllers%5CSeller%5CProductController.php&line=58
        - button
      - text: "* Show the form for editing the specified resource."
      - link:
        - /url: phpstorm://open?file=C%3A%5Claragon%5Cwww%5Ctoko-umkm-app%5Capp%5CHttp%5CControllers%5CSeller%5CProductController.php&line=59
        - button
      - text: "*/"
  - text: arguments
  - term: $method:string
  - definition:
    - code:
      - code: "\"create\""
    - button "Copy to clipboard"
  - term: $parameters:array
  - definition:
    - code:
      - code: "[ \"array (size=8)\" ]"
    - button "Copy to clipboard"
  - navigation:
    - list:
      - listitem:
        - link "App":
          - /url: "#context-app"
        - list:
          - listitem:
            - link "Routing":
              - /url: "#context-app-routing"
      - listitem:
        - link "Request":
          - /url: "#context-request"
        - list:
          - listitem:
            - link "Browser":
              - /url: "#context-request-browser"
          - listitem:
            - link "Headers":
              - /url: "#context-request-headers"
          - listitem:
            - link "Body":
              - /url: "#context-request-body"
      - listitem:
        - link "Context":
          - /url: "#context-context"
        - list:
          - listitem:
            - link "User":
              - /url: "#context-user-user"
          - listitem:
            - link "Versions":
              - /url: "#context-context-versions"
          - listitem:
            - link "Exception":
              - /url: "#context-context-exception"
  - heading "App" [level=2]
  - heading "Routing" [level=1]
  - term: Controller
  - definition:
    - code: App\Http\Controllers\Seller\ProductController@store
    - button "Copy to clipboard"
  - term: Route name
  - definition:
    - code: seller.products.store
    - button "Copy to clipboard"
  - term: Middleware
  - definition:
    - list:
      - listitem:
        - code: web
        - button "Copy to clipboard"
      - listitem:
        - code: auth
        - button "Copy to clipboard"
      - listitem:
        - code: role:seller
        - button "Copy to clipboard"
  - heading "Request" [level=2]
  - text: http://localhost:8000/seller/products POST
  - code:
    - code: "curl \"http://localhost:8000/seller/products\" \\ -X POST \\ -H 'host: localhost:8000' \\ -H 'connection: keep-alive' \\ -H 'content-length: 1070' \\ -H 'cache-control: max-age=0' \\ -H 'sec-ch-ua: \"HeadlessChrome\";v=\"149\", \"Chromium\";v=\"149\", \"Not)A;Brand\";v=\"24\"' \\ -H 'sec-ch-ua-mobile: ?0' \\ -H 'sec-ch-ua-platform: \"Windows\"' \\ -H 'upgrade-insecure-requests: 1' \\ -H 'content-type: multipart/form-data; boundary=----WebKitFormBoundaryXVBqDLzzD6JsKS3D' \\ -H 'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36' \\ -H 'origin: http://localhost:8000' \\ -H 'accept-language: en-US' \\ -H 'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7' \\ -H 'sec-fetch-site: same-origin' \\ -H 'sec-fetch-mode: navigate' \\ -H 'sec-fetch-user: ?1' \\ -H 'sec-fetch-dest: document' \\ -H 'referer: http://localhost:8000/seller/products/create' \\ -H 'accept-encoding: gzip, deflate, br, zstd' \\ -H 'cookie: <CENSORED>' \\ -F '_token=7UECURDf9SGeRkq7LYTY4GLSzTXfpuNVsOp6r8q0' -F 'name=Product 1783442837071' -F 'category_id=1' -F 'stock=10' -F 'base_price=50000' -F 'discount_price=null' -F 'description=This is a test product description.' -F 'is_active=1'"
  - button "Copy to clipboard"
  - button
  - heading "Browser" [level=1]
  - code: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36
  - button "Copy to clipboard"
  - heading "Headers" [level=1]
  - term: host
  - definition:
    - code: localhost:8000
    - button "Copy to clipboard"
  - term: connection
  - definition:
    - code: keep-alive
    - button "Copy to clipboard"
  - term: content-length
  - definition:
    - code: "1070"
    - button "Copy to clipboard"
  - term: cache-control
  - definition:
    - code: max-age=0
    - button "Copy to clipboard"
  - term: sec-ch-ua
  - definition:
    - code: "\"HeadlessChrome\";v=\"149\", \"Chromium\";v=\"149\", \"Not)A;Brand\";v=\"24\""
    - button "Copy to clipboard"
  - term: sec-ch-ua-mobile
  - definition:
    - code: "?0"
    - button "Copy to clipboard"
  - term: sec-ch-ua-platform
  - definition:
    - code: "\"Windows\""
    - button "Copy to clipboard"
  - term: upgrade-insecure-requests
  - definition:
    - code: "1"
    - button "Copy to clipboard"
  - term: content-type
  - definition:
    - code: multipart/form-data; boundary=----WebKitFormBoundaryXVBqDLzzD6JsKS3D
    - button "Copy to clipboard"
  - term: user-agent
  - definition:
    - code: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.7827.55 Safari/537.36
    - button "Copy to clipboard"
  - term: origin
  - definition:
    - code: http://localhost:8000
    - button "Copy to clipboard"
  - term: accept-language
  - definition:
    - code: en-US
    - button "Copy to clipboard"
  - term: accept
  - definition:
    - code: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7
    - button "Copy to clipboard"
  - term: sec-fetch-site
  - definition:
    - code: same-origin
    - button "Copy to clipboard"
  - term: sec-fetch-mode
  - definition:
    - code: navigate
    - button "Copy to clipboard"
  - term: sec-fetch-user
  - definition:
    - code: "?1"
    - button "Copy to clipboard"
  - term: sec-fetch-dest
  - definition:
    - code: document
    - button "Copy to clipboard"
  - term: referer
  - definition:
    - code: http://localhost:8000/seller/products/create
    - button "Copy to clipboard"
  - term: accept-encoding
  - definition:
    - code: gzip, deflate, br, zstd
    - button "Copy to clipboard"
  - term: cookie
  - definition:
    - code: <CENSORED>
    - button "Copy to clipboard"
  - heading "Body" [level=1]
  - code: "{ \"_token\": \"7UECURDf9SGeRkq7LYTY4GLSzTXfpuNVsOp6r8q0\", \"name\": \"Product 1783442837071\", \"category_id\": \"1\", \"stock\": \"10\", \"base_price\": \"50000\", \"discount_price\": null, \"description\": \"This is a test product description.\", \"is_active\": \"1\" }"
  - button "Copy to clipboard"
  - button
  - heading "Context" [level=2]
  - heading "User" [level=1]
  - img "budi@penjual.com"
  - paragraph: Budi Santoso
  - paragraph: budi@penjual.com
  - code:
    - code: "{ \"id\": 2, \"name\": \"Budi Santoso\", \"email\": \"budi@penjual.com\", \"role\": \"seller\", \"is_active\": true, \"created_at\": \"2026-07-07T16:37:47.000000Z\", \"updated_at\": \"2026-07-07T16:43:28.000000Z\", \"deleted_at\": null }"
  - button "Copy to clipboard"
  - button
  - heading "Versions" [level=1]
  - term: Php Version
  - definition:
    - code: 8.1.10
    - button "Copy to clipboard"
  - term: Laravel Version
  - definition:
    - code: 10.50.2
    - button "Copy to clipboard"
  - term: Laravel Locale
  - definition:
    - code: en
    - button "Copy to clipboard"
  - term: Laravel Config Cached
  - definition: "false"
  - term: App Debug
  - definition: "true"
  - term: App Env
  - definition:
    - code: local
    - button "Copy to clipboard"
  - heading "Exception" [level=1]
  - term: Raw Sql
  - definition:
    - code: "insert into `products` (`name`, `category_id`, `base_price`, `stock`, `description`, `image`, `is_active`, `store_id`, `updated_at`, `created_at`) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
    - button "Copy to clipboard"
  - navigation:
    - list:
      - listitem:
        - button "2 Queries"
  - text: 12:47:27 AM
  - img "Runtime"
  - text: 6.9ms
  - img "Connection"
  - text: mysql
  - code:
    - code: "select * from `users` where `id` = 2 limit 1"
  - button "Copy to clipboard"
  - button
  - button "1 query parameter"
  - text: 12:47:27 AM
  - img "Runtime"
  - text: 1.36ms
  - img "Connection"
  - text: mysql
  - code:
    - code: "select count(*) as aggregate from `categories` where `id` = 1"
  - button "Copy to clipboard"
  - button
  - button "1 query parameter"
  - list:
    - listitem:
      - img
    - listitem: ·
    - listitem:
      - link "Source":
        - /url: https://github.com/spatie/laravel-ignition
    - listitem: ·
    - listitem:
      - link "Docs":
        - /url: https://flareapp.io/docs/ignition/introducing-ignition/overview
    - listitem: ·
    - listitem:
      - link "Laravel":
        - /url: https://laravel.com
  - paragraph:
    - text: Ignition is built by
    - link "Flare":
      - /url: https://flareapp.io/?utm_campaign=ignition&utm_source=ignition
      - img
      - text: Flare
    - text: ", the Laravel error reporting service."
```

# Test source

```ts
  1  | const { expect } = require('@playwright/test');
  2  | 
  3  | class ProductPage {
  4  |     constructor(page) {
  5  |         this.page = page;
  6  |     }
  7  | 
  8  |     async goto() {
  9  |         await this.page.goto('/seller/products');
  10 |     }
  11 | 
  12 |     async createProduct(data) {
  13 |         await this.page.click('text="Tambah Produk"'); 
  14 |         await this.page.waitForURL('**/seller/products/create');
  15 |         
  16 |         await this.page.fill('input[name="name"]', data.name);
  17 |         
  18 |         const categorySelect = this.page.locator('select[name="category_id"]');
  19 |         const firstOption = await categorySelect.locator('option').nth(1).getAttribute('value');
  20 |         if (firstOption) {
  21 |             await categorySelect.selectOption(firstOption);
  22 |         }
  23 |         
  24 |         await this.page.fill('input[name="stock"]', data.stock);
  25 |         await this.page.fill('input[name="base_price"]', data.base_price);
  26 |         await this.page.fill('textarea[name="description"]', data.description);
  27 |         
  28 |         const fs = require('fs');
  29 |         const path = require('path');
  30 |         const dummyPath = path.resolve(__dirname, '../utils/dummy.png');
  31 |         if (!fs.existsSync(dummyPath)) fs.writeFileSync(dummyPath, 'dummy image data');
  32 |         await this.page.setInputFiles('input[name="image"]', dummyPath);
  33 |         
  34 |         await this.page.click('button:has-text("Simpan")');
  35 |         await this.page.waitForURL('**/seller/products');
  36 |     }
  37 | 
  38 |     async verifyProductInList(name) {
  39 |         const row = this.page.locator('tr', { hasText: name });
> 40 |         await expect(row).toBeVisible();
     |                           ^ Error: expect(locator).toBeVisible() failed
  41 |     }
  42 | 
  43 |     async updateProduct(oldName, newData) {
  44 |         const row = this.page.locator('tr', { hasText: oldName });
  45 |         await row.locator('a:has-text("Edit")').click(); 
  46 |         await this.page.waitForURL('**/edit');
  47 |         
  48 |         await this.page.fill('input[name="name"]', newData.name);
  49 |         await this.page.fill('input[name="base_price"]', newData.base_price);
  50 |         
  51 |         await this.page.click('button:has-text("Simpan")'); 
  52 |         await this.page.waitForURL('**/seller/products');
  53 |     }
  54 | 
  55 |     async deleteProduct(name) {
  56 |         const row = this.page.locator('tr', { hasText: name });
  57 |         
  58 |         this.page.on('dialog', dialog => dialog.accept());
  59 |         await row.locator('button:has-text("Hapus")').click(); 
  60 |         
  61 |         await expect(row).not.toBeVisible();
  62 |     }
  63 | }
  64 | 
  65 | module.exports = { ProductPage };
  66 | 
```