inhealth-integration
===========================

Mandiri Inhealth Integration for Laravel 10 (not yet tested on Laravel 6, 7, 8, 9 & ). **Install with composer, and start integrating with no hassle**. No public assets, no vendor routes. About Mandiri Inhealth API you can read here: [Swagger](https://development.inhealth.co.id/pelkesws2/catalog/index) 

## Install (Laravel)
Install via composer
```bash
composer require deantev/inhealth-integration
```

## Adding providers
Add Service Provider to `config/app.php` in `providers` section
```php
Rap2hpoutre\LaravelLogViewer\InhealthServiceProvider::class,
```

## Publishing config file
publish config file using artisan
```bash
php artisan vendor:publish --tag=inhealth-config
```

## Setup Configuration
configure your .env
```php
INHEALTH_PRODUCTION = #toogle to production url true or false (default: false)
INHEALTH_TOKEN = #Your Inhealth Token (this is required to be filled)
INHEALTH_PROVIDER_CODE = #Your Provider Code (this is required to be filled)
IHEALTH_DEV_URL = #inhealth development url (default: https://development.inhealth.co.id/pelkesws2/) you can change the value if url vendor mandiri changes.
IHEALTH_PROD_URL = #inhealth prod url (default: https://development.inhealth.co.id/pelkesws2/)
```

## Example Usage
### Usage on Function
```php
    use Deantev\Inhealth\Integration\Services\Inhealth as ServicesInhealth;

    public function somefunction(): array
    {
        // $data is the payload that you want to send to Mandiri Inhealth
        $data =[
            "tglpelayanan" => "2023-11-23"
            "nokainhealth" => "10015xxxxxxxx"
            "jenispelayanan" => "400904xxxxxxxx"
            "poli" => "24J"
        ]

        // Call function
        $inhealth = new ServicesInhealth;
        $result = $inhealth->postEligibilitasPeserta($data);
        return $result;
    }
```

## Result
### Success Response:
The result will be array from decoded json response (data represented below are Dummy Response)
```php
[
  "ERRORCODE" => "00"
  "ERRORDESC" => "Sukses"
  "NOKAPST" => "1001541995379"
  "NMPST" => "LINTANG SETIABUDI"
  "TGLLAHIR" => "1994-09-15T00:00:00"
  "KODEPRODUK" => "G"
  "NAMAPRODUK" => "GOLD"
  "KODEKELASRAWAT" => "1"
  "NAMAKELASRAWAT" => "KELAS I"
  "KODEBADANUSAHA" => "02230011"
  "NAMABADANUSAHA" => "PT GARUDA INDONESIA (PERSERO) Tbk"
  "KODEPROVIDER" => "0901K009"
  "NAMAPROVIDER" => "KLINIK GARUDA SENTRA MEDIKA"
  "NOKAPSTBPJS" => "0000165714636"
  "NMPSTBPJS" => "LINTANG SETIABUDI"
  "KELASBPJS" => "KELAS 1"
  "KODEPROVIDERBPJS" => "11030802"
  "NAMAPROVIDERBPJS" => "KALIWUNGU SELATAN"
  "FLAGPSTBPJS" => "1"
  "PRODUKCOB" => "BADAN USAHA NON COB"
  "PRIORITAS" => ""
  "TGLMULAIPST" => "2021-07-01T00:00:00"
  "TGLAKHIRPST" => "2023-12-31T00:00:00"
  "JENISKELAMIN" => "P"
]
```

### Error Response:
The result will be array from decoded json response (data represented below are Dummy Response)
```php
[
  "ERRORCODE" => "07"
  "ERRORDESC" => "Peserta Tidak Terdaftar"
  "NOKAPST" => null
  "NMPST" => null
  "TGLLAHIR" => "0001-01-01T00:00:00"
  "KODEPRODUK" => null
  "NAMAPRODUK" => null
  "KODEKELASRAWAT" => null
  "NAMAKELASRAWAT" => null
  "KODEBADANUSAHA" => null
  "NAMABADANUSAHA" => null
  "KODEPROVIDER" => null
  "NAMAPROVIDER" => null
  "NOKAPSTBPJS" => null
  "NMPSTBPJS" => null
  "KELASBPJS" => null
  "KODEPROVIDERBPJS" => null
  "NAMAPROVIDERBPJS" => null
  "FLAGPSTBPJS" => null
  "PRODUKCOB" => null
  "PRIORITAS" => null
  "TGLMULAIPST" => "0001-01-01T00:00:00"
  "TGLAKHIRPST" => "0001-01-01T00:00:00"
  "JENISKELAMIN" => null
]
```
