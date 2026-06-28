import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import {
  Check,
  ChevronRight,
  ArrowLeft,
  Calendar,
  Car,
  User,
  CreditCard } from
'lucide-react';
import { Button, Card, CardContent, Input } from '../components/ui';
import { mockCustomers, mockCars, formatCurrency } from '../data/mockData';
import { toast } from 'sonner';
const steps = [
{
  id: 1,
  name: 'Pilih Customer',
  icon: User
},
{
  id: 2,
  name: 'Pilih Mobil',
  icon: Car
},
{
  id: 3,
  name: 'Tanggal Sewa',
  icon: Calendar
},
{
  id: 4,
  name: 'Ringkasan',
  icon: CreditCard
}];

export function RentalWizard() {
  const navigate = useNavigate();
  const [currentStep, setCurrentStep] = useState(1);
  const [selectedCustomer, setSelectedCustomer] = useState<string | null>(null);
  const [selectedCar, setSelectedCar] = useState<string | null>(null);
  const [dates, setDates] = useState({
    start: '',
    end: ''
  });
  const verifiedCustomers = mockCustomers.filter(
    (c) => c.status === 'Terverifikasi'
  );
  const availableCars = mockCars.filter((c) => c.status === 'Tersedia');
  const customer = mockCustomers.find((c) => c.id === selectedCustomer);
  const car = mockCars.find((c) => c.id === selectedCar);
  const calculateDays = () => {
    if (!dates.start || !dates.end) return 0;
    const start = new Date(dates.start);
    const end = new Date(dates.end);
    const diffTime = Math.abs(end.getTime() - start.getTime());
    return Math.ceil(diffTime / (1000 * 60 * 60 * 24)) || 1;
  };
  const days = calculateDays();
  const total = (car?.price || 0) * days;
  const handleNext = () => {
    if (currentStep < 4) setCurrentStep((prev) => prev + 1);else
    {
      toast.success('Penyewaan berhasil dibuat!');
      navigate('/rentals');
    }
  };
  const isNextDisabled = () => {
    if (currentStep === 1 && !selectedCustomer) return true;
    if (currentStep === 2 && !selectedCar) return true;
    if (
    currentStep === 3 && (
    !dates.start ||
    !dates.end ||
    new Date(dates.end) < new Date(dates.start)))

    return true;
    return false;
  };
  return (
    <div className="max-w-4xl mx-auto space-y-8">
      <div className="flex items-center gap-4">
        <Button
          variant="ghost"
          size="icon"
          onClick={() => navigate('/rentals')}
          className="rounded-full bg-white/[0.03]">
          
          <ArrowLeft className="w-5 h-5" />
        </Button>
        <div>
          <h1 className="text-2xl font-bold text-white tracking-tight">
            Buat Penyewaan Baru
          </h1>
          <p className="text-white/50 text-sm mt-1">
            Ikuti langkah-langkah berikut untuk membuat transaksi penyewaan.
          </p>
        </div>
      </div>

      {/* Stepper */}
      <div className="relative">
        <div className="absolute top-1/2 left-0 w-full h-0.5 bg-white/[0.05] -translate-y-1/2 z-0" />
        <div
          className="absolute top-1/2 left-0 h-0.5 bg-[#C1121F] -translate-y-1/2 z-0 transition-all duration-500"
          style={{
            width: `${(currentStep - 1) / 3 * 100}%`
          }} />
        

        <div className="relative z-10 flex justify-between">
          {steps.map((step) => {
            const isCompleted = currentStep > step.id;
            const isCurrent = currentStep === step.id;
            return (
              <div key={step.id} className="flex flex-col items-center gap-2">
                <div
                  className={`w-10 h-10 rounded-full flex items-center justify-center border-2 transition-colors duration-300 ${isCompleted ? 'bg-[#C1121F] border-[#C1121F] text-white' : isCurrent ? 'bg-[#141414] border-[#C1121F] text-[#C1121F]' : 'bg-[#141414] border-white/[0.1] text-white/30'}`}>
                  
                  {isCompleted ?
                  <Check className="w-5 h-5" /> :

                  <step.icon className="w-5 h-5" />
                  }
                </div>
                <span
                  className={`text-xs font-medium ${isCurrent || isCompleted ? 'text-white' : 'text-white/30'}`}>
                  
                  {step.name}
                </span>
              </div>);

          })}
        </div>
      </div>

      {/* Content */}
      <Card className="min-h-[400px] flex flex-col">
        <CardContent className="p-6 sm:p-8 flex-1">
          {currentStep === 1 &&
          <div className="space-y-4">
              <h3 className="text-lg font-semibold text-white mb-4">
                Pilih Customer Terverifikasi
              </h3>
              <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                {verifiedCustomers.map((c) =>
              <div
                key={c.id}
                onClick={() => setSelectedCustomer(c.id)}
                className={`p-4 rounded-xl border cursor-pointer transition-all ${selectedCustomer === c.id ? 'bg-[#C1121F]/10 border-[#C1121F] shadow-[0_0_15px_rgba(193,18,31,0.2)]' : 'bg-white/[0.02] border-white/[0.05] hover:border-white/[0.2]'}`}>
                
                    <div className="font-medium text-white">{c.name}</div>
                    <div className="text-sm text-white/50 mt-1">{c.nik}</div>
                    <div className="text-sm text-white/50">{c.phone}</div>
                  </div>
              )}
              </div>
            </div>
          }

          {currentStep === 2 &&
          <div className="space-y-4">
              <h3 className="text-lg font-semibold text-white mb-4">
                Pilih Mobil Tersedia
              </h3>
              <div className="grid grid-cols-1 sm:grid-cols-2 gap-4">
                {availableCars.map((c) =>
              <div
                key={c.id}
                onClick={() => setSelectedCar(c.id)}
                className={`flex gap-4 p-3 rounded-xl border cursor-pointer transition-all ${selectedCar === c.id ? 'bg-[#C1121F]/10 border-[#C1121F] shadow-[0_0_15px_rgba(193,18,31,0.2)]' : 'bg-white/[0.02] border-white/[0.05] hover:border-white/[0.2]'}`}>
                
                    <div className="w-24 h-20 rounded-lg bg-black/50 overflow-hidden shrink-0">
                      <img
                    src={c.image}
                    alt={c.name}
                    className="w-full h-full object-cover" />
                  
                    </div>
                    <div className="flex-1 py-1">
                      <div className="font-medium text-white">{c.name}</div>
                      <div className="text-xs text-white/50 mt-1">
                        {c.plate}
                      </div>
                      <div className="text-sm font-bold text-[#C1121F] mt-2">
                        {formatCurrency(c.price)}/hari
                      </div>
                    </div>
                  </div>
              )}
              </div>
            </div>
          }

          {currentStep === 3 &&
          <div className="max-w-md mx-auto space-y-6 pt-8">
              <div className="space-y-2">
                <label className="text-sm font-medium text-white/80">
                  Tanggal Pengambilan
                </label>
                <Input
                type="date"
                value={dates.start}
                onChange={(e) =>
                setDates({
                  ...dates,
                  start: e.target.value
                })
                }
                min={new Date().toISOString().split('T')[0]} />
              
              </div>
              <div className="space-y-2">
                <label className="text-sm font-medium text-white/80">
                  Tanggal Pengembalian
                </label>
                <Input
                type="date"
                value={dates.end}
                onChange={(e) =>
                setDates({
                  ...dates,
                  end: e.target.value
                })
                }
                min={dates.start || new Date().toISOString().split('T')[0]} />
              
              </div>
              {dates.start && dates.end &&
            <div className="p-4 rounded-lg bg-white/[0.03] border border-white/[0.05] text-center">
                  <span className="text-white/70">Lama Sewa: </span>
                  <span className="text-xl font-bold text-white ml-2">
                    {calculateDays()} Hari
                  </span>
                </div>
            }
            </div>
          }

          {currentStep === 4 &&
          <div className="space-y-6">
              <h3 className="text-lg font-semibold text-white mb-4">
                Ringkasan Penyewaan
              </h3>

              <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div className="space-y-4">
                  <div className="p-4 rounded-xl bg-white/[0.02] border border-white/[0.05]">
                    <div className="text-xs text-white/40 uppercase tracking-wider mb-2">
                      Informasi Customer
                    </div>
                    <div className="font-medium text-white">
                      {customer?.name}
                    </div>
                    <div className="text-sm text-white/60">
                      {customer?.phone}
                    </div>
                    <div className="text-sm text-white/60">
                      {customer?.email}
                    </div>
                  </div>

                  <div className="p-4 rounded-xl bg-white/[0.02] border border-white/[0.05]">
                    <div className="text-xs text-white/40 uppercase tracking-wider mb-2">
                      Informasi Waktu
                    </div>
                    <div className="flex justify-between text-sm mb-1">
                      <span className="text-white/60">Mulai:</span>
                      <span className="text-white font-medium">
                        {dates.start}
                      </span>
                    </div>
                    <div className="flex justify-between text-sm mb-1">
                      <span className="text-white/60">Selesai:</span>
                      <span className="text-white font-medium">
                        {dates.end}
                      </span>
                    </div>
                    <div className="flex justify-between text-sm mt-3 pt-3 border-t border-white/[0.05]">
                      <span className="text-white/60">Lama Sewa:</span>
                      <span className="text-white font-medium">
                        {days} Hari
                      </span>
                    </div>
                  </div>
                </div>

                <div className="space-y-4">
                  <div className="p-4 rounded-xl bg-white/[0.02] border border-white/[0.05]">
                    <div className="text-xs text-white/40 uppercase tracking-wider mb-2">
                      Informasi Mobil
                    </div>
                    <div className="flex gap-3">
                      <div className="w-20 h-16 rounded bg-black/50 overflow-hidden shrink-0">
                        <img
                        src={car?.image}
                        alt={car?.name}
                        className="w-full h-full object-cover" />
                      
                      </div>
                      <div>
                        <div className="font-medium text-white">
                          {car?.name}
                        </div>
                        <div className="text-sm text-white/60">
                          {car?.plate}
                        </div>
                        <div className="text-sm text-[#C1121F] font-medium">
                          {formatCurrency(car?.price || 0)}/hari
                        </div>
                      </div>
                    </div>
                  </div>

                  <div className="p-6 rounded-xl bg-[#C1121F]/10 border border-[#C1121F]/30">
                    <div className="text-sm text-white/70 mb-1">
                      Total Pembayaran
                    </div>
                    <div className="text-3xl font-bold text-white">
                      {formatCurrency(total)}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          }
        </CardContent>

        <div className="p-4 sm:p-6 border-t border-white/[0.05] flex justify-between items-center bg-white/[0.01]">
          <Button
            variant="ghost"
            onClick={() => setCurrentStep((prev) => prev - 1)}
            disabled={currentStep === 1}>
            
            Sebelumnya
          </Button>
          <Button onClick={handleNext} disabled={isNextDisabled()}>
            {currentStep === 4 ? 'Konfirmasi Penyewaan' : 'Berikutnya'}
            {currentStep < 4 && <ChevronRight className="w-4 h-4 ml-2" />}
          </Button>
        </div>
      </Card>
    </div>);

}