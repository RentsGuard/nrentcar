import React, { useState } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import { ArrowLeft, ZoomIn, FileText, User } from 'lucide-react';
import {
  Button,
  Card,
  CardHeader,
  CardTitle,
  CardContent,
  Badge,
  Select,
  Textarea } from
'../components/ui';
import { mockCustomers, mockVerifications } from '../data/mockData';
import { toast } from 'sonner';
export function VerificationDetail() {
  const { id: customerId } = useParams();
  const navigate = useNavigate();
  const customer = mockCustomers.find((c) => c.id === customerId);
  const verification = mockVerifications.find(
    (v) => v.customerId === customerId
  );
  const [status, setStatus] = useState(verification?.status || 'Menunggu');
  const [notes, setNotes] = useState(verification?.notes || '');
  if (!customer) {
    return (
      <div className="flex flex-col items-center justify-center h-[60vh] text-center space-y-4">
        <h2 className="text-xl font-bold text-white">
          Customer tidak ditemukan
        </h2>
        <Button onClick={() => navigate('/verification')} variant="outline">
          Kembali ke Verifikasi
        </Button>
      </div>);

  }
  const handleSave = () => {
    toast.success('Status verifikasi berhasil disimpan');
    navigate('/verification');
  };
  const handleQuickAction = (newStatus: string) => {
    setStatus(newStatus);
    toast.success(`Status diubah menjadi ${newStatus}`);
    navigate('/verification');
  };
  return (
    <div className="space-y-6">
      <div className="flex items-center gap-4">
        <Button
          variant="ghost"
          size="icon"
          onClick={() => navigate('/verification')}>
          
          <ArrowLeft className="w-5 h-5" />
        </Button>
        <div>
          <h1 className="text-2xl font-bold text-white tracking-tight">
            Detail Verifikasi
          </h1>
          <p className="text-white/50 text-sm mt-1">
            Tinjau dokumen identitas customer.
          </p>
        </div>
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {/* Left Column: Customer Data & Documents */}
        <div className="space-y-6">
          <Card>
            <CardHeader>
              <CardTitle className="flex items-center gap-2">
                <User className="w-5 h-5 text-[#C1121F]" /> Data Customer
              </CardTitle>
            </CardHeader>
            <CardContent>
              <div className="grid grid-cols-2 gap-4 text-sm">
                <div>
                  <div className="text-white/50 mb-1">Nama Lengkap</div>
                  <div className="text-white font-medium">{customer.name}</div>
                </div>
                <div>
                  <div className="text-white/50 mb-1">NIK</div>
                  <div className="text-white font-medium">{customer.nik}</div>
                </div>
                <div>
                  <div className="text-white/50 mb-1">Email</div>
                  <div className="text-white font-medium">{customer.email}</div>
                </div>
                <div>
                  <div className="text-white/50 mb-1">Nomor HP</div>
                  <div className="text-white font-medium">{customer.phone}</div>
                </div>
                <div className="col-span-2">
                  <div className="text-white/50 mb-1">Alamat</div>
                  <div className="text-white font-medium">
                    {customer.address}
                  </div>
                </div>
              </div>
            </CardContent>
          </Card>

          <Card>
            <CardHeader>
              <CardTitle className="flex items-center gap-2">
                <FileText className="w-5 h-5 text-[#C1121F]" /> Dokumen
                Identitas
              </CardTitle>
            </CardHeader>
            <CardContent className="space-y-4">
              <div className="space-y-2">
                <div className="flex justify-between items-center">
                  <span className="text-sm font-medium text-white">
                    KTP (Kartu Tanda Penduduk)
                  </span>
                  <Badge variant="warning">Belum Diverifikasi</Badge>
                </div>
                <div className="relative group rounded-lg overflow-hidden border border-white/[0.1] bg-black/50 aspect-[1.6]">
                  <img
                    src="https://images.unsplash.com/photo-1621972750749-0fbb1abb7736?auto=format&fit=crop&q=80&w=800"
                    alt="KTP Placeholder"
                    className="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity" />
                  
                  <div className="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 bg-black/40 transition-opacity cursor-pointer">
                    <ZoomIn className="w-8 h-8 text-white" />
                  </div>
                </div>
              </div>

              <div className="space-y-2">
                <div className="flex justify-between items-center">
                  <span className="text-sm font-medium text-white">
                    SIM (Surat Izin Mengemudi)
                  </span>
                  <Badge variant="warning">Belum Diverifikasi</Badge>
                </div>
                <div className="relative group rounded-lg overflow-hidden border border-white/[0.1] bg-black/50 aspect-[1.6]">
                  <img
                    src="https://images.unsplash.com/photo-1589828136366-2679803328e5?auto=format&fit=crop&q=80&w=800"
                    alt="SIM Placeholder"
                    className="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity" />
                  
                  <div className="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 bg-black/40 transition-opacity cursor-pointer">
                    <ZoomIn className="w-8 h-8 text-white" />
                  </div>
                </div>
              </div>
            </CardContent>
          </Card>
        </div>

        {/* Right Column: Verification Form */}
        <div>
          <Card className="sticky top-6">
            <CardHeader>
              <CardTitle>Form Verifikasi</CardTitle>
            </CardHeader>
            <CardContent className="space-y-6">
              <div className="space-y-4">
                <div>
                  <label className="block text-sm font-medium text-white/80 mb-2">
                    Status Verifikasi
                  </label>
                  <Select
                    value={status}
                    onChange={(e) => setStatus(e.target.value)}>
                    
                    <option value="Menunggu">Menunggu</option>
                    <option value="Disetujui">Disetujui</option>
                    <option value="Ditolak">Ditolak</option>
                  </Select>
                </div>

                <div>
                  <label className="block text-sm font-medium text-white/80 mb-2">
                    Catatan Verifikasi
                  </label>
                  <Textarea
                    placeholder="Tambahkan catatan jika dokumen ditolak atau ada hal yang perlu diperhatikan..."
                    value={notes}
                    onChange={(e) => setNotes(e.target.value)}
                    className="min-h-[120px]" />
                  
                </div>

                <div className="grid grid-cols-2 gap-4 text-sm text-white/50 bg-white/[0.02] p-4 rounded-lg border border-white/[0.05]">
                  <div>
                    <span className="block mb-1">Tanggal Verifikasi</span>
                    <span className="text-white font-medium">
                      {new Date().toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric'
                      })}
                    </span>
                  </div>
                  <div>
                    <span className="block mb-1">Diverifikasi Oleh</span>
                    <span className="text-white font-medium">
                      Admin Utama (USR-001)
                    </span>
                  </div>
                </div>
              </div>

              <div className="pt-4 border-t border-white/[0.05] flex flex-col gap-3">
                {status === 'Menunggu' ?
                <div className="grid grid-cols-2 gap-3">
                    <Button
                    variant="outline"
                    className="text-red-400 border-red-500/30 hover:bg-red-500/10"
                    onClick={() => handleQuickAction('Ditolak')}>
                    
                      Tolak
                    </Button>
                    <Button
                    variant="primary"
                    onClick={() => handleQuickAction('Disetujui')}>
                    
                      Setujui
                    </Button>
                  </div> :

                <Button
                  variant="primary"
                  className="w-full"
                  onClick={handleSave}>
                  
                    Simpan Perubahan
                  </Button>
                }
              </div>
            </CardContent>
          </Card>
        </div>
      </div>
    </div>);

}