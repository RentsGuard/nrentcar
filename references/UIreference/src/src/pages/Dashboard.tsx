import React from 'react';
import { motion } from 'framer-motion';
import {
  Car,
  Users,
  CalendarRange,
  DollarSign,
  TrendingUp,
  ShieldCheck,
  ArrowUpRight,
  ArrowDownRight } from
'lucide-react';
import {
  AreaChart,
  Area,
  XAxis,
  YAxis,
  CartesianGrid,
  Tooltip,
  ResponsiveContainer,
  BarChart,
  Bar } from
'recharts';
import {
  Card,
  CardContent,
  CardHeader,
  CardTitle,
  Badge } from
'../components/ui';
import {
  chartData,
  mockRentals,
  mockCustomers,
  formatCurrency } from
'../data/mockData';
const StatCard = ({
  title,
  value,
  icon: Icon,
  trend,
  trendValue,
  delay
}: any) =>
<motion.div
  initial={{
    opacity: 0,
    y: 20
  }}
  animate={{
    opacity: 1,
    y: 0
  }}
  transition={{
    delay,
    duration: 0.4
  }}>
  
    <Card className="h-full">
      <CardContent className="p-6 flex flex-col justify-between h-full">
        <div className="flex justify-between items-start mb-4">
          <div className="p-3 rounded-lg bg-white/[0.04] border border-white/[0.05]">
            <Icon className="w-5 h-5 text-white/70" />
          </div>
          <Badge
          variant={trend === 'up' ? 'success' : 'danger'}
          className="flex items-center gap-1">
          
            {trend === 'up' ?
          <ArrowUpRight className="w-3 h-3" /> :

          <ArrowDownRight className="w-3 h-3" />
          }
            {trendValue}
          </Badge>
        </div>
        <div>
          <p className="text-sm font-medium text-white/50 mb-1">{title}</p>
          <h3 className="text-2xl font-bold text-white">{value}</h3>
        </div>
      </CardContent>
    </Card>
  </motion.div>;

