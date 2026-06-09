import React, { useState } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import {
  ArrowLeft,
  Printer,
  Edit,
  Trash2,
  Car as CarIcon,
  User,
  Calendar,
  CreditCard } from
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
  mockRentals,
  mockCustomers,
  mockCars,
  formatCurrency } from
'../data/mockData';
import { toast } from 'sonner';
import { format, parseISO } from 'date-fns';
import { id as idLocale } from 'date-fns/locale';
export function RentalDetail() {
  const { id } = useParams();
  const navigate = useNavigate();
  const [deleteModalOpen, setDeleteModalOpen] = useState(false);
  const rental = mockRentals.find((r) => r.id === id);
  const customer = mockCustomers.find((c) => c.id === rental?.customerId);
  const car = mockCars.find((c) => c.id === rental?.carId);
  if (!rental || !customer || !car) {
    return (
      <div className="flex flex-col items-center justify-center h-[60vh] text-center space-y-4">
        <h2 className="text-xl font-bold text-white">
          Data Penyewaan tidak ditemukan
        </h2>
        <Button onClick={() => navigate('/rentals')} variant="outline">
          Kembali ke Daftar Penyewaan
        </Button>
      </div>);

  }
  const handlePrint = () => {
    toast.success('Sedang menyiapkan dokumen untuk dicetak...');
    setTimeout(() => window.print(), 1000);
  };
  const handleCancel = () => {
    toast.success('Penyewaan berhasil dibatalkan');
    navigate('/rentals');
  };
  const getStatusBadge = (status: string) => {
    switch (status) {
      case 'Berlangsung':
        return (
          <Badge variant="success" className="text-sm px-3 py-1">
            {status}
          </Badge>);

      case 'Selesai':
        return (
          <Badge variant="default" className="text-sm px-3 py-1">
            {status}
          </Badge>);

      case 'Dibatalkan':
        return (
          <Badge variant="danger" className="text-sm px-3 py-1">
            {status}
          </Badge>);

      case 'Menunggu Konfirmasi':
        return (
          <Badge variant="warning" className="text-sm px-3 py-1">
            {status}
          </Badge>);

      default:
        return <Badge className="text-sm px-3 py-1">{status}</Badge>;
    }
  };
  return (
    <div className="space-y-6 max-w-5xl mx-auto">
      <div className="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 print:hidden">
        <div className="flex items-center gap-4">
          <Button
            variant="ghost"
            size="icon"
            onClick={() => navigate('/rentals')}>
            
            <ArrowLeft className="w-5 h-5" />
          </Button>
          <div>
            <h1 className="text-2xl font-bold text-white tracking-tight">
              Detail Penyewaan
            </h1>
            <p className="text-white/50 text-sm mt-1">
              Invoice dan rincian transaksi.
            </p>
          </div>
        </div>
        <div className="flex gap-2 w-full sm:w-auto">
          <Button
            variant="outline"
            onClick={handlePrint}
            className="flex-1 sm:flex-none">
            
            <Printer className="w-4 h-4 mr-2" /> Cetak Invoice
          </Button>
          <Button
            variant="outline"
            onClick={() => navigate(`/rentals/${rental.id}/edit`)}
            disabled={
            rental.status === 'Selesai' || rental.status === 'Dibatalkan'
            }
            className="flex-1 sm:flex-none">
            
            <Edit className="w-4 h-4 mr-2" /> Edit
          </Button>
          <Button
            variant="outline"
            onClick={() => setDeleteModalOpen(true)}
            disabled={
            rental.status === 'Selesai' || rental.status === 'Dibatalkan'
            }
            className="flex-1 sm:flex-none text-red-400 hover:bg-red-500/10 hover:border-red-500/30">
            
            <Trash2 className="w-4 h-4 mr-2" /> Batalkan
          </Button>
        </div>
      </div>

      <Card className="print:shadow-none print:border-none print:bg-white print:text-black">
        {/* Invoice Header */}
        <div className="p-8 border-b border-white/[0.05] print:border-gray-200 relative overflow-hidden">
          <div className="absolute top-0 left-0 w-full h-2 bg-[#C1121F]" />
          <div className="flex justify-between items-start">
            <div>
              <div className="flex items-center gap-2 mb-4">
                <div className="w-10 h-10 bg-[#C1121F] rounded-lg flex items-center justify-center">
                  <span className="text-white font-bold text-xl">R</span>
                </div>
                <span className="text-xl font-bold text-white print:text-black tracking-tight">
                  RentCar Indonesia
                </span>
              </div>
              <div className="text-white/50 print:text-gray-500 text-sm space-y-1">
                <p>Jl. Sudirman No. 123, Jakarta Selatan</p>
                <p>Telp: +62 812-3456-7890</p>
                <p>Email: info@rentcar.id</p>
              </div>
            </div>
            <div className="text-right">
              <h2 className="text-3xl font-bold text-white print:text-black mb-2">
                INVOICE
              </h2>
              <p className="text-white/80 print:text-gray-700 font-medium mb-1">
                {rental.id}
              </p>
              <p className="text-white/50 print:text-gray-500 text-sm mb-4">
                Tanggal Cetak:{' '}
                {format(new Date(), 'dd MMMM yyyy', {
                  locale: idLocale
                })}
              </p>
              <div className="print:hidden">
                {getStatusBadge(rental.status)}
              </div>
              <div className="hidden print:inline-block px-3 py-1 border border-gray-300 rounded text-sm font-bold uppercase">
                {rental.status}
              </div>
            </div>
          </div>
        </div>

        <CardContent className="p-8 space-y-8">
          {/* Info Cards */}
          <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div className="space-y-4">
              <h3 className="text-lg font-semibold text-white print:text-black flex items-center gap-2 border-b border-white/[0.05] print:border-gray-200 pb-2">
                <User className="w-5 h-5 text-[#C1121F]" /> Informasi Customer
              </h3>
              <div className="grid grid-cols-3 gap-y-3 text-sm">
                <div className="text-white/50 print:text-gray-500">Nama</div>
                <div className="col-span-2 text-white print:text-black font-medium">
                  {customer.name}
                </div>
                <div className="text-white/50 print:text-gray-500">NIK</div>
                <div className="col-span-2 text-white print:text-black">
                  {customer.nik}
                </div>
                <div className="text-white/50 print:text-gray-500">No. HP</div>
                <div className="col-span-2 text-white print:text-black">
                  {customer.phone}
                </div>
                <div className="text-white/50 print:text-gray-500">Email</div>
                <div className="col-span-2 text-white print:text-black">
                  {customer.email}
                </div>
                <div className="text-white/50 print:text-gray-500">Alamat</div>
                <div className="col-span-2 text-white print:text-black">
                  {customer.address}
                </div>
              </div>
            </div>

            <div className="space-y-4">
              <h3 className="text-lg font-semibold text-white print:text-black flex items-center gap-2 border-b border-white/[0.05] print:border-gray-200 pb-2">
                <CarIcon className="w-5 h-5 text-[#C1121F]" /> Informasi Mobil
              </h3>
              <div className="grid grid-cols-3 gap-y-3 text-sm">
                <div className="text-white/50 print:text-gray-500">Mobil</div>
                <div className="col-span-2 text-white print:text-black font-medium">
                  {car.name}
                </div>
                <div className="text-white/50 print:text-gray-500">
                  Plat Nomor
                </div>
                <div className="col-span-2 text-white print:text-black">
                  {car.plate}
                </div>
                <div className="text-white/50 print:text-gray-500">Tahun</div>
                <div className="col-span-2 text-white print:text-black">
                  {car.year}
                </div>
                <div className="text-white/50 print:text-gray-500">
                  Harga/Hari
                </div>
                <div className="col-span-2 text-white print:text-black">
                  {formatCurrency(car.price)}
                </div>
              </div>
            </div>
          </div>

          {/* Table */}
          <div className="space-y-4">
            <h3 className="text-lg font-semibold text-white print:text-black flex items-center gap-2 border-b border-white/[0.05] print:border-gray-200 pb-2">
              <CreditCard className="w-5 h-5 text-[#C1121F]" /> Rincian
              Penyewaan
            </h3>
            <div className="overflow-x-auto">
              <table className="w-full text-sm text-left">
                <thead className="text-xs text-white/50 print:text-gray-500 uppercase bg-white/[0.02] print:bg-gray-50 border-y border-white/[0.05] print:border-gray-200">
                  <tr>
                    <th className="px-4 py-3 font-medium">Deskripsi</th>
                    <th className="px-4 py-3 font-medium">Tanggal Sewa</th>
                    <th className="px-4 py-3 font-medium">Tanggal Kembali</th>
                    <th className="px-4 py-3 font-medium text-center">
                      Lama Sewa
                    </th>
                    <th className="px-4 py-3 font-medium text-right">
                      Subtotal
                    </th>
                  </tr>
                </thead>
                <tbody className="divide-y divide-white/[0.05] print:divide-gray-200">
                  <tr className="text-white print:text-black">
                    <td className="px-4 py-4">
                      Sewa Mobil {car.name} ({car.plate})
                    </td>
                    <td className="px-4 py-4">
                      {format(parseISO(rental.startDate), 'dd MMMM yyyy', {
                        locale: idLocale
                      })}
                    </td>
                    <td className="px-4 py-4">
                      {format(parseISO(rental.endDate), 'dd MMMM yyyy', {
                        locale: idLocale
                      })}
                    </td>
                    <td className="px-4 py-4 text-center">
                      {rental.duration} Hari
                    </td>
                    <td className="px-4 py-4 text-right font-medium">
                      {formatCurrency(rental.total)}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          {/* Total */}
          <div className="flex justify-end">
            <div className="w-full md:w-1/2 lg:w-1/3 space-y-3">
              <div className="flex justify-between text-sm text-white/70 print:text-gray-600 px-4">
                <span>Subtotal</span>
                <span>{formatCurrency(rental.total)}</span>
              </div>
              <div className="flex justify-between text-sm text-white/70 print:text-gray-600 px-4">
                <span>Pajak (0%)</span>
                <span>Rp 0</span>
              </div>
              <div className="flex justify-between items-center bg-[#C1121F]/10 print:bg-gray-100 border border-[#C1121F]/20 print:border-gray-300 p-4 rounded-lg mt-4">
                <span className="font-bold text-white print:text-black">
                  Total Pembayaran
                </span>
                <span className="text-xl font-bold text-[#C1121F] print:text-black">
                  {formatCurrency(rental.total)}
                </span>
              </div>
            </div>
          </div>
        </CardContent>
      </Card>

      <ConfirmDeleteModal
        isOpen={deleteModalOpen}
        onClose={() => setDeleteModalOpen(false)}
        onConfirm={handleCancel}
        title="Batalkan Penyewaan"
        message="Apakah Anda yakin ingin membatalkan penyewaan ini? Tindakan ini tidak dapat diurungkan." />
      
    </div>);

}