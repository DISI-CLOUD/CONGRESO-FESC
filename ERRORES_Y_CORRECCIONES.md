# Registro de Errores y Correcciones

Log de errores encontrados y las correcciones aplicadas, para replicar en otros servidores.

---

## #1 - Caracteres especiales no se muestran correctamente (acentos, eñes)

**Fecha:** 2026-02-16
**Archivo:** `home/cisemat/public_html/modelo/conexion.php`
**Síntoma:** En el dashboard principal los acentos (á, é, í, ó, ú) y la ñ se muestran como caracteres rotos/ilegibles.
**Causa:** La conexión a MySQL no declaraba el charset UTF-8, por lo que PHP interpretaba los datos como Latin-1.

**Corrección:**
Agregar la siguiente línea después del `mysqli_connect`:

```php
mysqli_set_charset($conexion, "utf8mb4");
```

**Archivo corregido (resultado final):**

```php
<?php
//Conexion con la base de datos.
$user = "congreso16";
$pass = "<%DbCongress_2023>";
$db = "congreso2023";
$conexion = mysqli_connect("localhost","$user","$pass","$db");
mysqli_set_charset($conexion, "utf8mb4");

?>
```

**Notas adicionales:**
- Si después de aplicar este cambio algunos textos siguen viéndose mal, es porque se guardaron en la BD con encoding incorrecto y hay que corregirlos directamente en las tablas.
- Verificar que las tablas de la BD usen collation `utf8mb4_unicode_ci`.
- Otros problemas menores de encoding detectados (no corregidos aún):
  - `index.php` línea 6: dice `lang="en"` en vez de `lang="es"`.
  - Algunos archivos de cartas (`cartaCursoAprobado.php`) declaran charset ISO-8859-1 en vez de UTF-8.
  - No se envía header HTTP `Content-Type: text/html; charset=utf-8` en las páginas principales.

---

## #2 - Pantalla en blanco después de iniciar sesión (DOCUMENT_ROOT sin slash)

**Fecha:** 2026-02-16
**Archivo:** `home/cisemat/public_html/Layouts/nav.php`
**Síntoma:** Al iniciar sesión la página se queda completamente en blanco. No muestra ningún error visible.
**Causa:** `$_SERVER["DOCUMENT_ROOT"]` no incluye `/` al final, por lo que las rutas de `require_once` se armaban incorrectamente. Por ejemplo: `public_htmlmodelo/traerFoto.php` en vez de `public_html/modelo/traerFoto.php`, causando un error fatal silencioso.

**Corrección:**
Agregar `/` al inicio de las rutas relativas en las líneas 5 y 6:

```php
// Antes (incorrecto):
require_once $_SERVER["DOCUMENT_ROOT"] . "modelo/traerFoto.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "modelo/completarPerfil.php";

// Después (correcto):
require_once $_SERVER["DOCUMENT_ROOT"] . "/modelo/traerFoto.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/modelo/completarPerfil.php";
```

**Notas adicionales:**
- Este problema se manifiesta al usar el servidor de desarrollo de PHP (`php -S`). En servidores Apache/Nginx el DOCUMENT_ROOT puede o no incluir el slash final dependiendo de la configuración.
- Hay otros archivos que usan `DOCUMENT_ROOT` sin `/` (ej. `modelo/cambiarFotosCrearCuenta.php`), que podrían presentar el mismo problema cuando se usen esas funciones.
