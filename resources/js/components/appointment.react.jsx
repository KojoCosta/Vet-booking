import React, { useState } from 'react';
import axios from 'axios';

export function AppointmentStatusControl({ appointmentId, currentStatus }) {
  const [status, setStatus] = useState(currentStatus);
  const [loading, setLoading] = useState(false);

  const handleChange = async (e) => {
    const newStatus = e.target.value;
    setLoading(true);

    try {
      await axios.patch(`/admin/appointments/${appointmentId}/status`, {
        status: newStatus,
      });

      setStatus(newStatus);
    } catch (error) {
      alert('Failed to update status.');
    } finally {
      setLoading(false);
    }
  };

  const badgeClass = {
    upcoming: 'info',
    completed: 'success',
    cancelled: 'secondary',
  }[status] || 'secondary';

  return (
    <select
      value={status}
      onChange={handleChange}
      disabled={loading}
      className={`form-select form-select-sm bg-${badgeClass} text-white`}
    >
      <option value="upcoming">Upcoming</option>
      <option value="completed">Completed</option>
      <option value="cancelled">Cancelled</option>
    </select>
  );
}