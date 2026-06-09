# Refactoring — RentsCar

## Completed Refactoring

### 1. Bootstrap 5.3 → Tailwind CSS v4

All Aqsha-owned views rewritten from Bootstrap utility classes to Tailwind v4.

**Changes:**
- Removed Bootstrap CSS CDN from layout
- Removed Bootstrap-specific classes
- Replaced grid system with Tailwind `grid` + `grid-cols-*`
- Replaced Bootstrap utilities with Tailwind equivalents
- No `tailwind.config.js` — v4 uses CSS `@theme {}` block

### 2. Manual JS → Alpine.js

- Sidebar open/close: `x-data`, `x-show`, `@click` replace `classList.toggle()`
- Backdrop overlay: managed via Alpine state
- `x-cloak` prevents FOUC

### 3. Native confirm() → SweetAlert2

- Staff delete confirmation uses `Swal.fire()` with custom styling

### 4. Static Icons → Blade Heroicons

- Dashboard sidebar icon replaced with `@heroicon('squares-2x2', 'solid')`

### 5. Audit Trail

- StaffController logs create/update/delete via Spatie Activitylog

## Pending Refactoring

- None in Aqsha area. Other team members may refactor their assigned CRUDs to Tailwind v4 conventions.
