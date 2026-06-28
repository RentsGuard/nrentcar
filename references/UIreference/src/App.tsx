import React from 'react';
import { Routes, Route, Navigate } from 'react-router-dom';
import { Toaster } from 'sonner';
import { DashboardLayout } from './src/components/layout/DashboardLayout';
import { Login } from './src/pages/Login';
import { Dashboard } from './src/pages/Dashboard';
import { Customers } from './src/pages/Customers';
import { CustomerForm } from './src/pages/CustomerForm';
import { CustomerDetail } from './src/pages/CustomerDetail';
import { Cars } from './src/pages/Cars';
import { CarForm } from './src/pages/CarForm';
import { CarDetail } from './src/pages/CarDetail';
import { RentalWizard } from './src/pages/RentalWizard';
import { Rentals } from './src/pages/Rentals';
import { RentalDetail } from './src/pages/RentalDetail';
import { Verification } from './src/pages/Verification';
import { VerificationDetail } from './src/pages/VerificationDetail';
import { Staff } from './src/pages/Staff';
import { StaffForm } from './src/pages/StaffForm';
import { Reports } from './src/pages/Reports';
import { Settings } from './src/pages/Settings';
export function App() {
  return (
    <>
      <Toaster theme="dark" position="top-right" richColors />
      <Routes>
        <Route path="/login" element={<Login />} />

        <Route element={<DashboardLayout />}>
          <Route path="/" element={<Dashboard />} />

          {/* Customers */}
          <Route path="/customers" element={<Customers />} />
          <Route path="/customers/new" element={<CustomerForm />} />
          <Route path="/customers/:id" element={<CustomerDetail />} />
          <Route path="/customers/:id/edit" element={<CustomerForm />} />

          {/* Verification */}
          <Route path="/verification" element={<Verification />} />
          <Route path="/verification/:id" element={<VerificationDetail />} />

          {/* Cars */}
          <Route path="/cars" element={<Cars />} />
          <Route path="/cars/new" element={<CarForm />} />
          <Route path="/cars/:id" element={<CarDetail />} />
          <Route path="/cars/:id/edit" element={<CarForm />} />

          {/* Rentals */}
          <Route path="/rentals" element={<Rentals />} />
          <Route path="/rentals/new" element={<RentalWizard />} />
          <Route path="/rentals/:id" element={<RentalDetail />} />

          {/* Staff */}
          <Route path="/staff" element={<Staff />} />
          <Route path="/staff/new" element={<StaffForm />} />
          <Route path="/staff/:id/edit" element={<StaffForm />} />

          {/* Reports & Settings */}
          <Route path="/reports" element={<Reports />} />
          <Route path="/settings" element={<Settings />} />
        </Route>

        <Route path="*" element={<Navigate to="/" replace />} />
      </Routes>
    </>);

}