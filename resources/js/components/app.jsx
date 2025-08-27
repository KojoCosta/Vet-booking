import React from 'react';
import { createRoot } from 'react-dom/client';
import { AppointmentStatusControl } from './components/appointment.react';

document.addEventListener('DOMContentLoaded', () => {
  if (window.reactMounts) {
    window.reactMounts.forEach(({ id, component, props }) => {
      const el = document.getElementById(id);
      if (!el) return;

      const root = createRoot(el);

      switch (component) {
        case 'AppointmentStatusControl':
          root.render(<AppointmentStatusControl {...props} />);
          break;
        // Add more components here as needed
      }
    });
  }
});