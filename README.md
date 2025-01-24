
# Laravel Sanctum API & Next.js Frontend

Bu proje, Laravel Sanctum ile kimlik doğrulama API'si ve Next.js ile bu API'yi kullanan bir frontend projesini içerir. Backend (Laravel) API'yi sağlarken, frontend (Next.js) bu API'yi kullanarak kimlik doğrulama işlemleri yapar.

## Yapı

Proje iki ana klasörden oluşmaktadır:

- **`be/`**: Laravel API backend, Sanctum ile kimlik doğrulama
- **`fe/`**: Next.js frontend, backend API'yi kullanarak kimlik doğrulama işlemi yapar

## Gereksinimler

- PHP 8.0 ve üzeri
- Laravel 8.x veya daha yeni bir sürüm
- Node.js ve npm (Next.js için)
- MySQL veya SQLite veritabanı

## Başlangıç

### Backend (Laravel)

1. `be/` dizinine gidin ve Laravel bağımlılıklarını yükleyin:

   ```bash
   cd be
   composer install
   ```

2. `.env` dosyasını oluşturun ve veritabanı bağlantılarını yapılandırın:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. Veritabanı migrasyonlarını çalıştırın:

   ```bash
   php artisan migrate
   ```

4. Laravel Sanctum'u kurun:

   ```bash
   php artisan sanctum:install
   php artisan migrate
   ```

5. Laravel sunucusunu başlatın:

   ```bash
   php artisan serve
   ```

   Bu, API'yi `http://127.0.0.1:8000` üzerinde çalıştıracaktır.

### Frontend (Next.js)

1. `fe/` dizinine gidin ve gerekli npm bağımlılıklarını yükleyin:

   ```bash
   cd fe
   npm install
   ```

2. `.env.local` dosyasını oluşturun ve backend API'nin URL'sini yapılandırın:

   ```bash
   NEXT_PUBLIC_API_URL=http://127.0.0.1:8000/api
   ```

3. Next.js sunucusunu başlatın:

   ```bash
   npm run dev
   ```

   Bu, frontend'i `http://localhost:3000` üzerinde çalıştıracaktır.

## Kullanım

Frontend, backend API ile entegre olarak kullanıcı girişi ve çıkışı yapmaktadır. Frontend, kullanıcıyı giriş yaptıktan sonra bir token alır ve bu token ile API'ye yapılan isteklerde kimlik doğrulaması yapılır.

1. Kullanıcı giriş yapmak için `/login` API'sini kullanabilir.
2. Kullanıcı kaydını oluşturmak için `/register` API'sini kullanabilir.
3. Kimlik doğrulama işlemi başarılı olduğunda, frontend token'ı saklar ve her istekte bu token'ı kullanır.

## Katkıda Bulunma

1. Fork yapın.
2. Yeni bir branch oluşturun (`git checkout -b feature-xyz`).
3. Değişikliklerinizi yapın ve commit edin (`git commit -am 'Add feature xyz'`).
4. Değişikliklerinizi GitHub'a push edin (`git push origin feature-xyz`).
5. Pull request açın.

## Lisans

Bu proje MIT lisansı ile lisanslanmıştır. Daha fazla bilgi için `LICENSE` dosyasına bakın.
