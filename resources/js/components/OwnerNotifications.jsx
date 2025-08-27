import React, { useEffect, useState } from 'react';
import axios from 'axios';

const OwnerNotifications = () => {
  const [notifications, setNotifications] = useState([]);
  const [showDropdown, setShowDropdown] = useState(false);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    axios.get('/api/owner/notifications')
      .then(res => {
        setNotifications(res.data);
        setLoading(false);
      })
      .catch(err => {
        console.error(err);
        setError('Failed to load notifications');
        setLoading(false);
      });
  }, []);

  return (
    <div className="position-relative">
      <button
        className="btn btn-outline-info position-relative"
        onClick={() => setShowDropdown(!showDropdown)}
        aria-expanded={showDropdown}
        aria-haspopup="true"
      >
        <i className="bx bx-bell text-info me-3 fs-5"></i>
        <span>Notifications</span>
        {notifications.length > 0 && (
          <span className="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            {notifications.length}
          </span>
        )}
      </button>

      {showDropdown && (
        <div
          className="dropdown-menu dropdown-menu-end show mt-2"
          style={{ minWidth: '250px' }}
        >
          <h6 className="dropdown-header">Upcoming Appointments</h6>

          {loading && (
            <div className="dropdown-item text-muted">Loading...</div>
          )}

          {error && (
            <div className="dropdown-item text-danger">{error}</div>
          )}

          {!loading && notifications.length === 0 && (
            <div className="dropdown-item text-muted">No upcoming appointments</div>
          )}

          {notifications.map(n => (
            <div key={n.id} className="dropdown-item">
              <strong>{n.pet}</strong> — {n.time}
            </div>
          ))}
        </div>
      )}
    </div>
  );
};

export default OwnerNotifications;