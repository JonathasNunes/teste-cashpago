import React from 'react';
import './InfoCard.css';
import CloudImage from './CloudImage';
import Location from './Location';
import InfoContent from './InfoContent';
import Details from './Details';

const InfoCard = () => {
  return (
    <div className="info-card">
      <CloudImage />
      <Location />
      <InfoContent temperature={18} />
      <Details />
    </div>
  );
};

export default InfoCard;