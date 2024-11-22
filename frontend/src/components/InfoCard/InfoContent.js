import React from 'react';

const InfoContent = ({ temperature }) => {
  return (
    <div className="info-content">
      <div className="temperature">
        {temperature}<sup>°C</sup>
      </div>
    </div>
  );
};

export default InfoContent;