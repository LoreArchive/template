import React from 'react';
import ReactDOM from 'react-dom/client';
import Sidebar from './Sidebar.jsx'; // Ensure this matches your actual filename exactly

console.log('DokuWiki React Sidebar Script Loaded');

document.addEventListener('DOMContentLoaded', () => {
  console.log('DOM Content Loaded - Attempting to Mount Sidebar');
  const sidebarContainer = document.getElementById('dokuwiki-sidebar-container');
  
  if (sidebarContainer) {
    console.log('Sidebar Container Found - Mounting React Component');
    const root = ReactDOM.createRoot(sidebarContainer);
    root.render(React.createElement(Sidebar));
  } else {
    console.error('Sidebar Container NOT Found');
  }
});

ReactDOM.render(<Sidebar />, document.getElementById('dokuwiki-sidebar-container'));  // Ensure it renders to the correct DOM element
