// resources/js/components/OwnerProfileDropdown.jsx

import React from 'react';

const OwnerProfileDropdown = () => {
  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

  return (
    <div className="dropdown">
      <button className="btn btn-warning dropdown-toggle d-flex align-items-center" type="button" id="ownerProfileDropdown" 
      data-bs-toggle="dropdown" aria-expanded="false" >
        <i className="bx bx-user-circle me-3 fs-5"></i>
        Profile
      </button>

      <ul className="dropdown-menu dropdown-menu-end" aria-labelledby="ownerProfileDropdown">
        <li>
          <a className="dropdown-item" href="owner/profile/">
            Profile Settings
          </a>
        </li>
        <li><hr className="dropdown-divider" /></li>
        <li>
          <form method="POST" action="/logout">
            <input type="hidden" name="_token" value={csrfToken} />
            <button type="submit" className="dropdown-item text-danger">
              Logout
            </button>
          </form>
        </li>
      </ul>
    </div>
  );
};

export default OwnerProfileDropdown;