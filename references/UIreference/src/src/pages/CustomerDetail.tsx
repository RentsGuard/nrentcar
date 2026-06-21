import React, { useState } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import {
  ArrowLeft,
  Edit,
  Trash2,
  ShieldCheck,
  Mail,
  Phone,
  MapPin,
  CreditCard,
  Calendar,
  Clock,
  CheckCircle2,
  XCircle } from
'lucide-react';
import {
  Button,
  Card,
  CardHeader,
  CardTitle,
  CardContent,
  Badge,
  ConfirmDeleteModal } from
'../components/ui';
import {
  mockCustomers,
  mockRentals,
  mockVerifications,
  formatCurrency } from
'../data/mockData';
import { toast } from 'sonner';
import { format, parseISO } from 'date-fns';
import { id } from 'date-fns/locale';
export function CustomerDetail() {
  const { id: customerId } = useParams();
  const navigate = useNavigate();
  const [deleteModalOpen, setDeleteModalOpen] = useState(false);
  const customer = mockCustomers.find((c) => c.id === customerId);
  const customerRentals = mockRentals.filter((r) => r.customerId === customerId);
  const customerVerification = mockVerifications.find(
    (v) => v.customerId === customerId
  );
  if (!customer) {
    return (
      <div className="flex flex-col items-center justify-center h-[60vh] text-center space-y-4">
        <h2 className="text-xl font-bold text-white">
          Customer tidak ditemukan
        </h2>
        <Button onClick={() => navigate('/customers')} variant="outline">
          Kembali ke Daftar Customer
        </Button>
      </div>);

  }
  const handleDelete = () => {
    toast.success('Customer berhasil dihapus');
    navigate('/customers');
  };
  const getStatusBadge = (status: string) => {
    switch (status) {
      case 'Terverifikasi':
      case 'Disetujui':
        return <Badge variant="success">{status}</Badge>;
      case 'Ditolak':
        return <Badge variant="danger">{status}</Badge>;
      case 'Menunggu':
        return <Badge variant="warning">{status}</Badge>;
      default:
        return <Badge>{status}</Badge>;
    }
  };
  const getRentalStatusBadge = (status: string) => {
    switch (status) {
      case 'Berlangsung':
        return <Badge variant="success">{status}</Badge>;
      case 'Selesai':
        return <Badge variant="default">{status}</Badge>;
      case 'Dibatalkan':
        return <Badge variant="danger">{status}</Badge>;
      case 'Menunggu Konfirmasi':
        return <Badge variant="warning">{status}</Badge>;
      default:
        return <Badge>{status}</Badge>;
    }
  };
  return (
    <div className="space-y-6">
      <div className="flex items-center gap-4">
        <Button
          variant="ghost"
          size="icon"
          onClick={() => navigate('/customers')}>
          
          <ArrowLeft className="w-5 h-5" />
        </Button>
        <div>
          <h1 className="text-2xl font-bold text-white tracking-tight">
            Detail Customer
          </h1>
          <p className="text-white/50 text-sm mt-1">
            Informasi lengkap dan riwayat penyewaan.
          </p>
        </div>
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {/* Left Column: Profile & Actions */}
        <div className="space-y-6">
          <Card className="flex flex-col items-center text-center p-6">
            <div className="w-24 h-24 rounded-full bg-white/[0.05] border-2 border-white/10 flex items-center justify-center text-white font-bold text-3xl mb-4">
              {customer.name.charAt(0)}
            </div>
            <h2 className="text-xl font-bold text-white mb-1">
              {customer.name}
            </h2>
            <p className="text-white/50 text-sm mb-4">{customer.id}</p>
            {getStatusBadge(customer.status)}

            <div className="w-full grid grid-cols-1 gap-2 mt-6">
              <Button
                variant="outline"
                className="w-full justify-start"
                onClick={() => navigate(`/customers/${customer.id}/edit`)}>
                
                <Edit className="w-4 h-4 mr-2" /> Edit Data
              </Button>
              <Button
                variant="outline"
                className="w-full justify-start"
                onClick={() => navigate(`/verification/${customer.id}`)}>
                
                <ShieldCheck className="w-4 h-4 mr-2" /> Verifikasi Dokumen
              </Button>
              <Button
                variant="outline"
                className="w-full justify-start text-red-400 hover:bg-red-500/10 hover:border-red-500/30 hover:text-red-400"
                onClick={() => setDeleteModalOpen(true)}>
                
                <Trash2 className="w-4 h-4 mr-2" /> Hapus Customer
              </Button>
            </div>
          </Card>

          <Card>
            <CardHeader>
              <CardTitle>Status Verifikasi</CardTitle>
            </CardHeader>
            <CardContent>
              {customerVerification ?
              <div className="space-y-4">
                  <div className="flex items-center gap-3">
                    {customerVerification.status === 'Disetujui' ?
                  <CheckCircle2 className="w-5 h-5 text-emerald-400" /> :
                  customerVerification.status === 'Ditolak' ?
                  <XCircle className="w-5 h-5 text-red-400" /> :

                  <Clock className="w-5 h-5 text-amber-400" />
                  }
                    <div>
                      <div className="font-medium text-white">
                        {customerVerification.status}
                      </div>
                      <div className="text-xs text-white/50">
                        {format(
                        parseISO(customerVerification.date),
                        'dd MMMM yyyy',
                        {
                          locale: id
                        }
                      )}
                      </div>
                    </div>
                  </div>
                  {customerVerification.notes &&
                <div className="p-3 rounded-lg bg-white/[0.03] border border-white/[0.05] text-sm text-white/80">
                      <span className="text-white/50 block mb-1 text-xs">
                        Catatan:
                      </span>
                      {customerVerification.notes}
                    </div>
                }
                </div> :

              <div className="text-center py-4 text-white/50 text-sm">
                  Belum ada data verifikasi.
                </div>
              }
            </CardContent>
          </Card>
        </div>

        {/* Right Column: Details & History */}
        <div className="lg:col-span-2 space-y-6">
          <Card>
            <CardHeader>
              <CardTitle>Informasi Pribadi</CardTitle>
            </CardHeader>
            <CardContent>
              <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div className="space-y-1">
                  <div className="flex items-center gap-2 text-white/50 text-sm mb-1">
                    <Mail className="w-4 h-4" /> Email
                  </div>
                  <div className="text-white font-medium">{customer.email}</div>
                </div>
                <div className="space-y-1">
                  <div className="flex items-center gap-2 text-white/50 text-sm mb-1">
                    <Phone className="w-4 h-4" /> Nomor HP
                  </div>
                  <div className="text-white font-medium">{customer.phone}</div>
                </div>
                <div className="space-y-1">
                  <div className="flex items-center gap-2 text-white/50 text-sm mb-1">
                    <CreditCard className="w-4 h-4" /> NIK
                  </div>
                  <div className="text-white font-medium">
                    {customer.nik.replace(/(\d{4})/g, '$1 ').trim()}
                  </div>
                </div>
                <div className="space-y-1">
                  <div className="flex items-center gap-2 text-white/50 text-sm mb-1">
                    <Calendar className="w-4 h-4" /> Tanggal Bergabung
                  </div>
                  <div className="text-white font-medium">
                    {format(parseISO(customer.joinDate), 'dd MMMM yyyy', {
                      locale: id
                    })}
                  </div>
                </div>
                <div className="space-y-1 md:col-span-2">
                  <div className="flex items-center gap-2 text-white/50 text-sm mb-1">
                    <MapPin className="w-4 h-4" /> Alamat
                  </div>
                  <div className="text-white font-medium">
                    {customer.address}
                  </div>
                </div>
              </div>
            </CardContent>
          </Card>

          <Card>
            <CardHeader>
              <CardTitle>Riwayat Penyewaan</CardTitle>
            </CardHeader>
            <div className="overflow-x-auto">
              <table className="w-full text-sm text-left">
                <thead className="text-xs text-white/50 uppercase bg-white/[0.02] border-y border-white/[0.05]">
                  <tr>
                    <th className="px-6 py-4 font-medium">ID Sewa</th>
                    <th className="px-6 py-4 font-medium">Tanggal</th>
                    <th className="px-6 py-4 font-medium">Total</th>
                    <th className="px-6 py-4 font-medium">Status</th>
                  </tr>
                </thead>
                <tbody className="divide-y divide-white/[0.05]">
                  {customerRentals.length > 0 ?
                  customerRentals.map((rental) =>
                  <tr
                    key={rental.id}
                    className="hover:bg-white/[0.02] transition-colors">
                    
                        <td className="px-6 py-4 font-medium text-white">
                          <button
                        onClick={() => navigate(`/rentals/${rental.id}`)}
                        className="hover:text-[#C1121F] transition-colors">
                        
                            {rental.id}
                          </button>
                        </td>
                        <td className="px-6 py-4 text-white/80">
                          {format(parseISO(rental.startDate), 'dd MMM yyyy', {
                        locale: id
                      })}{' '}
                          -{' '}
                          {format(parseISO(rental.endDate), 'dd MMM yyyy', {
                        locale: id
                      })}
                        </td>
                        <td className="px-6 py-4 text-white/80">
                          {formatCurrency(rental.total)}
                        </td>
                        <td className="px-6 py-4">
                          {getRentalStatusBadge(rental.status)}
                        </td>
                      </tr>
                  ) :

                  <tr>
                      <td
                      colSpan={4}
                      className="px-6 py-8 text-center text-white/50">
                      
                        Belum ada riwayat penyewaan.
                      </td>
                    </tr>
                  }
                </tbody>
              </table>
            </div>
          </Card>
        </div>
      </div>

      <ConfirmDeleteModal
        isOpen={deleteModalOpen}
        onClose={() => setDeleteModalOpen(false)}
        onConfirm={handleDelete} />
      
    </div>);

}