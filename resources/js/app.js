import React from 'react';
import { createRoot } from 'react-dom/client';

// Components
import OwnerNotifications from './components/OwnerNotifications';
import OwnerProfileDropdown from './components/OwnerProfileDropdown';

// Mount points
const mountReactComponent = (id, Component) => {
  const rootElement = document.getElementById(id);
  if (rootElement) {
    createRoot(rootElement).render(<Component />);
    console.log(`✅ Mounted <${Component.name}> on #${id}`);
  }
};

// Mount components
mountReactComponent('owner-notifications-root', OwnerNotifications);
mountReactComponent('owner-profile-root', OwnerProfileDropdown);