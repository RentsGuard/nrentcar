import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { Search, Eye, CheckCircle2, XCircle } from 'lucide-react';
import { Button, Input, Card, Badge } from '../components/ui';
import { mockVerifications, mockCustomers } from '../data/mockData';
import { toast } from 'sonner';
import { format, parseISO } from 'date-fns';
import { id } from 'date-fns/locale';
type TabType = 'Semua' | 'Menunggu' | 'Disetujui' | 'Ditolak';
export function Verification() {
  const navigate = useNavigate();
  const [activeTab, setActiveTab] = useState<TabType>('Semua');
  const [searchTerm, setSearchTerm] = useState('');
  // Join verifications with customer data
  const verificationsWithCustomer = mockVerifications.map((v) => {
    const customer = mockCustomers.find((c) => c.id === v.customerId);
    return {
      ...v,
      customer
    };
  });
  const filteredVerifications = verificationsWithCustomer.filter((v) => {
    const matchesTab = activeTab === 'Semua' || v.status === activeTab;
    const matchesSearch =
    v.customer?.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
    v.customer?.nik.includes(searchTerm);
    return matchesTab && matchesSearch;
  });
  const handleQuickAction = (action: 'Setujui' | 'Tolak', id: string) => {
    toast.success(`Verifikasi berhasil di${action.toLowerCase()}`);
  };
  const getStatusBadge = (status: string) => {
    switch (status) {
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
  const counts = {
    Semua: verificationsWithCustomer.length,
    Menunggu: verificationsWithCustomer.filter((v) => v.status === 'Menunggu').
    length,
    Disetujui: verificationsWithCustomer.filter((v) => v.status === 'Disetujui').
    length,
    Ditolak: verificationsWithCustomer.filter((v) => v.status === 'Ditolak').
    length
  };
  return (
    <div className="space-y-6">
      <div>
        <h1 className="text-2xl font-bold text-white tracking-tight">
          Verifikasi Customer
        </h1>
        <p className="text-white/50 text-sm mt-1">
          Tinjau dan kelola persetujuan dokumen identitas customer.
        </p>
      </div>

      <div className="flex flex-wrap gap-2">
        {(['Semua', 'Menunggu', 'Disetujui', 'Ditolak'] as TabType[]).map(
          (tab) =>
          <button
            key={tab}
            onClick={() => setActiveTab(tab)}
            className={`px-4 py-2 rounded-full text-sm font-medium transition-colors ${activeTab === tab ? 'bg-[#C1121F] text-white' : 'bg-white/[0.05] text-white/70 hover:bg-white/[0.1] hover:text-white'}`}>
            
              {tab} <span className="ml-1 opacity-60">({counts[tab]})</span>
            </button>

        )}
      </div>

      <Card className="p-0">
        <div className="p-4 border-b border-white/[0.05] flex flex-col sm:flex-row gap-4 justify-between items-center bg-white/[0.01]">
          <div className="relative w-full sm:w-72">
            <Search className="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-white/40" />
            <Input
              placeholder="Cari nama atau NIK..."
              className="pl-9 bg-black/20"
              value={searchTerm}
              onChange={(e) => setSearchTerm(e.target.value)} />
            
          </div>
        </div>

        <div className="overflow-x-auto">
          <table className="w-full text-sm text-left">
            <thead className="text-xs text-white/50 uppercase bg-white/[0.02] border-b border-white/[0.05]">
              <tr>
                <th className="px-6 py-4 font-medium">Nama Customer</th>
                <th className="px-6 py-4 font-medium">NIK</th>
                <th className="px-6 py-4 font-medium">Tanggal Daftar</th>
                <th className="px-6 py-4 font-medium">Status</th>
                <th className="px-6 py-4 font-medium text-right">Aksi</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-white/[0.05]">
              {filteredVerifications.map((v) =>
              <tr
                key={v.id}
                className="hover:bg-white/[0.02] transition-colors">
                
                  <td className="px-6 py-4">
                    <div className="flex items-center gap-3">
                      <div className="w-8 h-8 rounded-full bg-white/[0.05] flex items-center justify-center text-white font-medium text-xs">
                        {v.customer?.name.charAt(0)}
                      </div>
                      <div>
                        <div className="font-medium text-white">
                          {v.customer?.name}
                        </div>
                        <div className="text-xs text-white/50">
                          {v.customerId}
                        </div>
                      </div>
                    </div>
                  </td>
                  <td className="px-6 py-4 text-white/80">
                    {v.customer?.nik.replace(/(\d{4})/g, '$1 ').trim()}
                  </td>
                  <td className="px-6 py-4 text-white/80">
                    {format(parseISO(v.date), 'dd MMM yyyy', {
                    locale: id
                  })}
                  </td>
                  <td className="px-6 py-4">{getStatusBadge(v.status)}</td>
                  <td className="px-6 py-4 text-right">
                    <div className="flex items-center justify-end gap-2">
                      {v.status === 'Menunggu' &&
                    <>
                          <Button
                        variant="ghost"
                        size="icon"
                        onClick={() => handleQuickAction('Setujui', v.id)}
                        title="Setujui"
                        className="hover:text-emerald-400 hover:bg-emerald-500/10">
                        
                            <CheckCircle2 className="w-4 h-4" />
                          </Button>
                          <Button
                        variant="ghost"
                        size="icon"
                        onClick={() => handleQuickAction('Tolak', v.id)}
                        title="Tolak"
                        className="hover:text-red-400 hover:bg-red-500/10">
                        
                            <XCircle className="w-4 h-4" />
                          </Button>
                        </>
                    }
                      <Button
                      variant="ghost"
                      size="icon"
                      onClick={() =>
                      navigate(`/verification/${v.customerId}`)
                      }
                      title="Lihat Detail">
                      
                        <Eye className="w-4 h-4 text-white/70" />
                      </Button>
                    </div>
                  </td>
                </tr>
              )}
              {filteredVerifications.length === 0 &&
              <tr>
                  <td
                  colSpan={5}
                  className="px-6 py-8 text-center text-white/50">
                  
                    Tidak ada data verifikasi yang ditemukan.
                  </td>
                </tr>
              }
            </tbody>
          </table>
        </div>

        <div className="p-4 border-t border-white/[0.05] flex items-center justify-between text-sm text-white/50 bg-white/[0.01]">
          <div>Menampilkan {filteredVerifications.length} data</div>
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
    </div>);

}