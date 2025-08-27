import React, { useState } from 'react';
import axios from 'axios';

/**
 * Inline status control for admin appointment management
 */
export function AppointmentStatusControl({ appointmentId, currentStatus }) {
  const [status, setStatus] = useState(currentStatus);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(null);

  const statusOptions = [
    { value: 'upcoming', label: 'Upcoming', color: 'info' },
    { value: 'completed', label: 'Completed', color: 'success' },
    { value: 'cancelled', label: 'Cancelled', color: 'secondary' },
  ];

  const currentColor =
    statusOptions.find((opt) => opt.value === status)?.color || 'secondary';

  const handleChange = async (e) => {
    const newStatus = e.target.value;
    setLoading(true);
    setError(null);

    try {
      await axios.patch(`/admin/appointments/${appointmentId}/status`, {
        status: newStatus,
      });

      setStatus(newStatus);
    } catch (err) {
      setError('Failed to update status.');
      console.error(err);
    } finally {
      setLoading(false);
    }
  };

  return (
    <>
      <select
        value={status}
        onChange={handleChange}
        disabled={loading}
        className={`form-select form-select-sm bg-${currentColor} text-white`}
        title="Update appointment status"
      >
        {statusOptions.map(({ value, label }) => (
          <option key={value} value={value}>
            {label}
          </option>
        ))}
      </select>

      {error && (
        <div className="text-danger small mt-1">
          {error}
        </div>
      )}
    </>
  );
}