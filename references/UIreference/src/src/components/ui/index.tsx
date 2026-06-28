import React, { forwardRef } from 'react';
import { clsx, type ClassValue } from 'clsx';
import { twMerge } from 'tailwind-merge';
import { motion, AnimatePresence } from 'framer-motion';
import { AlertTriangle, X } from 'lucide-react';
export function cn(...inputs: ClassValue[]) {
  return twMerge(clsx(inputs));
}
// --- BUTTON ---
interface ButtonProps extends React.ButtonHTMLAttributes<HTMLButtonElement> {
  variant?: 'primary' | 'secondary' | 'outline' | 'ghost' | 'destructive';
  size?: 'sm' | 'md' | 'lg' | 'icon';
  isLoading?: boolean;
}
export const Button = forwardRef<HTMLButtonElement, ButtonProps>(
  (
  {
    className,
    variant = 'primary',
    size = 'md',
    isLoading,
    children,
    ...props
  },
  ref) =>
  {
    const variants = {
      primary:
      'bg-[#C1121F] text-white hover:bg-[#a30f1a] shadow-[0_0_24px_-6px_rgba(193,18,31,0.6)] border border-transparent',
      secondary:
      'bg-white/[0.08] text-white hover:bg-white/[0.12] border border-white/[0.05]',
      outline:
      'bg-transparent text-white border border-white/[0.2] hover:bg-white/[0.05]',
      ghost:
      'bg-transparent text-white hover:bg-white/[0.08] border border-transparent',
      destructive:
      'bg-red-900/40 text-red-400 hover:bg-red-900/60 border border-red-900/50'
    };
    const sizes = {
      sm: 'h-8 px-3 text-xs',
      md: 'h-10 px-4 py-2 text-sm',
      lg: 'h-12 px-6 text-base',
      icon: 'h-10 w-10 flex items-center justify-center p-0'
    };
    return (
      <motion.button
        ref={ref}
        whileHover={{
          scale: 1.02,
          translateY: -1
        }}
        whileTap={{
          scale: 0.98
        }}
        className={cn(
          'inline-flex items-center justify-center rounded-lg font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#C1121F] disabled:opacity-50 disabled:pointer-events-none',
          variants[variant],
          sizes[size],
          className
        )}
        disabled={isLoading || props.disabled}
        {...props}>
        
        {isLoading ?
        <div className="w-4 h-4 border-2 border-white/30 border-t-white rounded-full animate-spin mr-2" /> :
        null}
        {children}
      </motion.button>);

  }
);
Button.displayName = 'Button';
// --- CARD ---
export function Card({
  className,
  children,
  ...props
}: React.HTMLAttributes<HTMLDivElement>) {
  return (
    <div
      className={cn('glass-card rounded-xl overflow-hidden', className)}
      {...props}>
      
      {children}
    </div>);

}
export function CardHeader({
  className,
  children,
  ...props
}: React.HTMLAttributes<HTMLDivElement>) {
  return (
    <div className={cn('p-6 pb-4', className)} {...props}>
      {children}
    </div>);

}
export function CardTitle({
  className,
  children,
  ...props
}: React.HTMLAttributes<HTMLHeadingElement>) {
  return (
    <h3
      className={cn(
        'text-lg font-semibold leading-none tracking-tight text-white',
        className
      )}
      {...props}>
      
      {children}
    </h3>);

}
export function CardContent({
  className,
  children,
  ...props
}: React.HTMLAttributes<HTMLDivElement>) {
  return (
    <div className={cn('p-6 pt-0', className)} {...props}>
      {children}
    </div>);

}
// --- INPUT ---
export const Input = forwardRef<
  HTMLInputElement,
  React.InputHTMLAttributes<HTMLInputElement> & {
    error?: string;
  }>(
  ({ className, error, ...props }, ref) => {
    return (
      <div className="w-full">
      <input
          ref={ref}
          className={cn(
            'flex h-10 w-full rounded-lg border border-white/[0.1] bg-[#0D0D0D] px-3 py-2 text-sm text-white placeholder:text-white/40 focus:outline-none focus:ring-2 focus:ring-[#C1121F]/50 focus:border-[#C1121F] disabled:cursor-not-allowed disabled:opacity-50 transition-all',
            error && 'border-red-500 focus:ring-red-500/50',
            className
          )}
          {...props} />
        
      {error && <p className="mt-1 text-xs text-red-400">{error}</p>}
    </div>);

  });
