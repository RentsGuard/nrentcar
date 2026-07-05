# Features - RentsCar

## Implemented

| Feature | Status | Notes |
|---------|--------|-------|
| Login/Logout | Done | Role-based redirect, session regeneration, login throttle 5 attempts |
| Admin Dashboard | Done | Stat cards, Chart.js revenue/customer charts, recent data |
| Staff Dashboard | Done | Operational dashboard for staff role |
| Staff CRUD | Done | Admin-only index, create, edit, delete, password reset |
| Landing Page | Done | Public hero, available car grid, WhatsApp contact, map |
| Public Car Listing | Done | Search/filter/sort, visible-car only, mobile quick nav |
| Public Car Detail | Done | Visible-car only, WhatsApp CTA, no public plate-number exposure |
| Error Pages | Done | 403, 404, 500, 503 dark theme |
| Customer CRUD | Done | Full KTP fields, private `foto_ktp` storage, verification workflow |
| Customer Verification | Done | Admin-only approve/reject and verification notes |
| Mobil CRUD | Done | Photo upload, status management, visibility toggle, activity log |
| Penyewaan CRUD | Done | Verified-customer dropdown, available-car dropdown, duration and price calculation |
| Pengembalian + Denda | Done | Return recording, late fee calculation, damage fine, paid/unpaid fine status |
| Profile | Done | Profile photo upload and password change |
| Laporan | Done | Summary cards, Chart.js preview, PDF export, date filtering |
| Pengaturan | Done | Admin-only appearance, notification, role/access views |
| Activity Log | Done | Spatie Activitylog for important internal actions |
| Seeders | Done | Users, cars, customers, rentals, returns, verification data |
| Testing | Done | Feature tests for auth, authorization, customer, mobil, penyewaan, pengembalian, PDF |

## Public-Hosting Hardening

| Area | Status | Notes |
|------|--------|-------|
| KTP privacy | Done | New uploads use private disk and authenticated image route |
| Hidden car protection | Done | `/cars/{id}` only serves cars with `is_visible = true` |
| Public fleet privacy | Done | Public search/detail do not expose plate numbers |
| Settings access | Done | All settings routes and sidebar links are admin-only |
| Session defaults | Done | `.env.example` enables encrypted, secure, HTTP-only sessions |
| Security headers | Done | Global middleware sends frame, content-type, referrer, permissions, and CSP headers |

## Deferred

| Feature | Reason |
|---------|--------|
| Public online booking form | Current public flow uses WhatsApp confirmation, which matches the current project scope |
| Payment gateway | Not part of current project scope |
| Multi-tenant rental companies | Mentioned in early planning, but not implemented in this single-business prototype |
