import React, { useState } from 'react';
import {
  Download,
  Printer,
  TrendingUp,
  Users,
  Car as CarIcon,
  ShieldCheck } from
'lucide-react';
import {
  Button,
  Card,
  CardHeader,
  CardTitle,
  CardContent } from
'../components/ui';
import {
  chartData,
  mockCars,
  mockCustomers,
  mockRentals,
  mockVerifications,
  formatCurrency } from
'../data/mockData';
import { toast } from 'sonner';
import {
  BarChart,
  Bar,
  XAxis,
  YAxis,
  CartesianGrid,
  Tooltip,
  ResponsiveContainer,
  LineChart,
  Line,
  PieChart,
  Pie,
  Cell } from
'recharts';
import { format, parseISO } from 'date-fns';
import { id as idLocale } from 'date-fns/locale';
type TabType = 'Penyewaan' | 'Customer' | 'Mobil' | 'Verifikasi';
type PeriodType = 'Harian' | 'Mingguan' | 'Bulanan' | 'Tahunan';
export function Reports() {
  const [activeTab, setActiveTab] = useState<TabType>('Penyewaan');
  const [period, setPeriod] = useState<PeriodType>('Bulanan');
  const handleExport = (type: string) => {
    toast.success(`Berhasil export laporan ke ${type}`);
  };
  const handlePrint = () => {
    toast.success('Sedang menyiapkan dokumen untuk dicetak...');
    setTimeout(() => window.print(), 1000);
  };
  // --- MOCK DATA FOR CHARTS ---
  const carUtilization = mockCars.
  map((car) => ({
    name: car.name,
    utilization: Math.floor(Math.random() * 60) + 20,
    totalBookings: Math.floor(Math.random() * 30) + 5
  })).
  sort((a, b) => b.utilization - a.utilization).
  slice(0, 5);
  const verificationStats = [
  {
    name: 'Disetujui',
    value: mockVerifications.filter((v) => v.status === 'Disetujui').length,
    color: '#10b981'
  },
  {
    name: 'Ditolak',
    value: mockVerifications.filter((v) => v.status === 'Ditolak').length,
    color: '#ef4444'
  },
  {
    name: 'Menunggu',
    value: mockVerifications.filter((v) => v.status === 'Menunggu').length,
    color: '#f59e0b'
  }];

  const renderPenyewaanTab = () =>
  <div className="space-y-6">
      <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
        <Card className="p-6">
          <div className="flex items-center gap-4">
            <div className="w-12 h-12 rounded-xl bg-[#C1121F]/10 flex items-center justify-center">
              <TrendingUp className="w-6 h-6 text-[#C1121F]" />
            </div>
            <div>
              <p className="text-sm text-white/50 mb-1">Total Penyewaan</p>
              <h3 className="text-2xl font-bold text-white">842</h3>
            </div>
          </div>
        </Card>
        <Card className="p-6">
          <div className="flex items-center gap-4">
            <div className="w-12 h-12 rounded-xl bg-emerald-500/10 flex items-center justify-center">
              <span className="text-emerald-500 font-bold text-xl">Rp</span>
            </div>
            <div>
              <p className="text-sm text-white/50 mb-1">Total Pendapatan</p>
              <h3 className="text-2xl font-bold text-white">Rp 450M</h3>
            </div>
          </div>
        </Card>
        <Card className="p-6">
          <div className="flex items-center gap-4">
            <div className="w-12 h-12 rounded-xl bg-blue-500/10 flex items-center justify-center">
              <CarIcon className="w-6 h-6 text-blue-500" />
            </div>
            <div>
              <p className="text-sm text-white/50 mb-1">Mobil Terlaris</p>
              <h3 className="text-xl font-bold text-white">Toyota Avanza</h3>
            </div>
          </div>
        </Card>
      </div>

      <Card>
        <CardHeader>
          <CardTitle>Statistik Penyewaan Bulanan</CardTitle>
        </CardHeader>
        <CardContent>
          <div className="h-[300px] w-full">
            <ResponsiveContainer width="100%" height="100%">
              <BarChart data={chartData}>
                <CartesianGrid
                strokeDasharray="3 3"
                stroke="rgba(255,255,255,0.1)"
                vertical={false} />
              
                <XAxis
                dataKey="name"
                stroke="rgba(255,255,255,0.5)"
                fontSize={12}
                tickLine={false}
                axisLine={false} />
              
                <YAxis
                stroke="rgba(255,255,255,0.5)"
                fontSize={12}
                tickLine={false}
                axisLine={false} />
              
                <Tooltip
                contentStyle={{
                  backgroundColor: '#141414',
                  borderColor: 'rgba(255,255,255,0.1)',
                  borderRadius: '8px'
                }}
                itemStyle={{
                  color: '#fff'
                }} />
              
                <Bar dataKey="rentals" fill="#C1121F" radius={[4, 4, 0, 0]} />
              </BarChart>
            </ResponsiveContainer>
          </div>
        </CardContent>
      </Card>

      <Card>
        <CardHeader>
          <CardTitle>10 Penyewaan Terakhir</CardTitle>
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
              {mockRentals.slice(0, 5).map((rental) =>
            <tr key={rental.id}>
                  <td className="px-6 py-4 text-white">{rental.id}</td>
                  <td className="px-6 py-4 text-white/80">
                    {format(parseISO(rental.startDate), 'dd MMM yyyy', {
                  locale: idLocale
                })}
                  </td>
                  <td className="px-6 py-4 text-white/80">
                    {formatCurrency(rental.total)}
                  </td>
                  <td className="px-6 py-4 text-white/80">{rental.status}</td>
                </tr>
            )}
            </tbody>
          </table>
        </div>
      </Card>
    </div>;

  const renderCustomerTab = () =>
  <div className="space-y-6">
      <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
        <Card className="p-6">
          <div className="flex items-center gap-4">
            <div className="w-12 h-12 rounded-xl bg-blue-500/10 flex items-center justify-center">
              <Users className="w-6 h-6 text-blue-500" />
            </div>
            <div>
              <p className="text-sm text-white/50 mb-1">Total Customer</p>
              <h3 className="text-2xl font-bold text-white">
                {mockCustomers.length}
              </h3>
            </div>
          </div>
        </Card>
        <Card className="p-6">
          <div className="flex items-center gap-4">
            <div className="w-12 h-12 rounded-xl bg-emerald-500/10 flex items-center justify-center">
              <TrendingUp className="w-6 h-6 text-emerald-500" />
            </div>
            <div>
              <p className="text-sm text-white/50 mb-1">Baru Bulan Ini</p>
              <h3 className="text-2xl font-bold text-white">+45</h3>
            </div>
          </div>
        </Card>
        <Card className="p-6">
          <div className="flex items-center gap-4">
            <div className="w-12 h-12 rounded-xl bg-purple-500/10 flex items-center justify-center">
              <ShieldCheck className="w-6 h-6 text-purple-500" />
            </div>
            <div>
              <p className="text-sm text-white/50 mb-1">Terverifikasi</p>
              <h3 className="text-2xl font-bold text-white">
                {
              mockCustomers.filter((c) => c.status === 'Terverifikasi').
              length
              }
              </h3>
            </div>
          </div>
        </Card>
      </div>

      <Card>
        <CardHeader>
          <CardTitle>Pertumbuhan Customer</CardTitle>
        </CardHeader>
        <CardContent>
          <div className="h-[300px] w-full">
            <ResponsiveContainer width="100%" height="100%">
              <LineChart data={chartData}>
                <CartesianGrid
                strokeDasharray="3 3"
                stroke="rgba(255,255,255,0.1)"
                vertical={false} />
              
                <XAxis
                dataKey="name"
                stroke="rgba(255,255,255,0.5)"
                fontSize={12}
                tickLine={false}
                axisLine={false} />
              
                <YAxis
                stroke="rgba(255,255,255,0.5)"
                fontSize={12}
                tickLine={false}
                axisLine={false} />
              
                <Tooltip
                contentStyle={{
                  backgroundColor: '#141414',
                  borderColor: 'rgba(255,255,255,0.1)',
                  borderRadius: '8px'
                }}
                itemStyle={{
                  color: '#fff'
                }} />
              
                <Line
                type="monotone"
                dataKey="newCustomers"
                stroke="#3b82f6"
                strokeWidth={3}
                dot={{
                  fill: '#3b82f6',
                  strokeWidth: 2,
                  r: 4
                }}
                activeDot={{
                  r: 6
                }} />
              
              </LineChart>
            </ResponsiveContainer>
          </div>
        </CardContent>
      </Card>
    </div>;

  const renderMobilTab = () =>
  <div className="space-y-6">
      <Card>
        <CardHeader>
          <CardTitle>Tingkat Penggunaan Mobil (Top 5)</CardTitle>
        </CardHeader>
        <CardContent>
          <div className="h-[300px] w-full">
            <ResponsiveContainer width="100%" height="100%">
              <BarChart
              data={carUtilization}
              layout="vertical"
              margin={{
                left: 50
              }}>
              
                <CartesianGrid
                strokeDasharray="3 3"
                stroke="rgba(255,255,255,0.1)"
                horizontal={false} />
              
                <XAxis
                type="number"
                stroke="rgba(255,255,255,0.5)"
                fontSize={12}
                tickLine={false}
                axisLine={false}
                unit="%" />
              
                <YAxis
                dataKey="name"
                type="category"
                stroke="rgba(255,255,255,0.8)"
                fontSize={12}
                tickLine={false}
                axisLine={false}
                width={120} />
              
                <Tooltip
                contentStyle={{
                  backgroundColor: '#141414',
                  borderColor: 'rgba(255,255,255,0.1)',
                  borderRadius: '8px'
                }}
                itemStyle={{
                  color: '#fff'
                }}
                formatter={(value) => [`${value}%`, 'Utilisasi']} />
              
                <Bar
                dataKey="utilization"
                fill="#8b5cf6"
                radius={[0, 4, 4, 0]}
                barSize={24} />
              
              </BarChart>
            </ResponsiveContainer>
          </div>
        </CardContent>
      </Card>

      <Card>
        <CardHeader>
          <CardTitle>Detail Penggunaan</CardTitle>
        </CardHeader>
        <div className="overflow-x-auto">
          <table className="w-full text-sm text-left">
            <thead className="text-xs text-white/50 uppercase bg-white/[0.02] border-y border-white/[0.05]">
              <tr>
                <th className="px-6 py-4 font-medium">Mobil</th>
                <th className="px-6 py-4 font-medium">Total Booking</th>
                <th className="px-6 py-4 font-medium">Utilisasi</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-white/[0.05]">
              {carUtilization.map((car, i) =>
            <tr key={i}>
                  <td className="px-6 py-4 text-white font-medium">
                    {car.name}
                  </td>
                  <td className="px-6 py-4 text-white/80">
                    {car.totalBookings} kali
                  </td>
                  <td className="px-6 py-4">
                    <div className="flex items-center gap-3">
                      <div className="w-full bg-white/10 rounded-full h-2 max-w-[100px]">
                        <div
                      className="bg-[#8b5cf6] h-2 rounded-full"
                      style={{
                        width: `${car.utilization}%`
                      }} />
                    
                      </div>
                      <span className="text-white/80">{car.utilization}%</span>
                    </div>
                  </td>
                </tr>
            )}
            </tbody>
          </table>
        </div>
      </Card>
    </div>;

  const renderVerifikasiTab = () =>
  <div className="space-y-6">
      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <Card>
          <CardHeader>
            <CardTitle>Distribusi Status Verifikasi</CardTitle>
          </CardHeader>
          <CardContent className="flex justify-center">
            <div className="h-[300px] w-full max-w-[400px]">
              <ResponsiveContainer width="100%" height="100%">
                <PieChart>
                  <Pie
                  data={verificationStats}
                  cx="50%"
                  cy="50%"
                  innerRadius={80}
                  outerRadius={120}
                  paddingAngle={5}
                  dataKey="value">
                  
                    {verificationStats.map((entry, index) =>
                  <Cell key={`cell-${index}`} fill={entry.color} />
                  )}
                  </Pie>
                  <Tooltip
                  contentStyle={{
                    backgroundColor: '#141414',
                    borderColor: 'rgba(255,255,255,0.1)',
                    borderRadius: '8px'
                  }}
                  itemStyle={{
                    color: '#fff'
                  }} />
                
                </PieChart>
              </ResponsiveContainer>
            </div>
          </CardContent>
        </Card>

        <Card>
          <CardHeader>
            <CardTitle>Histori Verifikasi Terbaru</CardTitle>
          </CardHeader>
          <div className="overflow-x-auto">
            <table className="w-full text-sm text-left">
              <thead className="text-xs text-white/50 uppercase bg-white/[0.02] border-y border-white/[0.05]">
                <tr>
                  <th className="px-6 py-4 font-medium">Tanggal</th>
                  <th className="px-6 py-4 font-medium">Status</th>
                </tr>
              </thead>
              <tbody className="divide-y divide-white/[0.05]">
                {mockVerifications.slice(0, 5).map((v) =>
              <tr key={v.id}>
                    <td className="px-6 py-4 text-white/80">
                      {format(parseISO(v.date), 'dd MMM yyyy', {
                    locale: idLocale
                  })}
                    </td>
                    <td className="px-6 py-4 text-white/80">{v.status}</td>
                  </tr>
              )}
              </tbody>
            </table>
          </div>
        </Card>
      </div>
    </div>;

  return (
    <div className="space-y-6">
      <div className="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
          <h1 className="text-2xl font-bold text-white tracking-tight">
            Laporan Sistem
          </h1>
          <p className="text-white/50 text-sm mt-1">
            Analitik dan statistik performa rental.
          </p>
        </div>
        <div className="flex gap-2 w-full sm:w-auto">
          <Button
            variant="outline"
            onClick={() => handleExport('PDF')}
            className="flex-1 sm:flex-none">
            
            <Download className="w-4 h-4 mr-2" /> PDF
          </Button>
          <Button
            variant="outline"
            onClick={() => handleExport('Excel')}
            className="flex-1 sm:flex-none">
            
            <Download className="w-4 h-4 mr-2" /> Excel
          </Button>
          <Button
            variant="outline"
            onClick={handlePrint}
            className="flex-1 sm:flex-none">
            
            <Printer className="w-4 h-4 mr-2" /> Cetak
          </Button>
        </div>
      </div>

      <div className="flex flex-col sm:flex-row justify-between gap-4 bg-white/[0.02] p-2 rounded-xl border border-white/[0.05]">
        <div className="flex gap-1 overflow-x-auto pb-2 sm:pb-0 hide-scrollbar">
          {(['Penyewaan', 'Customer', 'Mobil', 'Verifikasi'] as TabType[]).map(
            (tab) =>
            <button
              key={tab}
              onClick={() => setActiveTab(tab)}
              className={`px-4 py-2 rounded-lg text-sm font-medium transition-colors whitespace-nowrap ${activeTab === tab ? 'bg-white/10 text-white' : 'text-white/50 hover:text-white hover:bg-white/5'}`}>
              
                {tab}
              </button>

          )}
        </div>
        <div className="flex gap-1">
          {(['Harian', 'Mingguan', 'Bulanan', 'Tahunan'] as PeriodType[]).map(
            (p) =>
            <button
              key={p}
              onClick={() => setPeriod(p)}
              className={`px-3 py-1.5 rounded-md text-xs font-medium transition-colors ${period === p ? 'bg-[#C1121F] text-white' : 'bg-transparent text-white/50 hover:text-white hover:bg-white/5'}`}>
              
                {p}
              </button>

          )}
        </div>
      </div>

      {activeTab === 'Penyewaan' && renderPenyewaanTab()}
      {activeTab === 'Customer' && renderCustomerTab()}
      {activeTab === 'Mobil' && renderMobilTab()}
      {activeTab === 'Verifikasi' && renderVerifikasiTab()}
    </div>);

}