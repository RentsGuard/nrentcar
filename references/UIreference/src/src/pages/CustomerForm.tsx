import React, { useState } from 'react';
import { useNavigate, useParams } from 'react-router-dom';
import { ArrowLeft, Save } from 'lucide-react';
import { Button, Input, Textarea, Card, CardContent } from '../components/ui';
import { mockCustomers } from '../data/mockData';
import { toast } from 'sonner';
export function CustomerForm() {
  const { id } = useParams();
  const navigate = useNavigate();
  const isEdit = Boolean(id);
  const existingData = isEdit ? mockCustomers.find((c) => c.id === id) : null;
  const [formData, setFormData] = useState({
    name: existingData?.name || '',
    email: existingData?.email || '',
    phone: existingData?.phone || '',
    nik: existingData?.nik || '',
    address: existingData?.address || ''
  });
  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    toast.success(
      isEdit ?
      'Data customer berhasil diperbarui' :
      'Customer baru berhasil ditambahkan'
    );
    navigate('/customers');
  };
  return (
    <div className="max-w-3xl mx-auto space-y-6">
      <div className="flex items-center gap-4">
        <Button
          variant="ghost"
          size="icon"
          onClick={() => navigate('/customers')}
          className="rounded-full bg-white/[0.03]">
          
          <ArrowLeft className="w-5 h-5" />
        </Button>
        <div>
          <h1 className="text-2xl font-bold text-white tracking-tight">
            {isEdit ? 'Edit Customer' : 'Tambah Customer Baru'}
          </h1>
          <p className="text-white/50 text-sm mt-1">
            Lengkapi form di bawah ini dengan data yang valid.
          </p>
        </div>
      </div>

      <Card>
        <CardContent className="p-6 sm:p-8">
          <form onSubmit={handleSubmit} className="space-y-6">
            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div className="space-y-2">
                <label className="text-sm font-medium text-white/80">
                  Nama Lengkap <span className="text-red-500">*</span>
                </label>
                <Input
                  required
                  placeholder="Masukkan nama lengkap"
                  value={formData.name}
                  onChange={(e) =>
                  setFormData({
                    ...formData,
                    name: e.target.value
                  })
                  } />
                
              </div>

              <div className="space-y-2">
                <label className="text-sm font-medium text-white/80">
                  Nomor Induk Kependudukan (NIK){' '}
                  <span className="text-red-500">*</span>
                </label>
                <Input
                  required
                  placeholder="16 digit NIK"
                  maxLength={16}
                  pattern="\d{16}"
                  title="NIK harus 16 digit angka"
                  value={formData.nik}
                  onChange={(e) =>
                  setFormData({
                    ...formData,
                    nik: e.target.value
                  })
                  } />
                
              </div>

              <div className="space-y-2">
                <label className="text-sm font-medium text-white/80">
                  Email <span className="text-red-500">*</span>
                </label>
                <Input
                  required
                  type="email"
                  placeholder="email@contoh.com"
                  value={formData.email}
                  onChange={(e) =>
                  setFormData({
                    ...formData,
                    email: e.target.value
                  })
                  } />
                
              </div>

              <div className="space-y-2">
                <label className="text-sm font-medium text-white/80">
                  Nomor HP/WhatsApp <span className="text-red-500">*</span>
                </label>
                <Input
                  required
                  placeholder="Contoh: 081234567890"
                  value={formData.phone}
                  onChange={(e) =>
                  setFormData({
                    ...formData,
                    phone: e.target.value
                  })
                  } />
                
              </div>
            </div>

            <div className="space-y-2">
              <label className="text-sm font-medium text-white/80">
                Alamat Lengkap <span className="text-red-500">*</span>
              </label>
              <Textarea
                required
                placeholder="Masukkan alamat lengkap sesuai KTP"
                rows={4}
                value={formData.address}
                onChange={(e) =>
                setFormData({
                  ...formData,
                  address: e.target.value
                })
                } />
              
            </div>

            <div className="pt-4 flex justify-end gap-3 border-t border-white/[0.05]">
              <Button
                type="button"
                variant="ghost"
                onClick={() => navigate('/customers')}>
                
                Batal
              </Button>
              <Button type="submit">
                <Save className="w-4 h-4 mr-2" /> Simpan Data
              </Button>
            </div>
          </form>
        </CardContent>
      </Card>
    </div>);

}