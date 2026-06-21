import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { motion } from 'framer-motion';
import { Car, ArrowRight } from 'lucide-react';
import { Button, Input, Card } from '../components/ui';
export function Login() {
  const navigate = useNavigate();
  const [isLoading, setIsLoading] = useState(false);
  const handleLogin = (e: React.FormEvent) => {
    e.preventDefault();
    setIsLoading(true);
    setTimeout(() => {
      setIsLoading(false);
      navigate('/');
    }, 1000);
  };
  return (
    <div className="min-h-screen flex bg-[#080808]">
      {/* Left Side - Branding */}
      <div className="hidden lg:flex flex-1 relative flex-col justify-between p-12 overflow-hidden border-r border-white/[0.05]">
        {/* Abstract Background Elements */}
        <div className="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] bg-[#C1121F] rounded-full mix-blend-screen filter blur-[150px] opacity-20 animate-pulse"></div>
        <div className="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] bg-red-900 rounded-full mix-blend-screen filter blur-[150px] opacity-20"></div>

        <div className="relative z-10">
          <div className="flex items-center gap-3 mb-8">
            <div className="w-10 h-10 rounded bg-[#C1121F] flex items-center justify-center font-bold text-white shadow-[0_0_20px_rgba(193,18,31,0.6)]">
              <Car className="w-6 h-6" />
            </div>
            <span className="font-bold text-2xl tracking-tight text-white">
              RentCar<span className="text-white/50 font-normal">.id</span>
            </span>
          </div>
        </div>

        <div className="relative z-10 max-w-xl">
          <motion.h1
            initial={{
              opacity: 0,
              y: 20
            }}
            animate={{
              opacity: 1,
              y: 0
            }}
            transition={{
              delay: 0.2
            }}
            className="text-5xl font-bold text-white leading-tight mb-6">
            
            Premium Car Rental <br />
            <span className="text-transparent bg-clip-text bg-gradient-to-r from-[#C1121F] to-red-500">
              Management System
            </span>
          </motion.h1>
          <motion.p
            initial={{
              opacity: 0,
              y: 20
            }}
            animate={{
              opacity: 1,
              y: 0
            }}
            transition={{
              delay: 0.3
            }}
            className="text-lg text-white/60">
            
            Kelola armada, customer, dan penyewaan mobil Anda dalam satu
            dashboard modern dan profesional.
          </motion.p>
        </div>

        <div className="relative z-10 text-white/40 text-sm">
          &copy; 2026 RentCar Indonesia. All rights reserved.
        </div>
      </div>

      {/* Right Side - Form */}
      <div className="flex-1 flex items-center justify-center p-6 relative">
        {/* Mobile background glow */}
        <div className="lg:hidden absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-[#C1121F] rounded-full mix-blend-screen filter blur-[150px] opacity-10"></div>

        <motion.div
          initial={{
            opacity: 0,
            scale: 0.95
          }}
          animate={{
            opacity: 1,
            scale: 1
          }}
          transition={{
            duration: 0.4
          }}
          className="w-full max-w-md">
          
          <div className="lg:hidden flex items-center justify-center gap-3 mb-10">
            <div className="w-10 h-10 rounded bg-[#C1121F] flex items-center justify-center font-bold text-white shadow-[0_0_20px_rgba(193,18,31,0.6)]">
              R
            </div>
            <span className="font-bold text-2xl tracking-tight text-white">
              RentCar<span className="text-white/50 font-normal">.id</span>
            </span>
          </div>

          <Card className="p-8 border-white/[0.08] bg-[#141414]/80 shadow-2xl backdrop-blur-2xl">
            <div className="mb-8">
              <h2 className="text-2xl font-bold text-white mb-2">
                Selamat Datang
              </h2>
              <p className="text-white/50 text-sm">
                Silakan masuk ke akun Anda untuk melanjutkan.
              </p>
            </div>

            <form onSubmit={handleLogin} className="space-y-5">
              <div className="space-y-1.5">
                <label className="text-sm font-medium text-white/80">
                  Email
                </label>
                <Input
                  type="email"
                  placeholder="admin@rentcar.id"
                  defaultValue="admin@rentcar.id"
                  required />
                
              </div>

              <div className="space-y-1.5">
                <div className="flex items-center justify-between">
                  <label className="text-sm font-medium text-white/80">
                    Password
                  </label>
                  <a
                    href="#"
                    className="text-xs text-[#C1121F] hover:text-red-400 transition-colors">
                    
                    Lupa Password?
                  </a>
                </div>
                <Input
                  type="password"
                  placeholder="••••••••"
                  defaultValue="admin123"
                  required />
                
              </div>

              <Button
                type="submit"
                className="w-full mt-2"
                size="lg"
                isLoading={isLoading}>
                
                Masuk <ArrowRight className="w-4 h-4 ml-2" />
              </Button>
            </form>

            <div className="mt-6 p-4 rounded-lg bg-white/[0.03] border border-white/[0.05] text-xs text-white/50 text-center">
              Gunakan kredensial default untuk masuk ke prototype.
            </div>
          </Card>
        </motion.div>
      </div>
    </div>);

}