import React, { useEffect, useState } from 'react';
import axios from 'axios';

const AppointmentsList = () => {
  const [appointments, setAppointments] = useState([]);

  useEffect(() => {
    axios.get('/api/appointments')
      .then(res => setAppointments(res.data))
      .catch(err => console.error(err));
  }, []);

  return (
    <div className="container mt-4">
      <h4>Appointments</h4>
      <table className="table table-bordered">
        <thead>
          <tr>
            <th>Pet</th>
            <th>Vet</th>
            <th>Date</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          {appointments.map(appt => (
            <tr key={appt.id}>
              <td>{appt.pet_name}</td>
              <td>{appt.vet_name}</td>
              <td>{appt.scheduled_at}</td>
              <td>{appt.status}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default AppointmentsList;