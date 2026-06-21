export const manifest = {
  screens: {
    scr_uo9yo5: { name: "Login", route: "/login", position: { "x": 160, "y": 220 } },
    scr_fvmdml: { name: "Dashboard", route: "/", position: { "x": 160, "y": 2200 } },
    scr_qi1r0k: { name: "Daftar Customer", route: "/customers", position: { "x": 160, "y": 4180 } },
    scr_hyykgb: { name: "Tambah Customer", route: "/customers/new", position: { "x": 1560, "y": 4180 } },
    scr_geoap3: { name: "Detail Customer", route: "/customers/CUST-001", position: { "x": 2960, "y": 4180 } },
    scr_sqd60q: { name: "Edit Customer", route: "/customers/CUST-001/edit", position: { "x": 4360, "y": 4180 } },
    scr_6k7m04: { name: "Verifikasi Customer", route: "/verification", position: { "x": 160, "y": 6160 } },
    scr_tqswz6: { name: "Detail Verifikasi", route: "/verification/CUST-002", position: { "x": 1560, "y": 6160 } },
    scr_y05kkh: { name: "Daftar Mobil", route: "/cars", position: { "x": 160, "y": 8140 } },
    scr_h615jl: { name: "Tambah Mobil", route: "/cars/new", position: { "x": 1560, "y": 8140 } },
    scr_bw760y: { name: "Detail Mobil", route: "/cars/CAR-001", position: { "x": 2960, "y": 8140 } },
    scr_z1iv9v: { name: "Edit Mobil", route: "/cars/CAR-001/edit", position: { "x": 4360, "y": 8140 } },
    scr_de9w5q: { name: "Daftar Penyewaan", route: "/rentals", position: { "x": 160, "y": 10120 } },
    scr_a5incn: { name: "Wizard Penyewaan Baru", route: "/rentals/new", position: { "x": 1560, "y": 10120 } },
    scr_mjytuy: { name: "Detail Penyewaan", route: "/rentals/RNT-001", position: { "x": 2960, "y": 10120 } },
    scr_kdxav7: { name: "Manajemen Staff", route: "/staff", position: { "x": 160, "y": 12100 } },
    scr_05f592: { name: "Tambah Staff", route: "/staff/new", position: { "x": 1560, "y": 12100 } },
    scr_wvea9w: { name: "Laporan", route: "/reports", position: { "x": 160, "y": 14080 } },
    scr_04hrwd: { name: "Pengaturan", route: "/settings", position: { "x": 1560, "y": 14080 } }
  },
  sections: {
    sec_vlf2ng: { name: "Authentication", x: 0, y: 0, width: 1520, height: 1180 },
    sec_g7ba7u: { name: "Dashboard & Main", x: 0, y: 1980, width: 1520, height: 1180 },
    sec_sfzpuq: { name: "Customer Management", x: 0, y: 3960, width: 5720, height: 1180 },
    sec_wrfrg8: { name: "Customer Verification", x: 0, y: 5940, width: 2920, height: 1180 },
    sec_djoc6q: { name: "Car Management", x: 0, y: 7920, width: 5720, height: 1180 },
    sec_pjbthf: { name: "Rental Management", x: 0, y: 9900, width: 4320, height: 1180 },
    sec_49afii: { name: "Staff Management", x: 0, y: 11880, width: 2920, height: 1180 },
    sec_hpyfo4: { name: "Utilities", x: 0, y: 13860, width: 2920, height: 1180 }
  },
  layers: [
  { kind: "section", id: "sec_vlf2ng", children: [
    { kind: "screen", id: "scr_uo9yo5" }]
  },
  { kind: "section", id: "sec_g7ba7u", children: [
    { kind: "screen", id: "scr_fvmdml" }]
  },
  { kind: "section", id: "sec_sfzpuq", children: [
    { kind: "screen", id: "scr_qi1r0k" },
    { kind: "screen", id: "scr_hyykgb" },
    { kind: "screen", id: "scr_geoap3" },
    { kind: "screen", id: "scr_sqd60q" }]
  },
  { kind: "section", id: "sec_wrfrg8", children: [
    { kind: "screen", id: "scr_6k7m04" },
    { kind: "screen", id: "scr_tqswz6" }]
  },
  { kind: "section", id: "sec_djoc6q", children: [
    { kind: "screen", id: "scr_y05kkh" },
    { kind: "screen", id: "scr_h615jl" },
    { kind: "screen", id: "scr_bw760y" },
    { kind: "screen", id: "scr_z1iv9v" }]
  },
  { kind: "section", id: "sec_pjbthf", children: [
    { kind: "screen", id: "scr_de9w5q" },
    { kind: "screen", id: "scr_a5incn" },
    { kind: "screen", id: "scr_mjytuy" }]
  },
  { kind: "section", id: "sec_49afii", children: [
    { kind: "screen", id: "scr_kdxav7" },
    { kind: "screen", id: "scr_05f592" }]
  },
  { kind: "section", id: "sec_hpyfo4", children: [
    { kind: "screen", id: "scr_wvea9w" },
    { kind: "screen", id: "scr_04hrwd" }]
  }]

};