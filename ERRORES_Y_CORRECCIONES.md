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

---

## #3 - Función NombrePropio no existe al importar dump de base de datos

**Fecha:** 2026-02-17
**Archivo:** `database/congresomat_20250425.sql`
**Síntoma:** Al importar el dump SQL aparece el error: `ERROR 1305 (42000) at line 3035: FUNCTION congreso2023.NombrePropio does not exist`. Las vistas `Autores_carteles` y otras que usan esta función no se crean.
**Causa:** El dump contiene vistas que referencian la función `NombrePropio()` (capitaliza la primera letra de cada palabra), pero la definición de dicha función no está incluida en el archivo SQL.

**Corrección:**
Crear la función manualmente antes de importar el dump:

```sql
DELIMITER //
CREATE FUNCTION NombrePropio(str VARCHAR(255))
RETURNS VARCHAR(255)
DETERMINISTIC
BEGIN
    DECLARE result VARCHAR(255) DEFAULT '';
    DECLARE word VARCHAR(255);
    DECLARE remaining VARCHAR(255);

    SET remaining = LOWER(TRIM(str));

    WHILE remaining != '' DO
        IF LOCATE(' ', remaining) > 0 THEN
            SET word = SUBSTRING(remaining, 1, LOCATE(' ', remaining) - 1);
            SET remaining = SUBSTRING(remaining, LOCATE(' ', remaining) + 1);
        ELSE
            SET word = remaining;
            SET remaining = '';
        END IF;

        SET word = CONCAT(UPPER(LEFT(word, 1)), SUBSTRING(word, 2));
        SET result = IF(result = '', word, CONCAT(result, ' ', word));
    END WHILE;

    RETURN result;
END //
DELIMITER ;
```

**Notas adicionales:**
- La función es equivalente a `INITCAP` de otros motores de BD (capitaliza la primera letra de cada palabra).
- Considerar agregar la definición de esta función al inicio del dump para futuras importaciones.

---

## #4 - Dropdowns del navbar no funcionan en páginas con sidebar (perfil, trabajos registrados)

**Fecha:** 2026-02-17
**Archivo:** `home/cisemat/public_html/Layouts/sidebar.php`
**Síntoma:** En páginas como `/components/perfil/perfil.php` y `/components/TrabajosRegistrados/trabajosRegistrados.php`, los menús desplegables del navbar (Información, Programa, Actividades, etc.) no se abren al hacer clic. El enlace de "Inicio" sí funciona porque es un `<a>` directo. En `index.php` todo funciona correctamente.
**Causa:** El archivo `sidebar.php` cargaba Bootstrap JS **5.3.0** (línea 287 original) para su funcionalidad de offcanvas. Luego las páginas cargaban Bootstrap JS **5.1.1** al final del `<body>`. Al tener **dos versiones distintas** de Bootstrap JS en la misma página, la segunda sobrescribía la inicialización de la primera, rompiendo los dropdowns del navbar. El `index.php` no incluye sidebar, por eso no se veía afectado.

**Corrección:**
Eliminar la carga duplicada de Bootstrap JS del sidebar y envolver el script de inicialización del offcanvas en `DOMContentLoaded` para que espere a que el Bootstrap JS de la página principal esté disponible:

```php
<!-- ANTES (incorrecto - cargaba Bootstrap 5.3.0 duplicado): -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function activateOffcanvas() { ... }
    document.querySelector('.background-lateral-boton').addEventListener('click', activateOffcanvas);
    activateOffcanvas();
</script>

<!-- DESPUÉS (correcto - usa DOMContentLoaded sin cargar Bootstrap duplicado): -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function activateOffcanvas() {
            var offcanvasElement = document.getElementById('offcanvasScrolling');
            if (window.innerWidth < 992) {
                var offcanvas = new bootstrap.Offcanvas(offcanvasElement);
                offcanvas.show();
            } else {
                offcanvasElement.classList.remove('offcanvas', 'offcanvas-start');
                offcanvasElement.classList.add('flex', 'flex-col');
            }
        }
        document.querySelector('.background-lateral-boton').addEventListener('click', activateOffcanvas);
        activateOffcanvas();
    });
</script>
```

**Notas adicionales:**
- El proyecto usa 3 versiones distintas de Bootstrap: CSS 5.2.2, sidebar JS 5.3.0 (ya eliminado), y páginas JS 5.1.1. Se recomienda unificar a una sola versión.
- Cualquier página que incluya `sidebar.php` estaba afectada por este problema.
