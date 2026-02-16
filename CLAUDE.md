# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

**Congreso Matemáticas** — a PHP web application for managing an international mathematics conference (CISEMAT). Handles user registration, paper/poster submission, peer review workflows, attendance/payment tracking, certificate generation, and conference program management. All UI and content is in Spanish.

Repository source: `https://gitlab.com/congresomfesc/congreso-matematicas.git`

## Running the Application

All application files live under `home/cisemat/public_html/`.

```bash
# Start PHP development server (requires PHP 7.1+ with MySQLi extension)
php -S localhost:8000 -t home/cisemat/public_html

# Database: MySQL — schema name "congreso2023"
# Connection config: home/cisemat/public_html/modelo/conexion.php
```

There is no build step, bundler, test suite, or linter configured. PHP files are served directly.

### Composer Dependencies

Composer is used only for vendored libraries (not at project root):
- `home/cisemat/public_html/components/asistenciaPago/dompdf/` — DOMPDF for HTML-to-PDF
- `home/cisemat/public_html/librerias/PHPMailer/` — email sending

Run `composer install` inside each directory if dependencies are missing.

## Architecture

**Monolithic procedural PHP** with informal MVC separation. No framework (no Laravel/Symfony).

### Directory Layout (under `home/cisemat/public_html/`)

| Directory | Role |
|-----------|------|
| `modelo/` | **Data/business logic layer** — database queries (MySQLi), file handling, email, session auth. ~76 files. Key file: `conexion.php` (DB connection). |
| `components/` | **Feature modules** — each subdirectory is a self-contained feature with its own PHP, JS, and CSS. ~40+ directories (login, registration, paper submission, evaluation, admin panel, etc.). |
| `Layouts/` | **Shared UI templates** — `nav.php`, `footer.php`, `banner.php`, `sidebar.php`, plus reusable `Card*.php` templates. |
| `query/index/` | **Query handlers** — standalone PHP scripts for AJAX/form endpoints. |
| `cartas/` | **Document generation** — certificate/letter PDFs using FPDF. |
| `src/` | **Static assets & user uploads** — images, uploaded papers, posters, payment receipts, logos. |
| `indexado/` | **Document indexing** — processing for conference proceedings. |

### Key Patterns

- **Routing**: Direct file-based — URLs map to PHP files (e.g., `components/inicioSesion/sesion.php` for login).
- **Authentication**: PHP sessions. Key session vars: `$_SESSION['correoElectronico']`, `$_SESSION['id']`, `$_SESSION['foto']`. Passwords use BCrypt.
- **Database access**: Direct `mysqli_query()` calls with `mysqli_real_escape_string()` for sanitization. No ORM or prepared statements in most files.
- **Frontend**: Bootstrap 5.2.2, Font Awesome 5.15.1, Glider.js for carousels. Vanilla JS (no jQuery, no frontend framework).
- **PDF generation**: DOMPDF (in `components/asistenciaPago/dompdf/`) and FPDF (in `cartas/fpdf/`).
- **Email**: PHPMailer (in `librerias/PHPMailer/`).
- **Multi-congress support**: The system supports multiple conference editions with configurable branding (colors, names) stored in DB table `recursos_pagprin`.

### Data Flow

```
User → HTML form (component PHP) → POST → modelo/*.php (validate + query DB) → redirect or render response
```

### Naming Conventions

- Files and variables use **Spanish naming** (e.g., `inicioSesion`, `crearCuenta`, `trabajosRegistrados`, `evaluarExtenso`).
- Model files follow patterns: `traerDatos*.php` (fetch data), `actualizar*.php` (update data).
- Component directories match feature names: `subirTrabajos/` (upload works), `EvaluarTrabajos/` (evaluate works).

## Important Notes

- **Database credentials are hardcoded** in `modelo/conexion.php` and some component files use different credentials (root/empty for local dev). Watch for inconsistent connection configs.
- **Firefox incompatibility**: The app explicitly warns users that Firefox is unsupported (see `index.js`).
- **No `.gitignore`**: User uploads in `src/` (photos, papers, receipts) are in the repo tree.
