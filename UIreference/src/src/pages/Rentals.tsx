import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { Plus, Search, Eye, Edit, Trash2, Filter } from 'lucide-react';
import {
  Button,
  Input,
  Card,
  Badge,
  ConfirmDeleteModal,
  Select } from
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
export function Rentals() {
  const navigate = useNavigate();
  const [searchTerm, setSearchTerm] = useState('');
  const [statusFilter, setStatusFilter] = useState('Semua');
  const [deleteModalOpen, setDeleteModalOpen] = useState(false);
  const [selectedId, setSelectedId] = useState<string | null>(null);
  // Join rentals with customer and car data
  const enrichedRentals = mockRentals.map((rental) => {
    const customer = mockCustomers.find((c) => c.id === rental.customerId);
    const car = mockCars.find((c) => c.id === rental.carId);
    return {
      ...rental,
      customer,
      car
    };
  });
  const filteredRentals = enrichedRentals.filter((r) => {
    const matchesSearch =
    r.id.toLowerCase().includes(searchTerm.toLowerCase()) ||
    r.customer?.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
    r.car?.name.toLowerCase().includes(searchTerm.toLowerCase());
    const matchesStatus = statusFilter === 'Semua' || r.status === statusFilter;
    return matchesSearch && matchesStatus;
  });
  const handleDelete = () => {
    toast.success('Penyewaan berhasil dibatalkan/dihapus');
  };
  const getStatusBadge = (status: string) => {
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
      <div className="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
          <h1 className="text-2xl font-bold text-white tracking-tight">
            Daftar Penyewaan
          </h1>
          <p className="text-white/50 text-sm mt-1">
            Kelola transaksi penyewaan mobil.
          </p>
        </div>
        <Button
          onClick={() => navigate('/rentals/new')}
          className="w-full sm:w-auto">
          
          <Plus className="w-4 h-4 mr-2" /> Tambah Penyewaan
        </Button>
      </div>

      <Card className="p-0">
        <div className="p-4 border-b border-white/[0.05] flex flex-col sm:flex-row gap-4 justify-between items-center bg-white/[0.01]">
          <div className="relative w-full sm:w-72">
            <Search className="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-white/40" />
            <Input
              placeholder="Cari ID, customer, atau mobil..."
              className="pl-9 bg-black/20"
              value={searchTerm}
              onChange={(e) => setSearchTerm(e.target.value)} />
            
          </div>
          <div className="flex items-center gap-2 w-full sm:w-auto">
            <Filter className="w-4 h-4 text-white/40" />
            <Select
              value={statusFilter}
              onChange={(e) => setStatusFilter(e.target.value)}
              className="w-full sm:w-48 bg-black/20">
              
              <option value="Semua">Semua Status</option>
              <option value="Berlangsung">Berlangsung</option>
              <option value="Selesai">Selesai</option>
              <option value="Menunggu Konfirmasi">Menunggu Konfirmasi</option>
              <option value="Dibatalkan">Dibatalkan</option>
            </Select>
          </div>
        </div>

        <div className="overflow-x-auto">
          <table className="w-full text-sm text-left">
            <thead className="text-xs text-white/50 uppercase bg-white/[0.02] border-b border-white/[0.05]">
              <tr>
                <th className="px-6 py-4 font-medium">ID Sewa</th>
                <th className="px-6 py-4 font-medium">Customer</th>
                <th className="px-6 py-4 font-medium">Mobil</th>
                <th className="px-6 py-4 font-medium">Periode Sewa</th>
                <th className="px-6 py-4 font-medium">Total Harga</th>
                <th className="px-6 py-4 font-medium">Status</th>
                <th className="px-6 py-4 font-medium text-right">Aksi</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-white/[0.05]">
              {filteredRentals.map((rental) =>
              <tr
                key={rental.id}
                className="hover:bg-white/[0.02] transition-colors">
                
                  <td className="px-6 py-4 font-medium text-white">
                    {rental.id}
                  </td>
                  <td className="px-6 py-4">
                    <div className="font-medium text-white">
                      {rental.customer?.name}
                    </div>
                    <div className="text-xs text-white/50">
                      {rental.customer?.phone}
                    </div>
                  </td>
                  <td className="px-6 py-4">
                    <div className="flex items-center gap-3">
                      <div className="w-10 h-7 rounded bg-black/50 overflow-hidden shrink-0">
                        <img
                        src={rental.car?.image}
                        alt={rental.car?.name}
                        className="w-full h-full object-cover" />
                      
                      </div>
                      <div>
                        <div className="font-medium text-white">
                          {rental.car?.name}
                        </div>
                        <div className="text-xs text-white/50">
                          {rental.car?.plate}
                        </div>
                      </div>
                    </div>
                  </td>
                  <td className="px-6 py-4">
                    <div className="text-white/80">
                      {format(parseISO(rental.startDate), 'dd MMM yyyy', {
                      locale: idLocale
                    })}{' '}
                      -
                    </div>
                    <div className="text-white/80">
                      {format(parseISO(rental.endDate), 'dd MMM yyyy', {
                      locale: idLocale
                    })}
                    </div>
                    <div className="text-xs text-white/50 mt-1">
                      {rental.duration} Hari
                    </div>
                  </td>
                  <td className="px-6 py-4 font-medium text-[#C1121F]">
                    {formatCurrency(rental.total)}
                  </td>
                  <td className="px-6 py-4">{getStatusBadge(rental.status)}</td>
                  <td className="px-6 py-4 text-right">
                    <div className="flex items-center justify-end gap-2">
                      <Button
                      variant="ghost"
                      size="icon"
                      onClick={() => navigate(`/rentals/${rental.id}`)}
                      title="Detail">
                      
                        <Eye className="w-4 h-4 text-white/70" />
                      </Button>
                      <Button
                      variant="ghost"
                      size="icon"
                      onClick={() => navigate(`/rentals/${rental.id}/edit`)}
                      title="Edit"
                      disabled={
                      rental.status === 'Selesai' ||
                      rental.status === 'Dibatalkan'
                      }>
                      
                        <Edit className="w-4 h-4 text-white/70" />
                      </Button>
                      <Button
                      variant="ghost"
                      size="icon"
                      onClick={() => {
                        setSelectedId(rental.id);
                        setDeleteModalOpen(true);
                      }}
                      title="Batalkan"
                      className="hover:text-red-400 hover:bg-red-500/10"
                      disabled={
                      rental.status === 'Selesai' ||
                      rental.status === 'Dibatalkan'
                      }>
                      
                        <Trash2 className="w-4 h-4" />
                      </Button>
                    </div>
                  </td>
                </tr>
              )}
              {filteredRentals.length === 0 &&
              <tr>
                  <td
                  colSpan={7}
                  className="px-6 py-8 text-center text-white/50">
                  
                    Tidak ada data penyewaan yang ditemukan.
                  </td>
                </tr>
              }
            </tbody>
          </table>
        </div>

        <div className="p-4 border-t border-white/[0.05] flex items-center justify-between text-sm text-white/50 bg-white/[0.01]">
          <div>Menampilkan {filteredRentals.length} data</div>
          <div className="flex gap-1">
            <Button variant="outline" size="sm" disabled>
              Sebelumnya
            </Button>
            <Button variant="outline" size="sm" className="bg-white/[0.05]">
              1
            </Button>
            <Button variant="outline" size="sm" disabled>
              Berikutnya
            </Button>
          </div>
        </div>
      </Card>

      <ConfirmDeleteModal
        isOpen={deleteModalOpen}
        onClose={() => setDeleteModalOpen(false)}
        onConfirm={handleDelete}
        title="Batalkan Penyewaan"
        message="Apakah Anda yakin ingin membatalkan penyewaan ini? Tindakan ini tidak dapat diurungkan." />
      
    </div>);

}