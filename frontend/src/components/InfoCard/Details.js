import React from 'react';

const Details = () => {
  const details = [
    { id: 1, icon: 'assets/image-1.png', type: 'Vento', value: '17km/h' },
    { id: 2, icon: 'assets/image-2.png', type: 'Umidade', value: '31%' },
    { id: 3, icon: 'assets/image-3.png', type: 'Chuva', value: '10%' },
  ];

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