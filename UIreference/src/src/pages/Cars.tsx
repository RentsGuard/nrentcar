import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import {
  Plus,
  Search,
  LayoutGrid,
  List,
  Filter,
  Edit,
  Trash2,
  Eye,
  Fuel,
  Users } from
'lucide-react';
import {
  Button,
  Input,
  Card,
  Badge,
  ConfirmDeleteModal } from
'../components/ui';
import { mockCars, formatCurrency } from '../data/mockData';
import { toast } from 'sonner';
export function Cars() {
  const navigate = useNavigate();
  const [view, setView] = useState<'grid' | 'table'>('grid');
  const [searchTerm, setSearchTerm] = useState('');
  const [deleteModalOpen, setDeleteModalOpen] = useState(false);
  const filteredCars = mockCars.filter(
    (c) =>
    c.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
    c.plate.toLowerCase().includes(searchTerm.toLowerCase())
  );
  const getStatusBadge = (status: string) => {
    switch (status) {
      case 'Tersedia':
        return <Badge variant="success">Tersedia</Badge>;
      case 'Disewa':
        return <Badge variant="danger">Disewa</Badge>;
      case 'Maintenance':
        return <Badge variant="warning">Maintenance</Badge>;
      default:
        return <Badge>{status}</Badge>;
    }
  };
  return (
    <div className="space-y-6">
      <div className="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
          <h1 className="text-2xl font-bold text-white tracking-tight">
            Manajemen Mobil
          </h1>
          <p className="text-white/50 text-sm mt-1">
            Kelola armada kendaraan dan status ketersediaan.
          </p>
        </div>
        <Button
          onClick={() => navigate('/cars/new')}
          className="w-full sm:w-auto">
          
          <Plus className="w-4 h-4 mr-2" /> Tambah Mobil
        </Button>
      </div>

      <div className="flex flex-col sm:flex-row gap-4 justify-between items-center bg-[#141414]/50 p-4 rounded-xl border border-white/[0.05]">
        <div className="flex items-center gap-3 w-full sm:w-auto">
          <div className="relative w-full sm:w-72">
            <Search className="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-white/40" />
            <Input
              placeholder="Cari nama atau plat nomor..."
              className="pl-9 bg-black/20"
              value={searchTerm}
              onChange={(e) => setSearchTerm(e.target.value)} />
            
          </div>
          <Button variant="outline" size="icon" className="shrink-0">
            <Filter className="w-4 h-4" />
          </Button>
        </div>

        <div className="flex items-center gap-1 bg-black/40 p-1 rounded-lg border border-white/[0.05]">
          <button
            onClick={() => setView('grid')}
            className={`p-2 rounded-md transition-colors ${view === 'grid' ? 'bg-white/10 text-white' : 'text-white/50 hover:text-white'}`}>
            
            <LayoutGrid className="w-4 h-4" />
          </button>
          <button
            onClick={() => setView('table')}
            className={`p-2 rounded-md transition-colors ${view === 'table' ? 'bg-white/10 text-white' : 'text-white/50 hover:text-white'}`}>
            
            <List className="w-4 h-4" />
          </button>
        </div>
      </div>

      {view === 'grid' ?
      <div className="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
          {filteredCars.map((car) =>
        <Card
          key={car.id}
          className="group flex flex-col hover:border-white/[0.15] transition-all duration-300">
          
              <div className="relative h-48 overflow-hidden bg-black/50">
                <img
              src={car.image}
              alt={car.name}
              className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
            
                <div className="absolute top-3 right-3">
                  {getStatusBadge(car.status)}
                </div>
                <div className="absolute bottom-3 left-3 flex gap-2">
                  <Badge
                variant="outline"
                className="bg-black/60 backdrop-blur-md border-white/10">
                
                    {car.type}
                  </Badge>
                  <Badge
                variant="outline"
                className="bg-black/60 backdrop-blur-md border-white/10">
                
                    {car.year}
                  </Badge>
                </div>
              </div>
              <div className="p-5 flex-1 flex flex-col">
                <div className="flex justify-between items-start mb-2">
                  <div>
                    <h3 className="text-lg font-bold text-white">{car.name}</h3>
                    <p className="text-sm text-white/50">{car.plate}</p>
                  </div>
                  <div className="text-right">
                    <div className="text-lg font-bold text-[#C1121F]">
                      {formatCurrency(car.price)}
                    </div>
                    <div className="text-xs text-white/40">/ hari</div>
                  </div>
                </div>

                <div className="grid grid-cols-2 gap-3 mt-4 mb-6">
                  <div className="flex items-center gap-2 text-sm text-white/70">
                    <Users className="w-4 h-4 text-white/40" /> {car.capacity}{' '}
                    Kursi
                  </div>
                  <div className="flex items-center gap-2 text-sm text-white/70">
                    <Fuel className="w-4 h-4 text-white/40" /> {car.fuel}
                  </div>
                </div>

                <div className="mt-auto pt-4 border-t border-white/[0.05] flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                  <Button
                variant="secondary"
                className="flex-1"
                onClick={() => navigate(`/cars/${car.id}`)}>
                
                    Detail
                  </Button>
                  <Button
                variant="outline"
                size="icon"
                onClick={() => navigate(`/cars/${car.id}/edit`)}>
                
                    <Edit className="w-4 h-4" />
                  </Button>
                  <Button
                variant="outline"
                size="icon"
                className="text-red-400 hover:bg-red-500/10 hover:border-red-500/30"
                onClick={() => setDeleteModalOpen(true)}>
                
                    <Trash2 className="w-4 h-4" />
                  </Button>
                </div>
              </div>
            </Card>
        )}
        </div> :

      <Card className="p-0 overflow-hidden">
          <div className="overflow-x-auto">
            <table className="w-full text-sm text-left">
              <thead className="text-xs text-white/50 uppercase bg-white/[0.02] border-b border-white/[0.05]">
                <tr>
                  <th className="px-6 py-4 font-medium">Mobil</th>
                  <th className="px-6 py-4 font-medium">Spesifikasi</th>
                  <th className="px-6 py-4 font-medium">Harga/Hari</th>
                  <th className="px-6 py-4 font-medium">Status</th>
                  <th className="px-6 py-4 font-medium text-right">Aksi</th>
                </tr>
              </thead>
              <tbody className="divide-y divide-white/[0.05]">
                {filteredCars.map((car) =>
              <tr
                key={car.id}
                className="hover:bg-white/[0.02] transition-colors">
                
                    <td className="px-6 py-4">
                      <div className="flex items-center gap-4">
                        <div className="w-16 h-12 rounded bg-black/50 overflow-hidden shrink-0">
                          <img
                        src={car.image}
                        alt={car.name}
                        className="w-full h-full object-cover" />
                      
                        </div>
                        <div>
                          <div className="font-medium text-white">
                            {car.name}
                          </div>
                          <div className="text-xs text-white/50">
                            {car.plate}
                          </div>
                        </div>
                      </div>
                    </td>
                    <td className="px-6 py-4">
                      <div className="text-white/80">
                        {car.type} • {car.year}
                      </div>
                      <div className="text-xs text-white/50">
                        {car.capacity} Kursi • {car.fuel}
                      </div>
                    </td>
                    <td className="px-6 py-4 font-medium text-[#C1121F]">
                      {formatCurrency(car.price)}
                    </td>
                    <td className="px-6 py-4">{getStatusBadge(car.status)}</td>
                    <td className="px-6 py-4 text-right">
                      <div className="flex items-center justify-end gap-2">
                        <Button
                      variant="ghost"
                      size="icon"
                      onClick={() => navigate(`/cars/${car.id}`)}>
                      
                          <Eye className="w-4 h-4 text-white/70" />
                        </Button>
                        <Button
                      variant="ghost"
                      size="icon"
                      onClick={() => navigate(`/cars/${car.id}/edit`)}>
                      
                          <Edit className="w-4 h-4 text-white/70" />
                        </Button>
                        <Button
                      variant="ghost"
                      size="icon"
                      onClick={() => setDeleteModalOpen(true)}
                      className="hover:text-red-400">
                      
                          <Trash2 className="w-4 h-4" />
                        </Button>
                      </div>
                    </td>
                  </tr>
              )}
              </tbody>
            </table>
          </div>
        </Card>
      }

      <ConfirmDeleteModal
        isOpen={deleteModalOpen}
        onClose={() => setDeleteModalOpen(false)}
        onConfirm={() => toast.success('Mobil berhasil dihapus')} />
      
    </div>);

}