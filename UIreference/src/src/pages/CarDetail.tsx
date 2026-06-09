import React from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import {
  ArrowLeft,
  Users,
  Fuel,
  Calendar,
  Car as CarIcon,
  Tag } from
'lucide-react';
import {
  Button,
  Card,
  CardHeader,
  CardTitle,
  CardContent,
  Badge } from
'../components/ui';
import { mockCars, mockRentals, formatCurrency } from '../data/mockData';
import { format, parseISO } from 'date-fns';
import { id as idLocale } from 'date-fns/locale';
export function CarDetail() {
  const { id } = useParams();
  const navigate = useNavigate();
  const car = mockCars.find((c) => c.id === id);
  const carRentals = mockRentals.filter((r) => r.carId === id);
  if (!car) {
    return (
      <div className="flex flex-col items-center justify-center h-[60vh] text-center space-y-4">
        <h2 className="text-xl font-bold text-white">Mobil tidak ditemukan</h2>
        <Button onClick={() => navigate('/cars')} variant="outline">
          Kembali ke Daftar Mobil
        </Button>
      </div>);

  }
  const getStatusBadge = (status: string) => {
    switch (status) {
      case 'Tersedia':
        return (
          <Badge variant="success" className="text-sm px-3 py-1">
            Tersedia
          </Badge>);

      case 'Disewa':
        return (
          <Badge variant="danger" className="text-sm px-3 py-1">
            Disewa
          </Badge>);

      case 'Maintenance':
        return (
          <Badge variant="warning" className="text-sm px-3 py-1">
            Maintenance
          </Badge>);

      default:
        return <Badge className="text-sm px-3 py-1">{status}</Badge>;
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
        <Button variant="ghost" size="icon" onClick={() => navigate('/cars')}>
          <ArrowLeft className="w-5 h-5" />
        </Button>
        <div>
          <h1 className="text-2xl font-bold text-white tracking-tight">
            Detail Mobil
          </h1>
          <p className="text-white/50 text-sm mt-1">
            Informasi lengkap dan riwayat penyewaan armada.
          </p>
        </div>
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {/* Left/Top: Hero Image & Main Info */}
        <div className="lg:col-span-2 space-y-6">
          <Card className="overflow-hidden">
            <div className="relative aspect-video bg-black/50">
              <img
                src={car.image}
                alt={car.name}
                className="w-full h-full object-cover" />
              
              <div className="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent" />
              <div className="absolute bottom-6 left-6 right-6 flex justify-between items-end">
                <div>
                  <h2 className="text-3xl font-bold text-white mb-2">
                    {car.name}
                  </h2>
                  <div className="flex items-center gap-3">
                    <Badge
                      variant="outline"
                      className="bg-black/40 backdrop-blur-md text-sm border-white/20">
                      
                      {car.plate}
                    </Badge>
                    {getStatusBadge(car.status)}
                  </div>
                </div>
              </div>
            </div>
            <CardContent className="p-6">
              <div className="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
                <div className="flex flex-col gap-1">
                  <span className="text-white/50 text-sm flex items-center gap-2">
                    <Calendar className="w-4 h-4" /> Tahun
                  </span>
                  <span className="text-white font-medium text-lg">
                    {car.year}
                  </span>
                </div>
                <div className="flex flex-col gap-1">
                  <span className="text-white/50 text-sm flex items-center gap-2">
                    <CarIcon className="w-4 h-4" /> Tipe
                  </span>
                  <span className="text-white font-medium text-lg">
                    {car.type}
                  </span>
                </div>
                <div className="flex flex-col gap-1">
                  <span className="text-white/50 text-sm flex items-center gap-2">
                    <Users className="w-4 h-4" /> Kapasitas
                  </span>
                  <span className="text-white font-medium text-lg">
                    {car.capacity} Kursi
                  </span>
                </div>
                <div className="flex flex-col gap-1">
                  <span className="text-white/50 text-sm flex items-center gap-2">
                    <Fuel className="w-4 h-4" /> Bahan Bakar
                  </span>
                  <span className="text-white font-medium text-lg">
                    {car.fuel}
                  </span>
                </div>
              </div>

              <div className="flex items-center justify-between p-4 bg-white/[0.02] rounded-xl border border-white/[0.05]">
                <div>
                  <div className="text-white/50 text-sm mb-1">Harga Sewa</div>
                  <div className="text-2xl font-bold text-[#C1121F]">
                    {formatCurrency(car.price)}{' '}
                    <span className="text-sm text-white/40 font-normal">
                      / hari
                    </span>
                  </div>
                </div>
                <Button
                  variant="primary"
                  size="lg"
                  disabled={car.status !== 'Tersedia'}
                  onClick={() => navigate(`/rentals/new?carId=${car.id}`)}>
                  
                  Sewa Mobil Ini
                </Button>
              </div>
            </CardContent>
          </Card>
        </div>

        {/* Right/Bottom: Rental History */}
        <div className="space-y-6">
          <Card className="h-full">
            <CardHeader>
              <CardTitle>Riwayat Penyewaan</CardTitle>
            </CardHeader>
            <div className="overflow-x-auto">
              <table className="w-full text-sm text-left">
                <thead className="text-xs text-white/50 uppercase bg-white/[0.02] border-y border-white/[0.05]">
                  <tr>
                    <th className="px-6 py-4 font-medium">
                      Customer & Tanggal
                    </th>
                    <th className="px-6 py-4 font-medium text-right">Status</th>
                  </tr>
                </thead>
                <tbody className="divide-y divide-white/[0.05]">
                  {carRentals.length > 0 ?
                  carRentals.map((rental) =>
                  <tr
                    key={rental.id}
                    className="hover:bg-white/[0.02] transition-colors">
                    
                        <td className="px-6 py-4">
                          <div className="font-medium text-white mb-1">
                            {rental.customerId}{' '}
                            {/* In a real app, join with customer name */}
                          </div>
                          <div className="text-xs text-white/50">
                            {format(parseISO(rental.startDate), 'dd MMM', {
                          locale: idLocale
                        })}{' '}
                            -{' '}
                            {format(parseISO(rental.endDate), 'dd MMM yyyy', {
                          locale: idLocale
                        })}
                          </div>
                        </td>
                        <td className="px-6 py-4 text-right">
                          {getRentalStatusBadge(rental.status)}
                        </td>
                      </tr>
                  ) :

                  <tr>
                      <td
                      colSpan={2}
                      className="px-6 py-8 text-center text-white/50">
                      
                        Belum ada riwayat penyewaan untuk mobil ini.
                      </td>
                    </tr>
                  }
                </tbody>
              </table>
            </div>
          </Card>
        </div>
      </div>
    </div>);

}