export function Dashboard() {
  const recentRentals = mockRentals.slice(0, 5);
  const recentCustomers = mockCustomers.slice(0, 5);
  return (
    <div className="space-y-6">
      <div className="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
          <h1 className="text-2xl font-bold text-white tracking-tight">
            Dashboard
          </h1>
          <p className="text-white/50 text-sm mt-1">
            Selamat datang kembali, Admin. Berikut ringkasan hari ini.
          </p>
        </div>
        <div className="text-sm text-white/60 bg-white/[0.03] px-4 py-2 rounded-lg border border-white/[0.05]">
          {new Date().toLocaleDateString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
          })}
        </div>
      </div>

      {/* Stats Grid */}
      <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">
        <StatCard
          title="Total Mobil"
          value="45"
          icon={Car}
          trend="up"
          trendValue="12%"
          delay={0.1} />
        
        <StatCard
          title="Mobil Tersedia"
          value="28"
          icon={Car}
          trend="up"
          trendValue="5%"
          delay={0.2} />
        
        <StatCard
          title="Total Customer"
          value="1,240"
          icon={Users}
          trend="up"
          trendValue="18%"
          delay={0.3} />
        
        <StatCard
          title="Terverifikasi"
          value="1,180"
          icon={ShieldCheck}
          trend="up"
          trendValue="22%"
          delay={0.4} />
        
        <StatCard
          title="Penyewaan"
          value="342"
          icon={CalendarRange}
          trend="up"
          trendValue="8%"
          delay={0.5} />
        
        <StatCard
          title="Pendapatan"
          value="Rp 85Jt"
          icon={DollarSign}
          trend="up"
          trendValue="15%"
          delay={0.6} />
        
      </div>

      {/* Charts */}
      <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <Card className="lg:col-span-2">
          <CardHeader>
            <CardTitle>Penyewaan & Pendapatan Bulanan</CardTitle>
          </CardHeader>
          <CardContent>
            <div className="h-[300px] w-full mt-4">
              <ResponsiveContainer width="100%" height="100%">
                <AreaChart
                  data={chartData}
                  margin={{
                    top: 10,
                    right: 10,
                    left: 0,
                    bottom: 0
                  }}>
                  
                  <defs>
                    <linearGradient
                      id="colorRevenue"
                      x1="0"
                      y1="0"
                      x2="0"
                      y2="1">
                      
                      <stop offset="5%" stopColor="#C1121F" stopOpacity={0.3} />
                      <stop offset="95%" stopColor="#C1121F" stopOpacity={0} />
                    </linearGradient>
                  </defs>
                  <CartesianGrid
                    strokeDasharray="3 3"
                    stroke="rgba(255,255,255,0.05)"
                    vertical={false} />
                  
                  <XAxis
                    dataKey="name"
                    stroke="rgba(255,255,255,0.4)"
                    fontSize={12}
                    tickLine={false}
                    axisLine={false} />
                  
                  <YAxis
                    stroke="rgba(255,255,255,0.4)"
                    fontSize={12}
                    tickLine={false}
                    axisLine={false}
                    tickFormatter={(value) => `Rp${value / 1000000}M`} />
                  
                  <Tooltip
                    contentStyle={{
                      backgroundColor: '#141414',
                      borderColor: 'rgba(255,255,255,0.1)',
                      borderRadius: '8px',
                      color: '#fff'
                    }}
                    itemStyle={{
                      color: '#fff'
                    }}
                    formatter={(value: number) => formatCurrency(value)} />
                  
                  <Area
                    type="monotone"
                    dataKey="revenue"
                    stroke="#C1121F"
                    strokeWidth={3}
                    fillOpacity={1}
                    fill="url(#colorRevenue)" />
                  
                </AreaChart>
              </ResponsiveContainer>
            </div>
          </CardContent>
        </Card>

        <Card>
          <CardHeader>
            <CardTitle>Pertumbuhan Customer</CardTitle>
          </CardHeader>
          <CardContent>
            <div className="h-[300px] w-full mt-4">
              <ResponsiveContainer width="100%" height="100%">
                <BarChart
                  data={chartData}
                  margin={{
                    top: 10,
                    right: 10,
                    left: -20,
                    bottom: 0
                  }}>
                  
                  <CartesianGrid
                    strokeDasharray="3 3"
                    stroke="rgba(255,255,255,0.05)"
                    vertical={false} />
                  
                  <XAxis
                    dataKey="name"
                    stroke="rgba(255,255,255,0.4)"
                    fontSize={12}
                    tickLine={false}
                    axisLine={false} />
                  
                  <YAxis
                    stroke="rgba(255,255,255,0.4)"
                    fontSize={12}
                    tickLine={false}
                    axisLine={false} />
                  
                  <Tooltip
                    cursor={{
                      fill: 'rgba(255,255,255,0.05)'
                    }}
                    contentStyle={{
                      backgroundColor: '#141414',
                      borderColor: 'rgba(255,255,255,0.1)',
                      borderRadius: '8px',
                      color: '#fff'
                    }} />
                  
                  <Bar
                    dataKey="newCustomers"
                    fill="#C1121F"
                    radius={[4, 4, 0, 0]} />
                  
                </BarChart>
              </ResponsiveContainer>
            </div>
          </CardContent>
        </Card>
      </div>

      {/* Lists */}
      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <Card>
          <CardHeader className="flex flex-row items-center justify-between">
            <CardTitle>Aktivitas Terbaru</CardTitle>
            <button className="text-sm text-[#C1121F] hover:text-red-400 transition-colors">
              Lihat Semua
            </button>
          </CardHeader>
          <CardContent>
            <div className="space-y-4">
              {recentCustomers.map((cust, i) =>
              <div
                key={cust.id}
                className="flex items-center gap-4 p-3 rounded-lg hover:bg-white/[0.02] transition-colors border border-transparent hover:border-white/[0.05]">
                
                  <div className="w-10 h-10 rounded-full bg-white/[0.05] flex items-center justify-center text-white font-medium">
                    {cust.name.charAt(0)}
                  </div>
                  <div className="flex-1 min-w-0">
                    <p className="text-sm font-medium text-white truncate">
                      {cust.name}
                    </p>
                    <p className="text-xs text-white/50 truncate">
                      Customer Baru Mendaftar
                    </p>
                  </div>
                  <div className="text-xs text-white/40">{i + 1} jam lalu</div>
                </div>
              )}
            </div>
          </CardContent>
        </Card>

        <Card>
          <CardHeader className="flex flex-row items-center justify-between">
            <CardTitle>Penyewaan Aktif</CardTitle>
            <button className="text-sm text-[#C1121F] hover:text-red-400 transition-colors">
              Lihat Semua
            </button>
          </CardHeader>
          <CardContent>
            <div className="overflow-x-auto">
              <table className="w-full text-sm text-left">
                <thead className="text-xs text-white/50 uppercase bg-white/[0.02] border-b border-white/[0.05]">
                  <tr>
                    <th className="px-4 py-3 font-medium rounded-tl-lg">ID</th>
                    <th className="px-4 py-3 font-medium">Customer</th>
                    <th className="px-4 py-3 font-medium">Status</th>
                    <th className="px-4 py-3 font-medium rounded-tr-lg text-right">
                      Total
                    </th>
                  </tr>
                </thead>
                <tbody>
                  {recentRentals.map((rental) =>
                  <tr
                    key={rental.id}
                    className="border-b border-white/[0.05] hover:bg-white/[0.02] transition-colors">
                    
                      <td className="px-4 py-3 font-medium text-white">
                        {rental.id}
                      </td>
                      <td className="px-4 py-3 text-white/80">
                        {
                      mockCustomers.find((c) => c.id === rental.customerId)?.
                      name
                      }
                      </td>
                      <td className="px-4 py-3">
                        <Badge
                        variant={
                        rental.status === 'Berlangsung' ?
                        'success' :
                        rental.status === 'Selesai' ?
                        'default' :
                        'warning'
                        }>
                        
                          {rental.status}
                        </Badge>
                      </td>
                      <td className="px-4 py-3 text-right font-medium text-white">
                        {formatCurrency(rental.total)}
                      </td>
                    </tr>
                  )}
                </tbody>
              </table>
            </div>
          </CardContent>
        </Card>
      </div>
    </div>);

}