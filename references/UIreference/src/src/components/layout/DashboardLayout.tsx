import React, { useState } from 'react';
import { Outlet, NavLink, useLocation, useNavigate } from 'react-router-dom';
import { motion, AnimatePresence } from 'framer-motion';
import {
  LayoutDashboard,
  Users,
  ShieldCheck,
  Car,
  CalendarRange,
  UserCog,
  BarChart3,
  Settings,
  LogOut,
  Menu,
  Bell,
  Search,
  X } from
'lucide-react';
import { cn } from '../ui';
const navItems = [
{
  path: '/',
  icon: LayoutDashboard,
  label: 'Dashboard'
},
{
  path: '/customers',
  icon: Users,
  label: 'Customer'
},
{
  path: '/verification',
  icon: ShieldCheck,
  label: 'Verifikasi Customer'
},
{
  path: '/cars',
  icon: Car,
  label: 'Mobil'
},
{
  path: '/rentals',
  icon: CalendarRange,
  label: 'Penyewaan'
},
{
  path: '/staff',
  icon: UserCog,
  label: 'Staff'
},
{
  path: '/reports',
  icon: BarChart3,
  label: 'Laporan'
},
{
  path: '/settings',
  icon: Settings,
  label: 'Pengaturan'
}];

export function DashboardLayout() {
  const [isMobileMenuOpen, setIsMobileMenuOpen] = useState(false);
  const location = useLocation();
  const navigate = useNavigate();
  const handleLogout = () => {
    navigate('/login');
  };
  const SidebarContent = () =>
  <>
      <div className="p-6 flex items-center gap-3">
        <div className="w-8 h-8 rounded bg-[#C1121F] flex items-center justify-center font-bold text-white shadow-[0_0_15px_rgba(193,18,31,0.5)]">
          R
        </div>
        <span className="font-bold text-lg tracking-tight text-white">
          RentCar<span className="text-white/50 font-normal">.id</span>
        </span>
      </div>

      <div className="flex-1 px-4 py-2 space-y-1 overflow-y-auto">
        {navItems.map((item) => {
        const isActive =
        location.pathname === item.path ||
        item.path !== '/' && location.pathname.startsWith(item.path);
        return (
          <NavLink
            key={item.path}
            to={item.path}
            onClick={() => setIsMobileMenuOpen(false)}
            className={cn(
              'flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 group relative',
              isActive ?
              'bg-[#C1121F]/10 text-white' :
              'text-white/60 hover:bg-white/[0.04] hover:text-white'
            )}>
            
              {isActive &&
            <motion.div
              layoutId="active-nav"
              className="absolute left-0 top-0 bottom-0 w-1 bg-[#C1121F] rounded-r-full shadow-[0_0_10px_rgba(193,18,31,0.8)]" />

            }
              <item.icon
              className={cn(
                'w-5 h-5 transition-colors',
                isActive ? 'text-[#C1121F]' : 'group-hover:text-white/80'
              )} />
            
              <span className="font-medium text-sm">{item.label}</span>
            </NavLink>);

      })}
      </div>

      <div className="p-4 mt-auto">
        <button
        onClick={handleLogout}
        className="flex items-center gap-3 px-3 py-2.5 w-full rounded-lg text-white/60 hover:bg-red-500/10 hover:text-red-400 transition-colors group">
        
          <LogOut className="w-5 h-5 group-hover:text-red-400 transition-colors" />
          <span className="font-medium text-sm">Logout</span>
        </button>
      </div>
    </>;

  return (
    <div className="min-h-screen bg-[#080808] flex overflow-hidden">
      {/* Desktop Sidebar */}
      <aside className="hidden md:flex flex-col w-64 border-r border-white/[0.06] bg-[#141414]/50 backdrop-blur-xl z-20">
        <SidebarContent />
      </aside>

      {/* Mobile Sidebar Drawer */}
      <AnimatePresence>
        {isMobileMenuOpen &&
        <>
            <motion.div
            initial={{
              opacity: 0
            }}
            animate={{
              opacity: 1
            }}
            exit={{
              opacity: 0
            }}
            onClick={() => setIsMobileMenuOpen(false)}
            className="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 md:hidden" />
          
            <motion.aside
            initial={{
              x: '-100%'
            }}
            animate={{
              x: 0
            }}
            exit={{
              x: '-100%'
            }}
            transition={{
              type: 'spring',
              bounce: 0,
              duration: 0.3
            }}
            className="fixed inset-y-0 left-0 w-64 bg-[#141414] border-r border-white/[0.06] z-50 flex flex-col md:hidden shadow-2xl">
            
              <button
              onClick={() => setIsMobileMenuOpen(false)}
              className="absolute top-6 right-4 p-1 text-white/50 hover:text-white">
              
                <X className="w-5 h-5" />
              </button>
              <SidebarContent />
            </motion.aside>
          </>
        }
      </AnimatePresence>

      {/* Main Content */}
      <main className="flex-1 flex flex-col min-w-0 h-screen overflow-hidden">
        {/* Navbar */}
        <header className="h-16 border-b border-white/[0.06] bg-[#141414]/30 backdrop-blur-md flex items-center justify-between px-4 lg:px-8 z-10 shrink-0">
          <div className="flex items-center gap-4">
            <button
              onClick={() => setIsMobileMenuOpen(true)}
              className="md:hidden p-2 -ml-2 text-white/70 hover:text-white">
              
              <Menu className="w-5 h-5" />
            </button>

            <div className="hidden sm:flex items-center gap-2 px-3 py-1.5 bg-white/[0.03] border border-white/[0.06] rounded-lg focus-within:border-[#C1121F]/50 focus-within:bg-white/[0.05] transition-colors w-64">
              <Search className="w-4 h-4 text-white/40" />
              <input
                type="text"
                placeholder="Cari sesuatu..."
                className="bg-transparent border-none outline-none text-sm text-white placeholder:text-white/40 w-full" />
              
            </div>
          </div>

          <div className="flex items-center gap-4">
            <button className="relative p-2 text-white/70 hover:text-white transition-colors rounded-full hover:bg-white/5">
              <Bell className="w-5 h-5" />
              <span className="absolute top-1.5 right-1.5 w-2 h-2 bg-[#C1121F] rounded-full shadow-[0_0_8px_#C1121F]"></span>
            </button>
            <div className="h-8 w-px bg-white/[0.1] mx-1"></div>
            <div className="flex items-center gap-3 cursor-pointer group">
              <div className="hidden sm:flex flex-col items-end">
                <span className="text-sm font-medium text-white group-hover:text-[#C1121F] transition-colors">
                  Admin Utama
                </span>
                <span className="text-xs text-white/50">Pemilik</span>
              </div>
              <div className="w-9 h-9 rounded-full bg-gradient-to-tr from-[#C1121F] to-red-500 flex items-center justify-center text-white font-bold shadow-lg">
                A
              </div>
            </div>
          </div>
        </header>

        {/* Page Content */}
        <div className="flex-1 overflow-y-auto p-4 lg:p-8 relative">
          <motion.div
            key={location.pathname}
            initial={{
              opacity: 0,
              y: 10
            }}
            animate={{
              opacity: 1,
              y: 0
            }}
            exit={{
              opacity: 0,
              y: -10
            }}
            transition={{
              duration: 0.2
            }}
            className="max-w-7xl mx-auto w-full pb-12">
            
            <Outlet />
          </motion.div>
        </div>
      </main>
    </div>);

}