Input.displayName = 'Input';
// --- TEXTAREA ---
export const Textarea = forwardRef<
  HTMLTextAreaElement,
  React.TextareaHTMLAttributes<HTMLTextAreaElement> & {
    error?: string;
  }>(
  ({ className, error, ...props }, ref) => {
    return (
      <div className="w-full">
      <textarea
          ref={ref}
          className={cn(
            'flex min-h-[80px] w-full rounded-lg border border-white/[0.1] bg-[#0D0D0D] px-3 py-2 text-sm text-white placeholder:text-white/40 focus:outline-none focus:ring-2 focus:ring-[#C1121F]/50 focus:border-[#C1121F] disabled:cursor-not-allowed disabled:opacity-50 transition-all',
            error && 'border-red-500 focus:ring-red-500/50',
            className
          )}
          {...props} />
        
      {error && <p className="mt-1 text-xs text-red-400">{error}</p>}
    </div>);

  });
Textarea.displayName = 'Textarea';
// --- SELECT ---
export const Select = forwardRef<
  HTMLSelectElement,
  React.SelectHTMLAttributes<HTMLSelectElement> & {
    error?: string;
  }>(
  ({ className, error, children, ...props }, ref) => {
    return (
      <div className="w-full">
      <select
          ref={ref}
          className={cn(
            'flex h-10 w-full rounded-lg border border-white/[0.1] bg-[#0D0D0D] px-3 py-2 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#C1121F]/50 focus:border-[#C1121F] disabled:cursor-not-allowed disabled:opacity-50 transition-all appearance-none',
            error && 'border-red-500 focus:ring-red-500/50',
            className
          )}
          {...props}>
          
        {children}
      </select>
      {error && <p className="mt-1 text-xs text-red-400">{error}</p>}
    </div>);

  });
Select.displayName = 'Select';
// --- BADGE ---
export function Badge({
  className,
  variant = 'default',
  children,
  ...props


}: React.HTMLAttributes<HTMLDivElement> & {variant?: 'default' | 'success' | 'warning' | 'danger' | 'outline';}) {
  const variants = {
    default: 'bg-white/[0.1] text-white',
    success: 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20',
    warning: 'bg-amber-500/10 text-amber-400 border border-amber-500/20',
    danger: 'bg-red-500/10 text-red-400 border border-red-500/20',
    outline: 'border border-white/[0.2] text-white/80'
  };
  return (
    <div
      className={cn(
        'inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium transition-colors',
        variants[variant],
        className
      )}
      {...props}>
      
      {children}
    </div>);

}
// --- MODAL ---
interface ModalProps {
  isOpen: boolean;
  onClose: () => void;
  title: string;
  children: React.ReactNode;
  maxWidth?: string;
}
export function Modal({
  isOpen,
  onClose,
  title,
  children,
  maxWidth = 'max-w-md'
}: ModalProps) {
  return (
    <AnimatePresence>
      {isOpen &&
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
          onClick={onClose}
          className="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm" />
        
          <div className="fixed inset-0 z-50 flex items-center justify-center p-4 pointer-events-none">
            <motion.div
            initial={{
              opacity: 0,
              scale: 0.95,
              y: 20
            }}
            animate={{
              opacity: 1,
              scale: 1,
              y: 0
            }}
            exit={{
              opacity: 0,
              scale: 0.95,
              y: 20
            }}
            className={cn(
              'w-full pointer-events-auto glass-card rounded-xl shadow-2xl overflow-hidden',
              maxWidth
            )}>
            
              <div className="flex items-center justify-between p-4 border-b border-white/[0.06]">
                <h2 className="text-lg font-semibold text-white">{title}</h2>
                <button
                onClick={onClose}
                className="p-1 rounded-md text-white/50 hover:text-white hover:bg-white/10 transition-colors">
                
                  <X className="w-5 h-5" />
                </button>
              </div>
              <div className="p-4">{children}</div>
            </motion.div>
          </div>
        </>
      }
    </AnimatePresence>);

}
// --- CONFIRM DELETE MODAL ---
export function ConfirmDeleteModal({
  isOpen,
  onClose,
  onConfirm,
  title = 'Konfirmasi Hapus',
  message = 'Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.'






}: {isOpen: boolean;onClose: () => void;onConfirm: () => void;title?: string;message?: string;}) {
  return (
    <Modal isOpen={isOpen} onClose={onClose} title={title}>
      <div className="flex flex-col items-center text-center py-4">
        <div className="w-12 h-12 rounded-full bg-red-500/10 flex items-center justify-center mb-4">
          <AlertTriangle className="w-6 h-6 text-red-500" />
        </div>
        <p className="text-white/80 mb-6">{message}</p>
        <div className="flex w-full gap-3">
          <Button variant="ghost" className="flex-1" onClick={onClose}>
            Batal
          </Button>
          <Button
            variant="primary"
            className="flex-1"
            onClick={() => {
              onConfirm();
              onClose();
            }}>
            
            Ya, Hapus
          </Button>
        </div>
      </div>
    </Modal>);

}