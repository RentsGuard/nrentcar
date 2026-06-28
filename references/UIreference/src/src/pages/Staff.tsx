import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { Plus, Search, Edit, Trash2 } from 'lucide-react';
import {
  Button,
  Input,
  Card,
  Badge,
  ConfirmDeleteModal } from
'../components/ui';
import { mockStaff } from '../data/mockData';
import { toast } from 'sonner';
export function Staff() {
  const navigate = useNavigate();
  const [searchTerm, setSearchTerm] = useState('');
  const [deleteModalOpen, setDeleteModalOpen] = useState(false);
  const [selectedId, setSelectedId] = useState<string | null>(null);
  const filteredStaff = mockStaff.filter(
    (s) =>
    s.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
    s.email.toLowerCase().includes(searchTerm.toLowerCase())
  );
  const handleDelete = () => {
    toast.success('Staff berhasil dihapus');
  };
  return (
    <div className="space-y-6">
      <div className="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
          <h1 className="text-2xl font-bold text-white tracking-tight">
            Manajemen Staff
          </h1>
          <p className="text-white/50 text-sm mt-1">
            Kelola akun pengguna dan hak akses sistem.
          </p>
        </div>
        <Button
          onClick={() => navigate('/staff/new')}
          className="w-full sm:w-auto">
          
          <Plus className="w-4 h-4 mr-2" /> Tambah Staff
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
        </div>

        <div className="overflow-x-auto">
          <table className="w-full text-sm text-left">
            <thead className="text-xs text-white/50 uppercase bg-white/[0.02] border-b border-white/[0.05]">
              <tr>
                <th className="px-6 py-4 font-medium">Nama Staff</th>
                <th className="px-6 py-4 font-medium">Email</th>
                <th className="px-6 py-4 font-medium">Role</th>
                <th className="px-6 py-4 font-medium text-right">Aksi</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-white/[0.05]">
              {filteredStaff.map((staff) =>
              <tr
                key={staff.id}
                className="hover:bg-white/[0.02] transition-colors">
                
                  <td className="px-6 py-4">
                    <div className="flex items-center gap-3">
                      <div className="w-8 h-8 rounded-full bg-white/[0.05] flex items-center justify-center text-white font-medium text-xs">
                        {staff.name.charAt(0)}
                      </div>
                      <div>
                        <div className="font-medium text-white">
                          {staff.name}
                        </div>
                        <div className="text-xs text-white/50">{staff.id}</div>
                      </div>
                    </div>
                  </td>
                  <td className="px-6 py-4 text-white/80">{staff.email}</td>
                  <td className="px-6 py-4">
                    {staff.role === 'Pemilik' ?
                  <Badge className="bg-[#C1121F]/20 text-[#C1121F] border border-[#C1121F]/30">
                        {staff.role}
                      </Badge> :

                  <Badge variant="outline">{staff.role}</Badge>
                  }
                  </td>
                  <td className="px-6 py-4 text-right">
                    <div className="flex items-center justify-end gap-2">
                      <Button
                      variant="ghost"
                      size="icon"
                      onClick={() => navigate(`/staff/${staff.id}/edit`)}
                      title="Edit">
                      
                        <Edit className="w-4 h-4 text-white/70" />
                      </Button>
                      <Button
                      variant="ghost"
                      size="icon"
                      onClick={() => {
                        setSelectedId(staff.id);
                        setDeleteModalOpen(true);
                      }}
                      title="Hapus"
                      className="hover:text-red-400 hover:bg-red-500/10"
                      disabled={staff.role === 'Pemilik'} // Prevent deleting owner
                    >
                        <Trash2 className="w-4 h-4" />
                      </Button>
                    </div>
                  </td>
                </tr>
              )}
              {filteredStaff.length === 0 &&
              <tr>
                  <td
                  colSpan={4}
                  className="px-6 py-8 text-center text-white/50">
                  
                    Tidak ada data staff yang ditemukan.
                  </td>
                </tr>
              }
            </tbody>
          </table>
        </div>

        <div className="p-4 border-t border-white/[0.05] flex items-center justify-between text-sm text-white/50 bg-white/[0.01]">
          <div>Menampilkan {filteredStaff.length} data</div>
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
        title="Hapus Staff"
        message="Apakah Anda yakin ingin menghapus akun staff ini? Tindakan ini tidak dapat dibatalkan." />
      
    </div>);

}