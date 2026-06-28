import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import {
  Plus,
  Search,
  Download,
  Eye,
  Pencil,
  Trash2,
  ShieldCheck } from
'lucide-react';
import {
  Button,
  Input,
  Card,
  Badge,
  ConfirmDeleteModal } from
'../components/ui';
import { mockCustomers } from '../data/mockData';
import { toast } from 'sonner';
export function Customers() {
  const navigate = useNavigate();
  const [searchTerm, setSearchTerm] = useState('');
  const [deleteModalOpen, setDeleteModalOpen] = useState(false);
  const [selectedId, setSelectedId] = useState<string | null>(null);
  const filteredCustomers = mockCustomers.filter(
    (c) =>
    c.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
    c.email.toLowerCase().includes(searchTerm.toLowerCase())
  );
  const handleDelete = () => {
    toast.success('Customer berhasil dihapus');
  };
  const exportData = (type: string) => {
    toast.success(`Berhasil export data ke ${type}`);
  };
  return (
    <div className="space-y-6">
      <div className="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
          <h1 className="text-2xl font-bold text-white tracking-tight">
            Manajemen Customer
          </h1>
          <p className="text-white/50 text-sm mt-1">
            Kelola data customer dan status verifikasi.
          </p>
        </div>
        <Button
          onClick={() => navigate('/customers/new')}
          className="w-full sm:w-auto">
          
          <Plus className="w-4 h-4 mr-2" /> Tambah Customer
        </Button>
      </div>

      <Card className="p-0">
        <div className="p-4 border-b border-white/[0.05] flex flex-col sm:flex-row gap-4 justify-between items-center bg-white/[0.01]">
          <div className="relative w-full sm:w-72">
            <Search className="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-white/40" />
            <Input
              placeholder="Cari nama atau email..."
              className="pl-9 bg-black/20"
              value={searchTerm}
              onChange={(e) => setSearchTerm(e.target.value)} />
            
          </div>
          <div className="flex items-center gap-2 w-full sm:w-auto">
            <Button
              variant="outline"
              size="sm"
              onClick={() => exportData('PDF')}
              className="flex-1 sm:flex-none">
              
              <Download className="w-4 h-4 mr-2" /> PDF
            </Button>
            <Button
              variant="outline"
              size="sm"
              onClick={() => exportData('Excel')}
              className="flex-1 sm:flex-none">
              
              <Download className="w-4 h-4 mr-2" /> Excel
            </Button>
          </div>
        </div>

        <div className="overflow-x-auto">
          <table className="w-full text-sm text-left">
            <thead className="text-xs text-white/50 uppercase bg-white/[0.02] border-b border-white/[0.05]">
              <tr>
                <th className="px-6 py-4 font-medium">Customer</th>
                <th className="px-6 py-4 font-medium">Kontak</th>
                <th className="px-6 py-4 font-medium">NIK</th>
                <th className="px-6 py-4 font-medium">Status</th>
                <th className="px-6 py-4 font-medium text-right">Aksi</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-white/[0.05]">
              {filteredCustomers.map((customer) =>
              <tr
                key={customer.id}
                className="hover:bg-white/[0.02] transition-colors">
                
                  <td className="px-6 py-4">
                    <div className="flex items-center gap-3">
                      <div className="w-8 h-8 rounded-full bg-white/[0.05] flex items-center justify-center text-white font-medium text-xs">
                        {customer.name.charAt(0)}
                      </div>
                      <div>
                        <div className="font-medium text-white">
                          {customer.name}
                        </div>
                        <div className="text-xs text-white/50">
                          {customer.id}
                        </div>
                      </div>
                    </div>
                  </td>
                  <td className="px-6 py-4">
                    <div className="text-white/80">{customer.email}</div>
                    <div className="text-xs text-white/50">
                      {customer.phone}
                    </div>
                  </td>
                  <td className="px-6 py-4 text-white/80">
                    {customer.nik.replace(/(\d{4})/g, '$1 ').trim()}
                  </td>
                  <td className="px-6 py-4">
                    <Badge
                    variant={
                    customer.status === 'Terverifikasi' ?
                    'success' :
                    customer.status === 'Ditolak' ?
                    'danger' :
                    'warning'
                    }>
                    
                      {customer.status}
                    </Badge>
                  </td>
                  <td className="px-6 py-4 text-right">
                    <div className="flex items-center justify-end gap-2">
                      <Button
                      variant="ghost"
                      size="icon"
                      onClick={() => navigate(`/customers/${customer.id}`)}
                      title="Detail">
                      
                        <Eye className="w-4 h-4 text-white/70" />
                      </Button>
                      <Button
                      variant="ghost"
                      size="icon"
                      onClick={() => navigate(`/verification/${customer.id}`)}
                      title="Verifikasi">
                      
                        <ShieldCheck className="w-4 h-4 text-white/70" />
                      </Button>
                      <Button
                      variant="ghost"
                      size="icon"
                      onClick={() =>
                      navigate(`/customers/${customer.id}/edit`)
                      }
                      title="Edit">
                      
                        <Pencil className="w-4 h-4 text-white/70" />
                      </Button>
                      <Button
                      variant="ghost"
                      size="icon"
                      onClick={() => {
                        setSelectedId(customer.id);
                        setDeleteModalOpen(true);
                      }}
                      title="Hapus"
                      className="hover:text-red-400 hover:bg-red-500/10">
                      
                        <Trash2 className="w-4 h-4" />
                      </Button>
                    </div>
                  </td>
                </tr>
              )}
            </tbody>
          </table>
        </div>

        <div className="p-4 border-t border-white/[0.05] flex items-center justify-between text-sm text-white/50 bg-white/[0.01]">
          <div>
            Menampilkan 1 hingga {filteredCustomers.length} dari{' '}
            {mockCustomers.length} data
          </div>
          <div className="flex gap-1">
            <Button variant="outline" size="sm" disabled>
              Sebelumnya
            </Button>
            <Button variant="outline" size="sm" className="bg-white/[0.05]">
              1
            </Button>
            <Button variant="outline" size="sm">
              Berikutnya
            </Button>
          </div>
        </div>
      </Card>

      <ConfirmDeleteModal
        isOpen={deleteModalOpen}
        onClose={() => setDeleteModalOpen(false)}
        onConfirm={handleDelete} />
      
    </div>);

}