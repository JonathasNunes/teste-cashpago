import React from 'react';
import './InfoCard.css';
import CloudImage from './CloudImage';
import Location from './Location';
import InfoContent from './InfoContent';
import Details from './Details';

const InfoCard = ({ cityCountry, temperature, details }) => {
  return (
    <div className="info-card">
      <CloudImage />
      <Location cityCountry={cityCountry} />
      <InfoContent temperature={temperature} />
      <Details details={details} />
    </div>
  );
};

export default InfoCard;
