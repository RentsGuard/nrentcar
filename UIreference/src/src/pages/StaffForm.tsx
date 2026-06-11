import React, { useEffect, useState } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import { ArrowLeft, Eye, EyeOff } from 'lucide-react';
import { Button, Input, Select, Card, CardContent } from '../components/ui';
import { mockStaff } from '../data/mockData';
import { toast } from 'sonner';
export function StaffForm() {
  const { id } = useParams();
  const navigate = useNavigate();
  const isEdit = Boolean(id);
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    password: '',
    role: 'Staff'
  });
  const [errors, setErrors] = useState<Record<string, string>>({});
  const [showPassword, setShowPassword] = useState(false);
  useEffect(() => {
    if (isEdit && id) {
      const staff = mockStaff.find((s) => s.id === id);
      if (staff) {
        setFormData({
          name: staff.name,
          email: staff.email,
          password: '',
          role: staff.role
        });
      } else {
        toast.error('Staff tidak ditemukan');
        navigate('/staff');
      }
    }
  }, [id, isEdit, navigate]);
  const handleChange = (
  e: React.ChangeEvent<HTMLInputElement | HTMLSelectElement>) =>
  {
    const { name, value } = e.target;
    setFormData((prev) => ({
      ...prev,
      [name]: value
    }));
    if (errors[name]) {
      setErrors((prev) => ({
        ...prev,
        [name]: ''
      }));
    }
  };
  const validate = () => {
    const newErrors: Record<string, string> = {};
    if (!formData.name) newErrors.name = 'Nama wajib diisi';
    if (!formData.email) newErrors.email = 'Email wajib diisi';else
    if (!/\S+@\S+\.\S+/.test(formData.email))
    newErrors.email = 'Format email tidak valid';
    if (!isEdit && !formData.password)
    newErrors.password = 'Password wajib diisi';
    setErrors(newErrors);
    return Object.keys(newErrors).length === 0;
  };
  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    if (validate()) {
      toast.success(
        isEdit ?
        'Data staff berhasil diperbarui' :
        'Staff baru berhasil ditambahkan'
      );
      navigate('/staff');
    }
  };
  return (
    <div className="space-y-6 max-w-2xl mx-auto">
      <div className="flex items-center gap-4">
        <Button variant="ghost" size="icon" onClick={() => navigate('/staff')}>
          <ArrowLeft className="w-5 h-5" />
        </Button>
        <div>
          <h1 className="text-2xl font-bold text-white tracking-tight">
            {isEdit ? 'Edit Staff' : 'Tambah Staff'}
          </h1>
          <p className="text-white/50 text-sm mt-1">
            {isEdit ?
            'Perbarui informasi akun staff.' :
            'Buat akun baru untuk pengguna sistem.'}
          </p>
        </div>
      </div>

      <form onSubmit={handleSubmit}>
        <Card>
          <CardContent className="p-6 space-y-6">
            <div className="space-y-2">
              <label className="text-sm font-medium text-white/80">
                Nama Lengkap
              </label>
              <Input
                name="name"
                value={formData.name}
                onChange={handleChange}
                placeholder="Masukkan nama lengkap"
                error={errors.name} />
              
            </div>

            <div className="space-y-2">
              <label className="text-sm font-medium text-white/80">Email</label>
              <Input
                name="email"
                type="email"
                value={formData.email}
                onChange={handleChange}
                placeholder="nama@rentcar.id"
                error={errors.email} />
              
            </div>

            <div className="space-y-2">
              <label className="text-sm font-medium text-white/80">
                {isEdit ?
                'Password Baru (Kosongkan jika tidak ingin mengubah)' :
                'Password'}
              </label>
              <div className="relative">
                <Input
                  name="password"
                  type={showPassword ? 'text' : 'password'}
                  value={formData.password}
                  onChange={handleChange}
                  placeholder={
                  isEdit ? 'Masukkan password baru' : 'Masukkan password'
                  }
                  error={errors.password} />
                
                <button
                  type="button"
                  className="absolute right-3 top-1/2 -translate-y-1/2 text-white/40 hover:text-white/80 transition-colors"
                  onClick={() => setShowPassword(!showPassword)}>
                  
                  {showPassword ?
                  <EyeOff className="w-4 h-4" /> :

                  <Eye className="w-4 h-4" />
                  }
                </button>
              </div>
            </div>

            <div className="space-y-2">
              <label className="text-sm font-medium text-white/80">Role</label>
              <Select name="role" value={formData.role} onChange={handleChange}>
                <option value="Staff">Staff</option>
                <option value="Pemilik">Pemilik</option>
              </Select>
            </div>

            <div className="pt-6 border-t border-white/[0.05] flex justify-end gap-3">
              <Button
                type="button"
                variant="ghost"
                onClick={() => navigate('/staff')}>
                
                Batal
              </Button>
              <Button type="submit" variant="primary">
                Simpan Data
              </Button>
            </div>
          </CardContent>
        </Card>
      </form>
    </div>);

}