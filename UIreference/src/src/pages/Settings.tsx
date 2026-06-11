import React, { useState } from 'react';
import {
  User,
  Lock,
  Settings as SettingsIcon,
  Upload,
  Eye,
  EyeOff } from
'lucide-react';
import {
  Button,
  Input,
  Card,
  CardContent,
  Textarea,
  Select } from
'../components/ui';
import { toast } from 'sonner';
type TabType = 'Profil' | 'Password' | 'Sistem';
export function Settings() {
  const [activeTab, setActiveTab] = useState<TabType>('Profil');
  const [showPassword, setShowPassword] = useState({
    old: false,
    new: false,
    confirm: false
  });
  const handleSave = (e: React.FormEvent) => {
    e.preventDefault();
    toast.success('Pengaturan berhasil disimpan');
  };
  const handleReset = () => {
    toast.info('Form dikembalikan ke nilai awal');
  };
  const renderProfil = () =>
  <form onSubmit={handleSave} className="space-y-6">
      <div>
        <h2 className="text-lg font-semibold text-white mb-1">
          Profil Pengguna
        </h2>
        <p className="text-sm text-white/50 mb-6">
          Kelola informasi profil akun Anda.
        </p>
      </div>

      <div className="flex items-center gap-6 mb-8">
        <div className="w-20 h-20 rounded-full bg-white/[0.05] border border-white/10 flex items-center justify-center text-white font-bold text-2xl">
          A
        </div>
        <div>
          <Button type="button" variant="outline" size="sm" className="mb-2">
            <Upload className="w-4 h-4 mr-2" /> Ubah Foto
          </Button>
          <p className="text-xs text-white/40">
            JPG, GIF atau PNG. Maksimal 1MB.
          </p>
        </div>
      </div>

      <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div className="space-y-2">
          <label className="text-sm font-medium text-white/80">
            Nama Lengkap
          </label>
          <Input defaultValue="Admin Utama" />
        </div>
        <div className="space-y-2">
          <label className="text-sm font-medium text-white/80">Email</label>
          <Input type="email" defaultValue="admin@rentcar.id" />
        </div>
        <div className="space-y-2">
          <label className="text-sm font-medium text-white/80">Nomor HP</label>
          <Input defaultValue="+62 812-3456-7890" />
        </div>
      </div>

      <div className="pt-6 border-t border-white/[0.05] flex gap-3">
        <Button type="submit" variant="primary">
          Simpan Perubahan
        </Button>
        <Button type="button" variant="ghost" onClick={handleReset}>
          Reset
        </Button>
      </div>
    </form>;

  const renderPassword = () =>
  <form onSubmit={handleSave} className="space-y-6">
      <div>
        <h2 className="text-lg font-semibold text-white mb-1">Ubah Password</h2>
        <p className="text-sm text-white/50 mb-6">
          Pastikan akun Anda menggunakan password yang kuat.
        </p>
      </div>

      <div className="space-y-4 max-w-md">
        <div className="space-y-2">
          <label className="text-sm font-medium text-white/80">
            Password Lama
          </label>
          <div className="relative">
            <Input
            type={showPassword.old ? 'text' : 'password'}
            placeholder="Masukkan password lama" />
          
            <button
            type="button"
            className="absolute right-3 top-1/2 -translate-y-1/2 text-white/40 hover:text-white/80"
            onClick={() =>
            setShowPassword({
              ...showPassword,
              old: !showPassword.old
            })
            }>
            
              {showPassword.old ?
            <EyeOff className="w-4 h-4" /> :

            <Eye className="w-4 h-4" />
            }
            </button>
          </div>
        </div>

        <div className="space-y-2">
          <label className="text-sm font-medium text-white/80">
            Password Baru
          </label>
          <div className="relative">
            <Input
            type={showPassword.new ? 'text' : 'password'}
            placeholder="Minimal 8 karakter" />
          
            <button
            type="button"
            className="absolute right-3 top-1/2 -translate-y-1/2 text-white/40 hover:text-white/80"
            onClick={() =>
            setShowPassword({
              ...showPassword,
              new: !showPassword.new
            })
            }>
            
              {showPassword.new ?
            <EyeOff className="w-4 h-4" /> :

            <Eye className="w-4 h-4" />
            }
            </button>
          </div>
        </div>

        <div className="space-y-2">
          <label className="text-sm font-medium text-white/80">
            Konfirmasi Password Baru
          </label>
          <div className="relative">
            <Input
            type={showPassword.confirm ? 'text' : 'password'}
            placeholder="Ulangi password baru" />
          
            <button
            type="button"
            className="absolute right-3 top-1/2 -translate-y-1/2 text-white/40 hover:text-white/80"
            onClick={() =>
            setShowPassword({
              ...showPassword,
              confirm: !showPassword.confirm
            })
            }>
            
              {showPassword.confirm ?
            <EyeOff className="w-4 h-4" /> :

            <Eye className="w-4 h-4" />
            }
            </button>
          </div>
        </div>
      </div>

      <div className="pt-6 border-t border-white/[0.05] flex gap-3">
        <Button type="submit" variant="primary">
          Perbarui Password
        </Button>
        <Button type="button" variant="ghost" onClick={handleReset}>
          Batal
        </Button>
      </div>
    </form>;

  const renderSistem = () =>
  <form onSubmit={handleSave} className="space-y-6">
      <div>
        <h2 className="text-lg font-semibold text-white mb-1">
          Pengaturan Sistem
        </h2>
        <p className="text-sm text-white/50 mb-6">
          Konfigurasi umum aplikasi rental mobil.
        </p>
      </div>

      <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div className="space-y-2">
          <label className="text-sm font-medium text-white/80">
            Nama Perusahaan
          </label>
          <Input defaultValue="RentCar Indonesia" />
        </div>
        <div className="space-y-2">
          <label className="text-sm font-medium text-white/80">
            Nomor Telepon
          </label>
          <Input defaultValue="+62 812-3456-7890" />
        </div>
        <div className="space-y-2 md:col-span-2">
          <label className="text-sm font-medium text-white/80">
            Alamat Perusahaan
          </label>
          <Textarea defaultValue="Jl. Sudirman No. 123, Jakarta Selatan" />
        </div>
        <div className="space-y-2">
          <label className="text-sm font-medium text-white/80">
            Default Pajak (%)
          </label>
          <Input type="number" defaultValue="11" />
        </div>
        <div className="space-y-2">
          <label className="text-sm font-medium text-white/80">Mata Uang</label>
          <Select defaultValue="IDR">
            <option value="IDR">IDR - Rupiah</option>
            <option value="USD">USD - US Dollar</option>
          </Select>
        </div>
      </div>

      <div className="pt-6 border-t border-white/[0.05] flex gap-3">
        <Button type="submit" variant="primary">
          Simpan Pengaturan
        </Button>
        <Button type="button" variant="ghost" onClick={handleReset}>
          Reset
        </Button>
      </div>
    </form>;

  return (
    <div className="space-y-6 max-w-5xl mx-auto">
      <div>
        <h1 className="text-2xl font-bold text-white tracking-tight">
          Pengaturan
        </h1>
        <p className="text-white/50 text-sm mt-1">
          Kelola preferensi akun dan sistem.
        </p>
      </div>

      <div className="flex flex-col md:flex-row gap-8">
        {/* Sidebar Tabs */}
        <div className="w-full md:w-64 shrink-0 flex flex-col gap-2">
          <button
            onClick={() => setActiveTab('Profil')}
            className={`flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-colors ${activeTab === 'Profil' ? 'bg-[#C1121F]/10 text-[#C1121F]' : 'text-white/70 hover:bg-white/[0.05] hover:text-white'}`}>
            
            <User className="w-5 h-5" /> Profil Pengguna
          </button>
          <button
            onClick={() => setActiveTab('Password')}
            className={`flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-colors ${activeTab === 'Password' ? 'bg-[#C1121F]/10 text-[#C1121F]' : 'text-white/70 hover:bg-white/[0.05] hover:text-white'}`}>
            
            <Lock className="w-5 h-5" /> Ubah Password
          </button>
          <button
            onClick={() => setActiveTab('Sistem')}
            className={`flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-colors ${activeTab === 'Sistem' ? 'bg-[#C1121F]/10 text-[#C1121F]' : 'text-white/70 hover:bg-white/[0.05] hover:text-white'}`}>
            
            <SettingsIcon className="w-5 h-5" /> Pengaturan Sistem
          </button>
        </div>

        {/* Content Area */}
        <Card className="flex-1">
          <CardContent className="p-6 md:p-8">
            {activeTab === 'Profil' && renderProfil()}
            {activeTab === 'Password' && renderPassword()}
            {activeTab === 'Sistem' && renderSistem()}
          </CardContent>
        </Card>
      </div>
    </div>);

}