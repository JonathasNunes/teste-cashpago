import React from 'react';

const Location = ({ cityCountry }) => {
  return (
    <div className="location">
      <img src="assets/image-4.png" alt="location" className="location-img" />
      <span>{cityCountry || 'Buscando...'}</span>
    </div>
  );
};

export default Location;
