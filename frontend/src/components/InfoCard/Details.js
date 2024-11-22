import React from 'react';

const Details = ({ details }) => {
  return (
    <div className="details">
      {details.map(({ id, icon, type, value }) => (
        <div key={id} className="detail-section">
          <img src={icon} alt={type} className="detail-icon" />
          <div className="detail-text">
            <div className="detail-type">{type}</div>
            <div className="detail-value">{value}</div>
          </div>
        </div>
      ))}
    </div>
  );
};

export default Details;
