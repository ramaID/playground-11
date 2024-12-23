## **1. Penulisan Kode yang Konsisten**

- **Gunakan Laravel Pint**:
  Semua code style harus seragam. Terapkan **Laravel Pint** untuk memastikan style kode tetap konsisten di seluruh tim.

  **Implementasi CI/CD**:
  Gunakan `fix-php-code-style-issues.yml` sebagai bagian dari workflow CI/CD:

  ```yml
  name: Fix PHP code style issues

  on:
    push:
      paths:
        - "**.php"

  permissions:
    contents: write

  jobs:
    php-code-styling:
      runs-on: ubuntu-latest

      steps:
        - name: Checkout code
          uses: actions/checkout@v3

        - name: Fix PHP code style issues
          uses: aglipanci/laravel-pint-action@2.3.0

        - name: Commit changes
          uses: stefanzweifel/git-auto-commit-action@v4
          with:
            commit_message: Fix styling
  ```

## **2. Struktur dan Standar Pengujian**

- **Setup Pengujian Kualitas**:
  Tambahkan workflow `quality-check.yml` untuk melakukan pengujian terhadap kode dan mengirim hasil ke SonarQube untuk analisis kualitas.

  **Workflow Contoh**:

  ```yml
  name: Quality Check

  on:
    push:
      branches: ["main"]
    pull_request:
      branches: ["main"]

  jobs:
    quality-check:
      runs-on: ubuntu-latest

      container:
        image: ramageek/image:php8.3-laravel-dev
        options: --workdir /var/www/html

      steps:
        - name: Clone Repository
          run: cd /var/www && rm -rf html && git clone <repository-url> html && cd html && ls

        - name: Setup Laravel
          run: |
            cp .env.example .env
            composer install --no-interaction --optimize-autoloader
            php artisan key:generate
            cp .env .env.testing

        - name: Run Quality Check
          run: |
            composer qc
            sonar-scanner -Dsonar.login=${{ secrets.SONAR_LOGIN_TOKEN }} -Dsonar.host.url=${{ secrets.SONAR_HOST_URL }}
          working-directory: /var/www/html
  ```

## **3. Dokumentasi dan Komentar**

- Dokumentasikan setiap **Controller**, **Service**, dan **Command** dengan PHPDoc.
- Gunakan nama variabel, fungsi, dan class yang deskriptif.

## **4. Arsitektur yang Baik**

- **Pemisahan Tanggung Jawab (Separation of Concerns)**:
  Implementasikan **Action Classes** untuk memisahkan logika bisnis dari Controller.

  Contoh:

  ```php
  class CreateProductAction
  {
      public function execute(Category $category, string $name, string $description, float $price): Product
      {
          return Product::create([
              'category_id' => $category->id,
              'name' => $name,
              'description' => $description,
              'price' => $price
          ]);
      }
  }
  ```

- **Gunakan DTO (Data Transfer Objects)**:
  Gunakan DTO untuk memastikan data yang ditransfer antar service tetap konsisten dan aman.

## **5. Redis dan Event-Driven Architecture**

- **Gunakan Redis untuk Event Stream**:
  - Redis harus digunakan untuk komunikasi antar layanan (publikasi dan konsumsi event).
  - Konsumen Redis dijalankan secara reguler menggunakan command seperti `php artisan redis:consume`.

## **6. Pengelolaan Database**

- Setiap service harus memiliki database terpisah untuk menjaga **loose coupling** dan **high cohesion**.

## **7. Deployment dan Monitoring**

- **Pastikan CI/CD Otomatis**:
  Setiap perubahan harus melalui pipeline CI/CD yang mencakup:

  - **Code Style Check** (Laravel Pint)
  - **Static Analysis** (PHPStan, SonarQube)
  - **Testing** (Unit dan Integration Test)

- **Logging dan Monitoring**:
  - Gunakan stack ELK/EFK untuk mengumpulkan log dari semua container.
  - Gunakan **Redis** atau **RabbitMQ** untuk memastikan event tidak hilang.
